<?php

namespace SecretSanta\Exceptions;

/**
 * Class PlayersCollectionException
 * @package SecretSanta\Exceptions
 */
class PlayersCollectionException extends \Exception
{
    /**
     * PlayersCollectionException constructor.
     * @param string $message
     * @param \Exception|null $previous
     */
    public function __construct($message, \Exception $previous = null)
    {
        parent::__construct($message, 0, $previous);
    }
}