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
     * @param int $code
     * @param \Exception|null $previous
     */
    public function __construct($message, $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
