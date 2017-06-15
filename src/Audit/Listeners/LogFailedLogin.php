<?php

namespace Glitter\Audit\Listeners;

use Illuminate\Auth\Events\Failed;

class LogFailedLogin
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
     * @param Failed $event
     *
     * @return void
     */
    public function handle(Failed $event)
    {
        if ($event->user) {
            $model = snake_case(class_basename($event->user));
            $data = [
                'ip'          => request()->ip(),
                'ua'          => request()->header('User-Agent'),
                'credentials' => $event->credentials,
                // 'credentials' => array_except($event->credentials, ['password']),
            ];
            $event->user->log("{$model}.failed_login", $data);
        }
    }
}
