<?php namespace LeadAssurance\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'LeadAssurance\Events\SomeEvent' => [
            'LeadAssurance\Listeners\EventListener',
        ],

        \Codedge\Updater\Events\UpdateAvailable::class => [
          \Codedge\Updater\Listeners\SendUpdateAvailableNotification::class
        ],
        \Codedge\Updater\Events\UpdateSucceeded::class => [
          \Codedge\Updater\Listeners\SendUpdateSucceededNotification::class
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}
