<?php

namespace Glitter\Audit\Listeners\Member;

use Glitter\Events\MemberUpdated;

class LogChangePassword
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
     * @param  MemberUpdated  $event
     * @return void
     */
    public function handle(MemberUpdated $event)
    {
        if (is_null($event->actor)) return;

        if ($event->member->isDirty($event->member->getKeyName())
            || $event->member->isClean('password')) { return; }

        $data = [
            'ip' => request()->ip(),
            'ua' => request()->header('User-Agent'),
        ];

        $event->actor->log('member.change_password', $data);
    }
}
