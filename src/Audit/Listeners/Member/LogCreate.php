<?php

namespace Glitter\Audit\Listeners\Member;

use Glitter\Events\MemberCreated;

class LogCreate
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
     * @param  MemberCreated  $event
     * @return void
     */
    public function handle(MemberCreated $event)
    {
        if (is_null($event->actor)) return;

        $data = [
            'ip' => request()->ip(),
            'ua' => request()->header('User-Agent'),
        ];

        $event->actor->log('member.create', $data);
    }
}
