<?php

namespace Highday\Glitter\Domain\Entities;

use Highday\Glitter\Domain\ValueObjects\EmailAddress;
use PHPUnit\Framework\TestCase;

class MemberTest extends TestCase
{
    private $faker;

    public function setUp()
    {
        $this->faker = \Faker\Factory::create('ja_JP');
    }

    public function testInstance()
    {
        $firstName = $this->faker->firstName;
        $lastName = $this->faker->lastName;
        $email = new EmailAddress($this->faker->email);
        $member = new Member($firstName, $lastName, $email);
        $this->assertInstanceOf(Member::class, $member);
        $this->assertEquals("$firstName $lastName", $member->getName());
        $this->assertEquals($email, $member->getEmail());
    }
}
