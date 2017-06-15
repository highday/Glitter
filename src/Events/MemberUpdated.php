<?php

namespace Glitter\Events;

class MemberUpdated
{
    /**
     * The update member.
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
        $this->member = $member;
    }
}
