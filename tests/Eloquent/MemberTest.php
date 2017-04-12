<?php

namespace Highday\Glitter\Eloquent\Models;

use Highday\Glitter\Domain\Entities\Member as DomainEntity;
use PHPUnit_Framework_TestCase;

class MemberTest extends PHPUnit_Framework_TestCase
{
    private $faker;

    public function setUp()
    {
        $this->faker = \Faker\Factory::create('ja_JP');
        $name = $this->faker->lastName.' '.$this->faker->firstName;
        $email = $this->faker->email;
        $this->member = new Member(compact('name', 'email'));
        // $this->member->save();
    }

    public function testInstance()
    {
        $this->assertInstanceOf(Member::class, $this->member);
    }

    // public function testToDomain()
    // {
    //     $this->assertInstanceOf(DomainEntity::class, $this->member->toDomain());
    // }
}
