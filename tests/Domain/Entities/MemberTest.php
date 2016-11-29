<?php

namespace Highday\Glitter\Domain\Entities;

use Highday\Glitter\Domain\ValueObjects\Web\EmailAddress;
use PHPUnit_Framework_TestCase;

class MemberTest extends PHPUnit_Framework_TestCase
{
    private $faker;

    public function setUp()
    {
        $this->faker = \Faker\Factory::create('ja_JP');
    }

    public function testInstance()
    {
        $name = $this->faker->lastName.' '.$this->faker->firstName;
        $email = new EmailAddress($this->faker->email);
        $member = new Member($name, $email);
        $this->assertInstanceOf(Member::class, $member);
        $this->assertEquals($name, $member->getName());
        $this->assertEquals($email, $member->getEmail());
    }
}
