<?php namespace LeadAssurance\Libraries;

use Auth;
use Cache;
use App;
use Schema;
use Session;
use Request;
use Exception;
use View;
use DateTimeZone;
use Input;
use Log;
use DateTime;
use stdClass;
use Carbon;


class Utils
{
    private static $weekdayNames = [
        "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday",
    ];


    public static function isRegistered()
    {
        return Auth::check() && Auth::user()->registered;
    }

    public static function isConfirmed()
    {
        return Auth::check() && Auth::user()->confirmed;
    }

    public static function isDownForMaintenance()
    {
        return file_exists(storage_path() . '/framework/down');
    }

    public static function isTravis()
    {
        return env('TRAVIS') == 'true';
    }

    public static function isLeadAssu()
    {
        return self::isLeadAssuProd();
    }

    public static function isLeadAssuProd()
    {
        if (Utils::isReseller()) {
            return true;
        }

        return env('LEADASSU_PROD') == 'true';
    }

    public static function requireHTTPS()
    {
        if (Request::root() === 'http://leadassu.fr' || Request::root() === 'http://leadassu.fr:8000') {
            return false;
        }

        return Utils::isLeadAssuProd() || (isset($_ENV['REQUIRE_HTTPS']) && $_ENV['REQUIRE_HTTPS'] == 'true');
    }

    public static function isReseller()
    {
        return Utils::getResllerType() ? true : false;
    }

    public static function getResllerType()
    {
        return isset($_ENV['RESELLER_TYPE']) ? $_ENV['RESELLER_TYPE'] : false;
    }

   

    public static function allowNewAccounts()
    {
        return Utils::isLeadAssu() || Auth::check();
    }
    public static function isLeadAssuDev()
    {
        return env('LEAD_DEV') == 'true';
    }

    public static function hasFeature($feature)
    {
        return Auth::check() && Auth::user()->hasFeature($feature);
    }

    public static function isAdmin()
    {
        return Auth::check() && Auth::user()->is_admin;
    }

    public static function hasPermission($permission, $requireAll = false)
    {
        return Auth::check() && Auth::user()->hasPermission($permission, $requireAll);
    }

    public static function hasAllPermissions($permission)
    {
        return Auth::check() && Auth::user()->hasPermission($permission);
    }

    public static function isTrial()
    {
        return Auth::check() && Auth::user()->isTrial();
    }

    public static function isEnglish()
    {
        return App::getLocale() == 'en';
    }

    public static function getLocaleRegion()
    {
        $parts = explode('_', App::getLocale());

        return count($parts) ? $parts[0] : 'en';
    }

    public static function getUserType()
    {
        if (Utils::isLeadAssu()) {
            return USER_TYPE_CLOUD_HOST;
        } else {
            return USER_TYPE_SELF_HOST;
        }
    }

    

   
}
