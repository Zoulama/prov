<?php namespace LeadAssurance\Classes\Repositories;

use Auth;
use Request;
use Session;
use Utils;
use URL;
use stdClass;
use Validator;
use Schema;

use LeadAssurance\Models\Account;
use LeadAssurance\Models\User;
use LeadAssurance\Models\AccountToken;

class AccountRepository
{
    public function create($firstName = '', $lastName = '', $email = '', $password = '')
    {
        
//dd(Utils::isLeadAssu());
        $account = new Account();
        $account->ip = Request::getClientIp();
        $account->account_key = str_random(RANDOM_KEY_LENGTH);
 
        $account->save();

        $user = new User();
        if (!$firstName && !$lastName && !$email && !$password) {
            $user->password = str_random(RANDOM_KEY_LENGTH);
            $user->username = str_random(RANDOM_KEY_LENGTH);
        } else {
            $user->first_name = $firstName;
            $user->last_name = $lastName;
            $user->email = $user->username = $user->name = $email;
            if (!$password) {
                $password = str_random(RANDOM_KEY_LENGTH);
            }
            $user->password = bcrypt($password);
        }

        $user->confirmed = !Utils::isLeadAssu();
        $user->registered = !Utils::isLeadAssu() || $email;

        if (!$user->confirmed) {
            $user->confirmation_code = str_random(RANDOM_KEY_LENGTH);
        }
//dd($user);
        $account->users()->save($user);

        return $account;
    }
   

   
   
    public function findByKey($key)
    {
        $account = Account::whereAccountKey($key)
                    ->with('users.invoices.invoice_items', 'clients.contacts')
                    ->firstOrFail();

        return $account;
    }

   

    public function registerLeadAssuUser($user)
    {
        if ($user->email == TEST_USERNAME) {
            return false;
        }

        $url = (Utils::isLeadAssuDev() ? SITE_URL : LeadAssu_APP_URL) . '/signup/register';
        $data = '';
        $fields = [
            'first_name' => urlencode($user->first_name),
            'last_name' => urlencode($user->last_name),
            'email' => urlencode($user->email),
        ];

        foreach ($fields as $key => $value) {
            $data .= $key.'='.$value.'&';
        }
        rtrim($data, '&');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        curl_close($ch);
    }

    public function findUserByOauth($providerId, $oauthUserId)
    {
        return User::where('oauth_user_id', $oauthUserId)
                    ->where('oauth_provider_id', $providerId)
                    ->first();
    }

    public function findUsers($user, $with = null)
    {
        $accounts = $this->findUserAccounts($user->id);

        if ($accounts) {
            return $this->getUserAccounts($accounts, $with);
        } else {
            return [$user];
        }
    }

    public function findUserAccounts($userId)
    {
        if (!Schema::hasTable('user_accounts')) {
            return false;
        }

        $query = UserAccount::where('user_id1', '=', $userId);
                               
        
        return $query->first(['id']);
    }

    public function getUserAccounts($record, $with = null)
    {
        if (!$record) {
            return false;
        }

        
            $field = "user_id$i";
            if ($record->$field) {
                $userIds[] = $record->$field;
            }
        

        $users = User::with('account')
                    ->whereIn('id', $userIds);

        if ($with) {
            $users->with($with);
        }

        return $users->get();
    }

    public function prepareUsersData($record)
    {
        if (!$record) {
            return false;
        }

        $users = $this->getUserAccounts($record);

        $data = [];
        foreach ($users as $user) {
            $item = new stdClass();
            $item->id = $record->id;
            $item->user_id = $user->id;
            $item->public_id = $user->public_id;
            $item->user_name = $user->getDisplayName();
            $item->account_id = $user->account->id;
            $item->account_name = $user->account->getDisplayName();
            $data[] = $item;
        }

        return $data;
    }

    public function loadAccounts($userId) {
        $record = self::findUserAccounts($userId);
        return self::prepareUsersData($record);
    }

    public function associateAccounts($userId1, $userId2) {

        $record = self::findUserAccounts($userId1, $userId2);

        if ($record) {
            foreach ([$userId1, $userId2] as $userId) {
                if (!$record->hasUserId($userId)) {
                    $record->setUserId($userId);
                }
            }
        } else {
            $record = new UserAccount();
            $record->user_id1 = $userId1;
            $record->user_id2 = $userId2;
        }

        $record->save();

        $users = $this->getUserAccounts($record);

        // Pick the primary user
        foreach ($users as $user) {
            if (!$user->public_id) {
                $useAsPrimary = false;
                if(empty($primaryUser)) {
                    $useAsPrimary = true;
                }

                $planDetails = $user->account->getPlanDetails(false, false);
                $planLevel = 0;

                if ($planDetails) {
                    $planLevel = 1;
                    if ($planDetails['plan'] == PLAN_ENTERPRISE) {
                        $planLevel = 2;
                    }

                    if (!$useAsPrimary && (
                        $planLevel > $primaryUserPlanLevel
                        || ($planLevel == $primaryUserPlanLevel && $planDetails['expires'] > $primaryUserPlanExpires)
                    )) {
                        $useAsPrimary = true;
                    }
                }

                if  ($useAsPrimary) {
                    $primaryUser = $user;
                    $primaryUserPlanLevel = $planLevel;
                    if ($planDetails) {
                        $primaryUserPlanExpires = $planDetails['expires'];
                    }
                }
            }
        }

        // Merge other companies into the primary user's company
        if (!empty($primaryUser)) {
            foreach ($users as $user) {
                if ($user == $primaryUser || $user->public_id) {
                    continue;
                }

                if ($user->account->company_id != $primaryUser->account->company_id) {
                    foreach ($user->account->company->accounts as $account) {
                        $account->company_id = $primaryUser->account->company_id;
                        $account->save();
                    }
                    $user->account->company->forceDelete();
                }
            }
        }

        return $users;
    }



    public function createTokens($user, $name)
    {
        $name = trim($name) ?: 'TOKEN';
        $users = $this->findUsers($user);

        foreach ($users as $user) {
            if ($token = AccountToken::whereUserId($user->id)->whereName($name)->first()) {
                continue;
            }

            $token = AccountToken::createNew($user);
            $token->name = $name;
            $token->token = str_random(RANDOM_KEY_LENGTH);
            $token->save();
        }
    }

    public function getUserAccountId($account)
    {
        $user = $account->users()->first();
        $userAccount = $this->findUserAccounts($user->id);

        return $userAccount ? $userAccount->id : false;
    }

    public function save($data, $account)
    {
        $account->fill($data);
        $account->save();
    }
}
