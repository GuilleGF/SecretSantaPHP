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
    public function testGetUnKnowPlayer()
    {
        $expectedPlayer = Player::create('name', 'email@email.com');
        $playersCollection = new PlayersCollection();
        $playersCollection->addPlayer($expectedPlayer);

        $playersCollection->player('error-id');
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

    /**
     * @expectedException \SecretSanta\Exceptions\PlayersCollectionException
     */
    public function testDuplicatePlayerInCouple()
    {
        $expectedPlayer = Player::create('name', 'email@email.com');
        $expectedCouple = Player::create('nameCouple', 'emailCouple@email.com');

        $playersCollection = new PlayersCollection();
        $playersCollection->addPlayer($expectedPlayer);
        $playersCollection->addCouple($expectedPlayer, $expectedCouple);
    }

    /**
     * @expectedException \SecretSanta\Exceptions\PlayersCollectionException
     */
    public function testSamePlayerInCouple()
    {
        $expectedPlayer = Player::create('name', 'email@email.com');

        $playersCollection = new PlayersCollection();
        $playersCollection->addCouple($expectedPlayer, $expectedPlayer);
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

    public function testShufflePlayers()
    {
        $expectedPlayer = Player::create('name', 'email@email.com');
        $expectedCouple = Player::create('nameCouple', 'emailCouple@email.com');

        $playersCollection = new PlayersCollection();
        $playersCollection->addCouple($expectedPlayer, $expectedCouple);

        $shufflePlayers = $playersCollection->shufflePlayers();

        $this->assertNotEquals(array_keys($playersCollection->players()), array_keys($shufflePlayers));
    }

    public function testExcludePlayers()
    {
        $expectedSinglePlayer = Player::create('nameSingle', 'emailSingle@email.com');
        $expectedPlayer = Player::create('name', 'email@email.com');
        $expectedCouple = Player::create('nameCouple', 'emailCouple@email.com');

        $playersCollection = new PlayersCollection();
        $playersCollection->addCouple($expectedPlayer, $expectedCouple);

        $this->assertTrue($playersCollection->areExclude($expectedPlayer, $expectedCouple));
        $this->assertFalse($playersCollection->areExclude($expectedSinglePlayer, $expectedPlayer));
        $this->assertSame(2, $playersCollection->countExcludePlayers());
    }
}