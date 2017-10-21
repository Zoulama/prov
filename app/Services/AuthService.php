<?php namespace LeadAssurance\Services;

use Session;
use Auth;
use Utils;
use Input;
use Socialite;
use LeadAssurance\Classes\Repositories\AccountRepository;
use LeadAssurance\Events\UserLoggedIn;

/**
 * Class AuthService
 */
class AuthService
{
    /**
     * @var AccountRepository
     */
    private $accountRepo;

    /**
     * @var array
     */
    public static $providers = [
        1 => SOCIAL_GOOGLE,
        2 => SOCIAL_FACEBOOK,
        3 => SOCIAL_GITHUB,
        4 => SOCIAL_LINKEDIN
    ];

    /**
     * AuthService constructor.
     *
     * @param AccountRepository $repo
     */
    public function __construct(AccountRepository $repo)
    {
        $this->accountRepo = $repo;
    }

    /**
     * @param $provider
     * @return mixed
     */
    private function getAuthorization($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * @param $provider
     * @return mixed
     */
    public static function getProviderId($provider)
    {
        return array_search(strtolower($provider), array_map('strtolower', AuthService::$providers));
    }

    /**
     * @param $providerId
     * @return mixed|string
     */
    public static function getProviderName($providerId)
    {
        return $providerId ? AuthService::$providers[$providerId] : '';
    }
}
