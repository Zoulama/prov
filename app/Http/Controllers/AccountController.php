<?php namespace LeadAssurance\Http\Controllers;

use Auth;
use File;
use Image;
use Input;
use Redirect;
use Session;
use Utils;
use Validator;
use View;
use URL;
use stdClass;
use Cache;
use Response;
use Request;
use LeadAssurance\Models\User;
use LeadAssurance\Models\Account;
use LeadAssurance\Classes\Repositories\AccountRepository;
use LeadAssurance\Classes\Mailers\UserMailer;
use LeadAssurance\Events\UserSignedUp;
use LeadAssurance\Services\AuthService;


/**
 * Class AccountController
 */
class AccountController extends BaseController
{
    /**
     * @var AccountRepository
     */
    protected $accountRepo;

    /**
     * @var UserMailer
     */
    protected $userMailer;

    /**
     * AccountController constructor.
     *
     * @param AccountRepository $accountRepo
     * @param UserMailer $userMailer
     */
    public function __construct(AccountRepository $accountRepo,UserMailer $userMailer)
    {
        $this->accountRepo = $accountRepo;
        $this->userMailer = $userMailer;
    }
    
    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function showUserDetails()
    {
        $oauthLoginUrls = [];
        foreach (AuthService::$providers as $provider) {
            $oauthLoginUrls[] = ['label' => $provider, 'url' => URL::to('/auth/'.strtolower($provider))];
        }

        $data = [
            'account' => Account::with('users')->findOrFail(Auth::user()->account_id),
            'title' => trans('texts.user_details'),
            'user' => Auth::user(),
            'oauthProviderName' => AuthService::getProviderName(Auth::user()->oauth_provider_id),
            'oauthLoginUrls' => $oauthLoginUrls,
        ];

        return View::make('accounts.user_details', $data);
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    private function showLocalization()
    {
        $data = [
            'account' => Account::with('users')->findOrFail(Auth::user()->account_id),
            'timezones' => Cache::get('timezones'),
            'dateFormats' => Cache::get('dateFormats'),
            'datetimeFormats' => Cache::get('datetimeFormats'),
            'currencies' => Cache::get('currencies'),
            'title' => trans('texts.localization'),
            'weekdays' => Utils::getTranslatedWeekdayNames(),
        ];

        return View::make('accounts.localization', $data);
    }

   
    /**
     * @return string
     */
    public function checkEmail()
    {
        $email = User::withTrashed()->where('email', '=', Input::get('email'))
                                    ->where('id', '<>', Auth::user()->id)
                                    ->first();

        if ($email) {
            return 'taken';
        } else {
            return 'available';
        }
    }


    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resendConfirmation()
    {
        /** @var \LeadAssurance\Models\User $user */
        $user = Auth::user();
        $this->userMailer->sendConfirmation($user);

        return Redirect::to('/settings/'.ACCOUNT_USER_DETAILS)->with('message', trans('texts.confirmation_resent'));
    }

    
}
