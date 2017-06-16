<?php

namespace Glitter\Events;

class MemberUpdated
{
    /**
     * The actor member.
     *
     * @var \Glitter\Eloquent\Models\Member|null
     */
    public $actor;

    /**
     * The update member.
     *
     * @var \Glitter\Eloquent\Models\Member
     */
    public $member;

    /**
     * Create a new event instance.
     *
     * @param \Glitter\Eloquent\Models\Member $member
     */
    public function __construct($member)
    {
        $this->actor = auth('member')->user();

        $this->member = $member;
    }
}
