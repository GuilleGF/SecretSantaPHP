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

    /**
     * @expectedException \SecretSanta\Exceptions\PlayersCollectionException
     */
    public function testSameTwoPlayers()
    {
        $secretSanta = new SecretSanta();

        $secretSanta->addPlayer('Player', 'player@email.com');
        $secretSanta->addPlayer('Player', 'player@email.com');
    }

    /**
     * @expectedException \SecretSanta\Exceptions\PlayersCollectionException
     */
    public function testSameTwoCouplesHimself()
    {
        $secretSanta = new SecretSanta();

        $secretSanta->addCouple('Player', 'player@email.com', 'Player', 'player@email.com');
    }

    /**
     * @expectedException \SecretSanta\Exceptions\PlayersCollectionException
     */
    public function testSameTwoCouples()
    {
        $secretSanta = new SecretSanta();

        $secretSanta->addCouple('Player', 'player@email.com', 'Couple', 'couple@email.com');
        $secretSanta->addCouple('Player', 'player@email.com', 'Couple', 'couple@email.com');
    }

    public function testTwoCouples()
    {
        $secretSanta = new SecretSanta();
        $secretSanta->addCouple('Player', 'player@email.com', 'Couple', 'couple@email.com');
        $secretSanta->addCouple('Player2', 'player2@email.com', 'Couple2', 'couple2@email.com');

        $combination = $secretSanta->play();

        $this->assertSame(4 , count($combination));
    }

    public function testNeverCombinationItself()
    {
        $secretSanta = new SecretSanta();
        $secretSanta->addCouple('Player', 'player@email.com', 'Couple', 'couple@email.com');
        $secretSanta->addCouple('Player2', 'player2@email.com', 'Couple2', 'couple2@email.com');

        $combination = $secretSanta->play();
        foreach ($combination as $player) {
            $this->assertTrue($player->id() != $player->secretSanta()->id());
        }
    }

    public function testNeverCombinationCouples()
    {
        $secretSanta = new SecretSanta();
        $secretSanta->addCouple('Player', 'player@email.com', 'Couple', 'couple@email.com');
        $secretSanta->addCouple('Player2', 'player2@email.com', 'Couple2', 'couple2@email.com');

        $combination = $secretSanta->play();
        foreach ($combination as $player) {
            switch ($player->email()) {
                case 'player@email.com';
                    $this->assertTrue($player->secretSanta()->email() != 'couple@email.com');
                    break;
                case 'couple@email.com';
                    $this->assertTrue($player->secretSanta()->email() != 'player@email.com');
                    break;
                case 'player2@email.com';
                    $this->assertTrue($player->secretSanta()->email() != 'couple2@email.com');
                    break;
                case 'couple2@email.com';
                    $this->assertTrue($player->secretSanta()->email() != 'player2@email.com');
                    break;
                default:
                    $this->assertTrue(false);
            }
        }
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

    public function testTenCouples()
    {
        $secretSanta = new SecretSanta();

        $secretSanta->addCouple('Player3', 'player3@email.com', 'Couple3', 'couple3@email.com');
        $secretSanta->addCouple('Player4', 'player4@email.com', 'Couple4', 'couple4@email.com');
        $secretSanta->addCouple('Player5', 'player5@email.com', 'Couple5', 'couple5@email.com');
        $secretSanta->addCouple('Player6', 'player6@email.com', 'Couple6', 'couple6@email.com');
        $secretSanta->addCouple('Player13', 'player13@email.com', 'Couple13', 'couple13@email.com');
        $secretSanta->addCouple('Player14', 'player14@email.com', 'Couple14', 'couple14@email.com');
        $secretSanta->addCouple('Player15', 'player15@email.com', 'Couple15', 'couple15@email.com');
        $secretSanta->addCouple('Player16', 'player16@email.com', 'Couple16', 'couple16@email.com');
        $secretSanta->addCouple('Player19', 'player19@email.com', 'Couple19', 'couple19@email.com');
        $secretSanta->addCouple('Player20', 'player20@email.com', 'Couple20', 'couple20@email.com');

        $combination = $secretSanta->play();

        $this->assertSame(20 , count($combination));
    }

    public function testFiftyCouples()
    {
        $secretSanta = new SecretSanta();

        $secretSanta->addCouple('Player', 'player@email.com', 'Couple', 'couple@email.com');
        $secretSanta->addCouple('Player2', 'player2@email.com', 'Couple2', 'couple2@email.com');
        $secretSanta->addCouple('Player3', 'player3@email.com', 'Couple3', 'couple3@email.com');
        $secretSanta->addCouple('Player4', 'player4@email.com', 'Couple4', 'couple4@email.com');
        $secretSanta->addCouple('Player5', 'player5@email.com', 'Couple5', 'couple5@email.com');
        $secretSanta->addCouple('Player6', 'player6@email.com', 'Couple6', 'couple6@email.com');
        $secretSanta->addCouple('Player7', 'player7@email.com', 'Couple7', 'couple7@email.com');
        $secretSanta->addCouple('Player8', 'player8@email.com', 'Couple8', 'couple8@email.com');
        $secretSanta->addCouple('Player9', 'player9@email.com', 'Couple9', 'couple9@email.com');
        $secretSanta->addCouple('Player10', 'player10@email.com', 'Couple10', 'couple10@email.com');
        $secretSanta->addCouple('Player11', 'player11@email.com', 'Couple11', 'couple11@email.com');
        $secretSanta->addCouple('Player12', 'player12@email.com', 'Couple12', 'couple12@email.com');
        $secretSanta->addCouple('Player13', 'player13@email.com', 'Couple13', 'couple13@email.com');
        $secretSanta->addCouple('Player14', 'player14@email.com', 'Couple14', 'couple14@email.com');
        $secretSanta->addCouple('Player15', 'player15@email.com', 'Couple15', 'couple15@email.com');
        $secretSanta->addCouple('Player16', 'player16@email.com', 'Couple16', 'couple16@email.com');
        $secretSanta->addCouple('Player17', 'player17@email.com', 'Couple17', 'couple17@email.com');
        $secretSanta->addCouple('Player18', 'player18@email.com', 'Couple18', 'couple18@email.com');
        $secretSanta->addCouple('Player19', 'player19@email.com', 'Couple19', 'couple19@email.com');
        $secretSanta->addCouple('Player20', 'player20@email.com', 'Couple20', 'couple20@email.com');
        $secretSanta->addCouple('Player21', 'player21@email.com', 'Couple21', 'couple21@email.com');
        $secretSanta->addCouple('Player22', 'player22@email.com', 'Couple22', 'couple22@email.com');
        $secretSanta->addCouple('Player23', 'player23@email.com', 'Couple23', 'couple23@email.com');
        $secretSanta->addCouple('Player24', 'player24@email.com', 'Couple24', 'couple24@email.com');
        $secretSanta->addCouple('Player25', 'player25@email.com', 'Couple25', 'couple25@email.com');
        $secretSanta->addCouple('Player26', 'player26@email.com', 'Couple26', 'couple26@email.com');
        $secretSanta->addCouple('Player27', 'player27@email.com', 'Couple27', 'couple27@email.com');
        $secretSanta->addCouple('Player28', 'player28@email.com', 'Couple28', 'couple28@email.com');
        $secretSanta->addCouple('Player29', 'player29@email.com', 'Couple29', 'couple29@email.com');
        $secretSanta->addCouple('Player30', 'player30@email.com', 'Couple30', 'couple30@email.com');
        $secretSanta->addCouple('Player31', 'player31@email.com', 'Couple31', 'couple31@email.com');
        $secretSanta->addCouple('Player32', 'player32@email.com', 'Couple32', 'couple32@email.com');
        $secretSanta->addCouple('Player33', 'player33@email.com', 'Couple33', 'couple33@email.com');
        $secretSanta->addCouple('Player34', 'player34@email.com', 'Couple34', 'couple34@email.com');
        $secretSanta->addCouple('Player35', 'player35@email.com', 'Couple35', 'couple35@email.com');
        $secretSanta->addCouple('Player36', 'player36@email.com', 'Couple36', 'couple36@email.com');
        $secretSanta->addCouple('Player37', 'player37@email.com', 'Couple37', 'couple37@email.com');
        $secretSanta->addCouple('Player38', 'player38@email.com', 'Couple38', 'couple38@email.com');
        $secretSanta->addCouple('Player39', 'player39@email.com', 'Couple39', 'couple39@email.com');
        $secretSanta->addCouple('Player40', 'player40@email.com', 'Couple40', 'couple40@email.com');
        $secretSanta->addCouple('Player41', 'player41@email.com', 'Couple41', 'couple41@email.com');
        $secretSanta->addCouple('Player42', 'player42@email.com', 'Couple42', 'couple42@email.com');
        $secretSanta->addCouple('Player43', 'player43@email.com', 'Couple43', 'couple43@email.com');
        $secretSanta->addCouple('Player44', 'player44@email.com', 'Couple44', 'couple44@email.com');
        $secretSanta->addCouple('Player45', 'player45@email.com', 'Couple45', 'couple45@email.com');
        $secretSanta->addCouple('Player46', 'player46@email.com', 'Couple46', 'couple46@email.com');
        $secretSanta->addCouple('Player47', 'player47@email.com', 'Couple47', 'couple47@email.com');
        $secretSanta->addCouple('Player48', 'player48@email.com', 'Couple48', 'couple48@email.com');
        $secretSanta->addCouple('Player49', 'player49@email.com', 'Couple49', 'couple49@email.com');
        $secretSanta->addCouple('Player50', 'player50@email.com', 'Couple50', 'couple50@email.com');

        $combination = $secretSanta->play();

        $this->assertSame(100 , count($combination));
    }

    /**
     * @expectedException \SecretSanta\Exceptions\SecretSantaException
     */
    public function testExclusivePlayersEmpty()
    {
        $secretSanta = new SecretSanta();
        $secretSanta->addExclusivePlayers([]);
    }

    /**
     * @expectedException \SecretSanta\Exceptions\SecretSantaException
     */
    public function testExclusivePlayersOnlyOnePlayer()
    {
        $secretSanta = new SecretSanta();
        $secretSanta->addExclusivePlayers(
            ['Player', 'player@email.com']
        );
    }

    /**
     * @expectedException \SecretSanta\Exceptions\SecretSantaException
     */
    public function testExclusivePlayersSamePlayer()
    {
        $secretSanta = new SecretSanta();
        $secretSanta->addExclusivePlayers(
            ['Player', 'player@email.com'],
            ['Player', 'player@email.com']
        );
    }

    /**
     * @expectedException \SecretSanta\Exceptions\SecretSantaException
     */
    public function testExclusivePlayersInvalidPlayer()
    {
        $secretSanta = new SecretSanta();
        $secretSanta->addExclusivePlayers(
            ['', 'player@email.com'],
            ['Player', 'player@email.com']
        );
    }

    /**
     * @expectedException \SecretSanta\Exceptions\SecretSantaException
     */
    public function testExclusivePlayersTwoPlayers()
    {
        $secretSanta = new SecretSanta();
        $secretSanta->addExclusivePlayers(
            ['Player', 'player@email.com'],
            ['Player2', 'player2@email.com']
        );

        $secretSanta->play();
    }

    public function testFourExclusivePlayersAndFourSinglePlayers()
    {
        $secretSanta = new SecretSanta();
        $secretSanta->addExclusivePlayers(
            ['Player', 'player@email.com'],
            ['Player2', 'player2@email.com'],
            ['Player3', 'player3@email.com'],
            ['Player4', 'player4@email.com']
        );
        $secretSanta->addPlayer('Player5', 'player5@email.com');
        $secretSanta->addPlayer('Player6', 'player6@email.com');
        $secretSanta->addPlayer('Player7', 'player7@email.com');
        $secretSanta->addPlayer('Player8', 'player8@email.com');

        $combination = $secretSanta->play();

        $this->assertSame(8 , count($combination));
    }

    public function testFourExclusivePlayersAndFourSinglePlayersAndFourCouples()
    {
        $secretSanta = new SecretSanta();
        $secretSanta->addExclusivePlayers(
                ['Player', 'player@email.com'],
                ['Player2', 'player2@email.com'],
                ['Player3', 'player3@email.com'],
                ['Player4', 'player4@email.com']
            )
            ->addPlayer('Player5', 'player5@email.com')
            ->addPlayer('Player6', 'player6@email.com')
            ->addPlayer('Player7', 'player7@email.com')
            ->addPlayer('Player8', 'player8@email.com')
            ->addCouple('Player9', 'player9@email.com', 'Couple9', 'couple9@email.com')
            ->addCouple('Player10', 'player10@email.com', 'Couple10', 'couple10@email.com')
            ->addCouple('Player11', 'player11@email.com', 'Couple11', 'couple11@email.com')
            ->addCouple('Player12', 'player12@email.com', 'Couple12', 'couple12@email.com');

        $combination = $secretSanta->play();

        $this->assertSame(16 , count($combination));
    }
}
