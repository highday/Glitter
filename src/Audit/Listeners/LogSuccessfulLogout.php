<?php

namespace Glitter\Audit\Listeners;

use Illuminate\Auth\Events\Logout;

class LogSuccessfulLogout
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Logout  $event
     * @return void
     */
    public function handle(Logout $event)
    {
        $model = snake_case(class_basename($event->user));
        $data = [
            'ip' => request()->ip(),
            'ua' => request()->header('User-Agent'),
        ];
        $event->user->log("{$model}.logout", $data);
    }
}
