<?php

namespace Glitter\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'Illuminate\Auth\Events\Login' => [
            'Glitter\Audit\Listeners\LogSuccessfulLogin',
        ],
        'Illuminate\Auth\Events\Failed' => [
            'Glitter\Audit\Listeners\LogFailedLogin',
        ],
        'Illuminate\Auth\Events\Logout' => [
            'Glitter\Audit\Listeners\LogSuccessfulLogout',
        ],

        'Glitter\Events\MemberCreated' => [
            'Glitter\Audit\Listeners\LogCreateMember',
        ],
        'Glitter\Events\MemberUpdated' => [
            'Glitter\Audit\Listeners\LogChangePassword',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
