<?php

namespace Highday\Glitter\Infrastructure\Eloquents;

use Highday\Glitter\Domain\Entities\Member as MemberEntity;
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
    }

    public function testInstance()
    {
        $this->assertInstanceOf(Member::class, $this->member);
    }

    public function testToDomain()
    {
        $this->assertInstanceOf(MemberEntity::class, $this->member->toDomain());
    }
}
