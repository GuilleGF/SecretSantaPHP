<?php

namespace SecretSanta\Exceptions;

/**
 * Class PlayerException
 * @package SecretSanta\Exceptions
 */
class PlayerException extends \Exception
{
    /**
     * PlayerException constructor.
     * @param string $message
     * @param \Exception|null $previous
     */
    public function __construct($message, \Exception $previous = null)
    {
        parent::__construct($message, 0, $previous);
    }
}
