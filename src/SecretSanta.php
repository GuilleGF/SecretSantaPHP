<?php

namespace SecretSanta;

use SecretSanta\Exceptions\SecretSantaException;

/**
 * Class SecretSanta
 * @package SecretSanta
 */
class SecretSanta
{
    /** @var PlayersCollection */
    private $players;
    /** @var  array */
    private $combination;

    /**
     * SecretSanta constructor.
     */
    public function __construct()
    {
        $this->players = new PlayersCollection();
    }

    /**
     * @param string $name
     * @param string $email
     * @return SecretSanta
     */
    public function addPlayer($name, $email)
    {
        $this->players->addPlayer(Player::create($name, $email));

        return $this;
    }

    /**
     * @param string $name
     * @param string $email
     * @param string $coupleName
     * @param string $coupleEmail
     * @return SecretSanta
     */
    public function addCouple($name, $email, $coupleName, $coupleEmail)
    {
        $this->players->addCouple(
            Player::create($name, $email),
            Player::create($coupleName, $coupleEmail)
        );

        return $this;
    }

    /**
     * @return PlayersCollection
     * @throws SecretSantaException
     */
    public function play()
    {
        try {
            $this->combinePlayers();

            return $this->players;
        } catch (SecretSantaException $exception) {
            throw  $exception;
        } catch (\Exception $exception) {
            throw new SecretSantaException(
                'Error during play, impossible to find secret santa, try again',
                0,
                $exception
            );
        }
    }

    /**
     * @throws SecretSantaException
     */
    private function combinePlayers()
    {
        if (count($this->players) < 4) {
            throw new SecretSantaException("Not enough players to play, at least 4 players are required");
        }

        $retry = count($this->players) + $this->players->countExcludePlayers();

        while (!$this->isValidCombination() && $retry > 0 ) {
            $this->combination = [];
            $secretPlayers = $this->players->shufflePlayers();
            foreach ($this->players as $playerId => $player) {
                foreach ($secretPlayers as $secretPlayer) {
                    if ($player->id() != $secretPlayer->id() && !$this->players->areExclude($player, $secretPlayer)) {
                        if (!in_array($secretPlayer->id(), $this->combination)) {
                            $player->setSecretSanta($secretPlayer);
                            $this->combination[$player->id()] = $secretPlayer->id();
                            unset ($secretPlayers[$secretPlayer->id()]);
                            break;
                        }
                    }
                }
            }
            $retry--;
        }

        if (!$this->isValidCombination() && $retry <= 0) {
            throw new SecretSantaException("Not enough players to play");
        }
    }

    /**
     * @return bool
     */
    private function isValidCombination()
    {
        return count($this->combination) > 0 && count($this->combination) == count($this->players);
    }
}
