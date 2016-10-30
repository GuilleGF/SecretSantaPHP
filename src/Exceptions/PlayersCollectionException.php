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
     * @param int $code
     * @param \Exception|null $previous
     */
    public function __construct($message, $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}