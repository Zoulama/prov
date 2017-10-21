<?php namespace LeadAssurance\Models;

use Eloquent;
use Utils;
use Session;
use DateTime;
use Event;
use Cache;
use LeadAssurance;
use LeadAssurance\Events\UserSettingsChanged;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laracasts\Presenter\PresentableTrait;
use LeadAssurance\Models\Traits\PresentsInvoice;

/**
 * Class Account
 */
class Account extends Eloquent
{
    use PresentableTrait;
    use SoftDeletes;
    use PresentsInvoice;

    /**
     * @var string
     */
    protected $presenter = 'LeadAssurance\Classes\Presenters\AccountPresenter';

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * @var array
     */
    protected $hidden = ['ip'];

   
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function account_tokens()
    {
        return $this->hasMany('LeadAssurance\Models\AccountToken');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany('LeadAssurance\Models\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function invoices()
    {
        return $this->hasMany('LeadAssurance\Models\Invoice');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function account_gateways()
    {
        return $this->hasMany('LeadAssurance\Models\AccountGateway');
    }

    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function timezone()
    {
        return $this->belongsTo('LeadAssurance\Models\Timezone');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function language()
    {
        return $this->belongsTo('LeadAssurance\Models\Language');
    }

   
    /**
     * @return mixed
     */
    public function payments()
    {
        return $this->hasMany('LeadAssurance\Models\Payment','account_id','id')->withTrashed();
    }


    /**
     * @return mixed
     */
    public function getDisplayName()
    {
        if ($this->name) {
            return $this->name;
        }

        //$this->load('users');
        $user = $this->users()->first();

        return $user->getDisplayName();
    }


   

    public function getDate($date = 'now')
    {
        if ( ! $date) {
            return null;
        } elseif ( ! $date instanceof \DateTime) {
            $date = new \DateTime($date);
        }

        return $date;
    }

    /**
     * @param string $date
     * @return DateTime|null|string
     */
    public function getDateTime($date = 'now')
    {
        $date = $this->getDate($date);
        $date->setTimeZone(new \DateTimeZone($this->getTimezone()));

        return $date;
    }

    /**
     * @return mixed
     */
    public function getCustomDateFormat()
    {
        return $this->date_format ? $this->date_format->format : DEFAULT_DATE_FORMAT;
    }

    /**
     * @param $date
     * @return null|string
     */
    public function formatDate($date)
    {
        $date = $this->getDate($date);

        if ( ! $date) {
            return null;
        }

        return $date->format($this->getCustomDateFormat());
    }

    /**
     * @param $date
     * @return null|string
     */
    public function formatDateTime($date)
    {
        $date = $this->getDateTime($date);

        if ( ! $date) {
            return null;
        }

        return $date->format($this->getCustomDateTimeFormat());
    }

    /**
     * @param $date
     * @return null|string
     */
    public function formatTime($date)
    {
        $date = $this->getDateTime($date);

        if ( ! $date) {
            return null;
        }

        return $date->format($this->getCustomTimeFormat());
    }

    /**
     * @return mixed
     */
    public function getPrimaryUser()
    {
        return $this->users()
                    ->orderBy('id')
                    ->first();
    }

    /**
     * @param $userId
     * @param $name
     * @return null
     */
    public function getToken($userId, $name)
    {
        foreach ($this->account_tokens as $token) {
            if ($token->user_id == $userId && $token->name === $name) {
                return $token->token;
            }
        }

        return null;
    }


    
   

    /**
     * @return bool
     */
    public function isLeadAssuAccount()
    {
        return $this->account_key === LEADASSU_ACCOUNT_KEY;
    }

    public function isPro(&$plan_details = null)
    {
        if (!Utils::isLeadAssuProd()) {
            return true;
        }

        if ($this->isLeadAssuAccount()) {
            return true;
        }

        $plan_details = $this->getPlanDetails();

        return !empty($plan_details);
    }

  
    public function isEnterprise(&$plan_details = null)
    {
        if (!Utils::isLeadAssuProd()) {
            return true;
        }

        if ($this->isLeadAssuAccount()) {
            return true;
        }

        $plan_details = $this->getPlanDetails();

        return $plan_details && $plan_details['plan'] == PLAN_ENTERPRISE;
    }

    /**
     * @return bool
     */
    public function isTrial()
    {
        if (!Utils::isLeadAssuProd()) {
            return false;
        }

        $plan_details = $this->getPlanDetails();

        return $plan_details && $plan_details['trial'];
    }

    /**
     * @param $reminder
     * @return bool
     */
    public function getReminderDate($reminder)
    {
        if ( ! $this->{"enable_reminder{$reminder}"}) {
            return false;
        }

        $numDays = $this->{"num_days_reminder{$reminder}"};
        $plusMinus = $this->{"direction_reminder{$reminder}"} == REMINDER_DIRECTION_AFTER ? '-' : '+';

        return date('Y-m-d', strtotime("$plusMinus $numDays days"));
    }



    /**
     * @return string
     */
    public function getSiteUrl()
    {
        $url = SITE_URL;
        $iframe_url = $this->iframe_url;

        if ($iframe_url) {
            return "{$iframe_url}/?";
        } else if ($this->subdomain) {
            $url = Utils::replaceSubdomain($url, $this->subdomain);
        }

        return $url;
    }

    /**
     * @param $host
     * @return bool
     */
    public function checkSubdomain($host)
    {
        if (!$this->subdomain) {
            return true;
        }

        $server = explode('.', $host);
        $subdomain = $server[0];

        if (!in_array($subdomain, ['LeadAssurance', 'www']) && $subdomain != $this->subdomain) {
            return false;
        }

        return true;
    }


    

    
}

