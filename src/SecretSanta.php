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
     * @return array
     */
    public function play()
    {
        $this->combinePlayers();

        $result = [];
        if ($this->isValidCombination()) {
            foreach ($this->combination as $playerId => $secretPlayerId) {
                $result[] = [
                    'player' => $this->players->player($playerId),
                    'secretPlayer' => $this->players->player($secretPlayerId)
                ];
            }
        }

        return $result;
    }

    /**
     * @throws SecretSantaException
     */
    private function combinePlayers()
    {
        $retry = 0;
        $this->combination = [];

        while (!$this->isValidCombination() && $retry < (count($this->players)*2)) {
            $retry++;
            $players = $this->players->players();
            $secretPlayers = $this->players->players();
            shuffle($players);
            shuffle($secretPlayers);
            foreach ($players as $player) {
                foreach ($secretPlayers as $secretPlayer) {
                    if ($player->id() != $secretPlayer->id() && !$this->players->areExclude($player, $secretPlayer)) {
                        if (!in_array($secretPlayer->id(), $this->combination)) {
                            $combination[$player->id()] = $secretPlayer->id();
                            break;
                        }
                    }
                }
            }
        }

        if (!$this->isValidCombination()) {
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
