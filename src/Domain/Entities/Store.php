<?php

namespace Highday\Glitter\Domain\Entities;

use Highday\Glitter\Domain\Entity;
use Highday\Glitter\Domain\ValueObjects\EmailAddress;

class Store extends Entity
{
    /** @var string */
    public $name;

    /** @var EmailAddress */
    public $account_email;

    /** @var EmailAddress */
    public $customer_email;

    /** @var string */
    public $timezone;

    /** @var string */
    public $currency;

    public function __construct(string $name, string $account_email, string $customer_email, string $timezone, string $currency)
    {
        $this->name = $name;
        $this->account_email = new EmailAddress($account_email);
        $this->customer_email = new EmailAddress($customer_email);
        $this->timezone = $timezone;
        $this->currency = $currency;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
