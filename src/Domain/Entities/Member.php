<?php

namespace Highday\Glitter\Domain\Entities;

use Highday\Glitter\Domain\ValueObjects\Web\EmailAddress;

class Member
{
    /** @var string */
    protected $name;

    /** @var EmailAddress */
    protected $email;

    public function __construct(string $name, EmailAddress $email)
    {
        $this->name = $name;
        $this->email = $email;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): EmailAddress
    {
        return $this->email;
    }
}
