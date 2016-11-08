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

    public function testTenCouplesAndTenPlayers()
    {
        $secretSanta = new SecretSanta();

        $secretSanta->addPlayer('Player', 'player@email.com');
        $secretSanta->addPlayer('Player2', 'player2@email.com');
        $secretSanta->addCouple('Player3', 'player3@email.com', 'Couple3', 'couple3@email.com');
        $secretSanta->addCouple('Player4', 'player4@email.com', 'Couple4', 'couple4@email.com');
        $secretSanta->addCouple('Player5', 'player5@email.com', 'Couple5', 'couple5@email.com');
        $secretSanta->addCouple('Player6', 'player6@email.com', 'Couple6', 'couple6@email.com');
        $secretSanta->addPlayer('Player7', 'player7@email.com');
        $secretSanta->addPlayer('Player8', 'player8@email.com');
        $secretSanta->addPlayer('Player9', 'player9@email.com');
        $secretSanta->addPlayer('Player10', 'player10@email.com');
        $secretSanta->addPlayer('Player11', 'player11@email.com');
        $secretSanta->addPlayer('Player12', 'player12@email.com');
        $secretSanta->addCouple('Player13', 'player13@email.com', 'Couple13', 'couple13@email.com');
        $secretSanta->addCouple('Player14', 'player14@email.com', 'Couple14', 'couple14@email.com');
        $secretSanta->addCouple('Player15', 'player15@email.com', 'Couple15', 'couple15@email.com');
        $secretSanta->addCouple('Player16', 'player16@email.com', 'Couple16', 'couple16@email.com');
        $secretSanta->addPlayer('Player17', 'player17@email.com');
        $secretSanta->addPlayer('Player18', 'player18@email.com');
        $secretSanta->addCouple('Player19', 'player19@email.com', 'Couple19', 'couple19@email.com');
        $secretSanta->addCouple('Player20', 'player20@email.com', 'Couple20', 'couple20@email.com');

        $combination = $secretSanta->play();

        $this->assertSame(30 , count($combination));
    }
}
