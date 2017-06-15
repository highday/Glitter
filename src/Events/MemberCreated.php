<?php

namespace Glitter\Events;

class MemberCreated
{
    /**
     * The actor member.
     *
     * @var \Glitter\Eloquent\Models\Member|null
     */
    public $actor;

    /**
     * The create member.
     *
     * @var \Glitter\Eloquent\Models\Member
     */
    public $member;

    /**
     * Create a new event instance.
     *
     * @param  \Glitter\Eloquent\Models\Member  $member
     */
    public function __construct($member)
    {
        $this->actor = auth('member')->user();

        $this->member = $member;
    }
}
