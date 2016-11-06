<?php

use SecretSanta\SecretSanta;

/**
 * Class SecretSantaTest
 */
class SecretSantaTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \SecretSanta\Exceptions\SecretSantaException
     */
    public function testPlayerAndCouple()
    {
        $secretSanta = new SecretSanta();

        $secretSanta->addPlayer('Player', 'player@email.com');
        $secretSanta->addCouple('Player2', 'player2@email.com', 'Couple2', 'couple2@email.com');

        $secretSanta->play();
    }

    public function testTwoCouples()
    {
        $secretSanta = new SecretSanta();
        $secretSanta->addCouple('Player', 'player@email.com', 'Couple', 'couple@email.com');
        $secretSanta->addCouple('Player2', 'player2@email.com', 'Couple2', 'couple2@email.com');

        $combination = $secretSanta->play();

        $this->assertSame(4 , count($combination));
    }

    public function testTwoCouplesAndPlayer()
    {
        $secretSanta = new SecretSanta();

        $secretSanta->addPlayer('Player', 'player@email.com');
        $secretSanta->addCouple('Player2', 'player2@email.com', 'Couple2', 'couple2@email.com');
        $secretSanta->addCouple('Player3', 'player3@email.com', 'Couple3', 'couple3@email.com');

        $combination = $secretSanta->play();

        $this->assertSame(5 , count($combination));
    }

    public function testFourCouplesAndTwoPlayers()
    {
        $secretSanta = new SecretSanta();

        $secretSanta->addPlayer('Player', 'player@email.com');
        $secretSanta->addPlayer('Player2', 'player2@email.com');
        $secretSanta->addCouple('Player3', 'player3@email.com', 'Couple3', 'couple3@email.com');
        $secretSanta->addCouple('Player4', 'player4@email.com', 'Couple4', 'couple4@email.com');
        $secretSanta->addCouple('Player5', 'player5@email.com', 'Couple5', 'couple5@email.com');
        $secretSanta->addCouple('Player6', 'player6@email.com', 'Couple6', 'couple6@email.com');

        $combination = $secretSanta->play();

        $this->assertSame(10 , count($combination));
    }
}
