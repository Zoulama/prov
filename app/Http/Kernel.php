<?php

namespace LeadAssurance\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \LeadAssurance\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \LeadAssurance\Http\Middleware\VerifyCsrfToken::class,
            \LeadAssurance\Http\Middleware\VerifyCsrfToken::class,
            \LeadAssurance\Http\Middleware\DuplicateSubmissionCheck::class,
            \LeadAssurance\Http\Middleware\QueryLogging::class,
            \LeadAssurance\Http\Middleware\SessionDataCheckMiddleware::class,
            //\LeadAssurance\Http\Middleware\StartupCheck::class,
        ],

        'api' => [
            'throttle:60,1',
        ],
        
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \LeadAssurance\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'can' => \Illuminate\Foundation\Http\Middleware\Authorize::class,
        'guest' => \LeadAssurance\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'permissions.required' => LeadAssurance\Http\Middleware\PermissionsRequired::class,
        //'api' => LeadAssurance\Http\Middleware\ApiCheck::class,
    ];

    
}
