<?php

namespace Glitter\Audit\Listeners;

use Glitter\Events\MemberCreated;

class LogCreateMember
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
     * @param MemberCreated $event
     *
     * @return void
     */
    public function handle(MemberCreated $event)
    {
        $data = [
            'ip' => request()->ip(),
            'ua' => request()->header('User-Agent'),
        ];

        if ($actor = request()->user()) {
            $data['actor_id'] = $actor->getKey();
            $data['actor_name'] = $actor->name;
        }

        $event->member->log('member.create', $data);
    }
}
