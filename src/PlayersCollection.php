<?php

namespace SecretSanta;

use SecretSanta\Exceptions\PlayersCollectionException;

/**
 * Class PlayersCollection
 * @package SecretSanta
 */
class PlayersCollection implements \Countable
{
    /** @var Player[] */
    private $players = [];
    /** @var array  */
    private $excludePlayers = [];

    /**
     * @param Player $player
     * @throws PlayersCollectionException
     */
    public function addPlayer(Player $player)
    {
        if (!$this->isDuplicatePlayer($player)) {
            $this->players[$player->id()] = $player;
        }
    }

    /**
     * @param Player $player
     * @param Player $couple
     * @throws PlayersCollectionException
     */
    public function addCouple(Player $player, Player $couple)
    {
        if (!$this->areDifferentPlayers($player, $couple)) {
            throw  new PlayersCollectionException('The couple can not be the same player');
        }

        if (!$this->isDuplicatePlayer($player) && !$this->isDuplicatePlayer($couple) ) {
            $this->players[$player->id()] = $player;
            $this->players[$couple->id()] = $couple;

            $this->excludePlayers($player, $couple);
        }
    }

    /**
     * @return Player[]
     */
    public function players()
    {
        return $this->players;
    }

    /**
     * @return Player[]
     */
    public function shufflePlayers()
    {
        return $this->shuffleAssoc($this->players);
    }

    /**
     * @param string $id
     * @return Player
     * @throws PlayersCollectionException
     */
    public function player($id)
    {
        if (!isset($this->players[$id])) {
            throw new PlayersCollectionException("Player {$id} not found");
        }

        return $this->players[$id];
    }


    /**
     * @param Player[] ...$players
     */
    private function excludePlayers(...$players)
    {
        foreach ($players as $mainPlayer) {
            foreach ($players as $player) {
                if ($mainPlayer->id() == $player->id()){
                    continue;
                }
                $this->excludePlayers[$mainPlayer->id()][] = $player->id();
            }
        }
    }

    /**
     * @param Player $player
     * @param Player $player2
     * @return bool
     */
    public function areExclude(Player $player, Player $player2)
    {
        if (array_key_exists($player->id(), $this->excludePlayers)
            && in_array($player2->id(), $this->excludePlayers[$player->id()])
        ) {
            return true;
        }

        return false;
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->players);
    }

    /**
     * @return int
     */
    public function countExcludePlayers()
    {
        return count($this->excludePlayers);
    }


    /**
     * @param Player $player
     * @return bool
     * @throws PlayersCollectionException
     */
    private function isDuplicatePlayer(Player $player)
    {
        if (array_key_exists($player->id(), $this->players)) {
            throw  new PlayersCollectionException('Duplicate player: '.$player->email());
        }

        return false;
    }

    /**
     * @param Player $player
     * @param Player $otherPlayer
     * @return bool
     */
    private function areDifferentPlayers(Player $player, Player $otherPlayer)
    {
        return $player->id() != $otherPlayer->id();
    }

    /**
     * @param array $list
     * @return array
     */
    private function shuffleAssoc($list)
    {
        if (!is_array($list)) return $list;

        $keys = $this->forceShuffle(array_keys($list));
        $random = [];
        foreach ($keys as $key) {
            $random[$key] = $list[$key];
        }

        return $random;
    }

    /**
     * @param array $list
     * @return array
     */
    private function forceShuffle($list)
    {
        if (!is_array($list) || count($list) < 2) return $list;

        $shuffleList = $list;
        while ($shuffleList == $list) {
            shuffle($shuffleList);
        }

        return $shuffleList;
    }
}