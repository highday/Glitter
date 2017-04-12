<?php

namespace Highday\Glitter\Domain\Entities;

use Highday\Glitter\Domain\Entity;
use Highday\Glitter\Domain\Values\EmailAddress;

class Member extends Entity
{
    /** @var string */
    public $first_name;

    /** @var string */
    public $last_name;

    /** @var EmailAddress */
    public $email;

    public function __construct(string $first_name, string $last_name, string $email)
    {
        $this->setName($first_name, $last_name);
        $this->setEmail(new EmailAddress($email));
    }

    public function setName(string $first_name, string $last_name)
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
    }

    public function getName(): string
    {
        return $this->first_name.' '.$this->last_name;
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
