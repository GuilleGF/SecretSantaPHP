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
    private $exclusivePlayers = [];

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
        if (!$this->areDifferentPlayers([$player, $couple])) {
            throw new PlayersCollectionException('The couple can not be the same player');
        }

        if (!$this->isDuplicatePlayer($player) && !$this->isDuplicatePlayer($couple) ) {
            $this->players[$player->id()] = $player;
            $this->players[$couple->id()] = $couple;

            $this->exclusivePlayers([$player, $couple]);
        }
    }

    /**
     * @param Player[] $players
     * @throws PlayersCollectionException
     */
    public function addExclusivePlayers(array $players)
    {
        if (!$this->areDifferentPlayers($players)) {
            throw new PlayersCollectionException('The players must be different');
        }

        foreach ($players as $player) {
            if (!$this->isDuplicatePlayer($player)) {
                $this->players[$player->id()] = $player;
            }
        }

        $this->exclusivePlayers($players);
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
     * @param Player[] $players
     */
    private function exclusivePlayers($players)
    {
        foreach ($players as $mainPlayer) {
            foreach ($players as $player) {
                if ($mainPlayer->id() == $player->id()){
                    continue;
                }
                $this->exclusivePlayers[$mainPlayer->id()][] = $player->id();
            }
        }
    }

    /**
     * @param Player $player
     * @param Player $player2
     * @return bool
     */
    public function areExclusive(Player $player, Player $player2)
    {
        if (array_key_exists($player->id(), $this->exclusivePlayers)
            && in_array($player2->id(), $this->exclusivePlayers[$player->id()])
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
    public function countExclusivePlayers()
    {
        return count($this->exclusivePlayers);
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
     * @param Player[] $players
     * @return bool
     */
    private function areDifferentPlayers(array $players)
    {
        $uniqueIds = [];
        foreach ($players as $player) {
            $uniqueIds[] = $player->id();
        }

        return count($players) == count(array_unique($uniqueIds));
    }

    /**
     * @param array $list
     * @return array
     */
    private function shuffleAssoc(array $list)
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
    private function forceShuffle(array $list)
    {
        if (!is_array($list) || count($list) < 2) return $list;

        $shuffleList = $list;
        while ($shuffleList == $list) {
            shuffle($shuffleList);
        }

        return $shuffleList;
    }
}