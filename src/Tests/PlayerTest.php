<?php

use SecretSanta\Player;

/**
 * Class PlayerTest
 */
class PlayerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \SecretSanta\Exceptions\PlayerException
     */
    public function testSortName()
    {
        Player::create('ab', 'email@email.com');
    }

    /**
     * @expectedException \SecretSanta\Exceptions\PlayerException
     */
    public function testInvalidEmail()
    {
        Player::create('name', 'email@');
    }

    public function testPlayer()
    {
        $player = Player::create('name', 'email@email.com');

        $this->assertTrue($player->id() != '');
        $this->assertSame('name', $player->name());
        $this->assertSame('email@email.com', $player->email());
    }
}
