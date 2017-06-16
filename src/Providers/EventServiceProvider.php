<?php

namespace Glitter\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'Illuminate\Auth\Events\Login' => [
            'Glitter\Audit\Listeners\Member\LogSuccessfulLogin',
        ],
        'Illuminate\Auth\Events\Failed' => [
            'Glitter\Audit\Listeners\Member\LogFailedLogin',
        ],
        'Illuminate\Auth\Events\Logout' => [
            'Glitter\Audit\Listeners\Member\LogSuccessfulLogout',
        ],

        'Glitter\Events\MemberCreated' => [
            'Glitter\Audit\Listeners\Member\LogCreate',
        ],
        'Glitter\Events\MemberUpdated' => [
            'Glitter\Audit\Listeners\Member\LogChangePassword',
        ],

        'Glitter\Events\ProductSaved' => [
            'Glitter\Audit\Listeners\Product\LogSave',
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
