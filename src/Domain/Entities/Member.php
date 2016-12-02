<?php

namespace Highday\Glitter\Domain\Entities;

use Highday\Glitter\Domain\Entity;
use Highday\Glitter\Domain\ValueObjects\EmailAddress;

class Member extends Entity
{
    /** @var string */
    public $name;

    /** @var EmailAddress */
    public $email;

    public function __construct(string $name, EmailAddress $email)
    {
        $this->setName($name);
        $this->setEmail($email);
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setEmail(EmailAddress $email)
    {
        $this->email = $email;
    }

    public function getEmail(): EmailAddress
    {
        return $this->email;
    }
}
