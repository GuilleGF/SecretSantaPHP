<?php

use SecretSanta\Player;
use SecretSanta\PlayersCollection;

/**
 * Class PlayersCollectionTest
 */
class PlayersCollectionTest extends PHPUnit_Framework_TestCase
{
    public function testAddPlayer()
    {
        $expectedPlayer = Player::create('name', 'email@email.com');
        $playersCollection = new PlayersCollection();
        $playersCollection->addPlayer($expectedPlayer);

        $player = $playersCollection->player($expectedPlayer->id());

        $this->assertSame(1, count($playersCollection->players()));
        $this->assertSame($expectedPlayer, $player);
    }

    /**
     * @expectedException \SecretSanta\Exceptions\PlayersCollectionException
     */
    public function testDuplicatePlayer()
    {
        $player = Player::create('name', 'email@email.com');
        $playersCollection = new PlayersCollection();
        $playersCollection->addPlayer($player);
        $playersCollection->addPlayer($player);
    }

    public function testAddCouple()
    {
        $expectedPlayer = Player::create('name', 'email@email.com');
        $expectedCouple = Player::create('nameCouple', 'emailCouple@email.com');

        $playersCollection = new PlayersCollection();
        $playersCollection->addCouple($expectedPlayer, $expectedCouple);

        $player = $playersCollection->player($expectedPlayer->id());
        $couple = $playersCollection->player($expectedCouple->id());

        $this->assertSame(2, count($playersCollection->players()));
        $this->assertSame($expectedPlayer, $player);
        $this->assertSame($expectedCouple, $couple);
    }
}