<?php

namespace Glitter\Audit\Listeners;

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
     * @param MemberUpdated $event
     *
     * @return void
     */
    public function handle(MemberUpdated $event)
    {
        if ($event->member->isDirty($event->member->getKeyName())
            || $event->member->isClean('password')) {
            return;
        }

        $data = [
            'ip' => request()->ip(),
            'ua' => request()->header('User-Agent'),
        ];

        if ($actor = request()->user()) {
            $data['actor_id'] = $actor->getKey();
            $data['actor_name'] = $actor->name;
        }

        $event->member->log('member.change_password', $data);
    }
}
