<?php

namespace Glitter\Audit\Listeners;

use Illuminate\Auth\Events\Login;

class LogSuccessfulLogin
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
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $model = snake_case(class_basename($event->user));
        $data = [
            'ip' => request()->ip(),
            'ua' => request()->header('User-Agent'),
            'remember' => $event->remember,
        ];
        $event->user->log("{$model}.login", $data);
    }
}
