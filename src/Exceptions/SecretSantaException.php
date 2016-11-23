<?php

namespace SecretSanta\Exceptions;

/**
 * Class SecretSantaException
 * @package SecretSanta\Exceptions
 */
class SecretSantaException extends \Exception
{
    /**
     * SecretSantaException constructor.
     * @param string $message
     * @param \Exception|null $previous
     */
    public function __construct($message, \Exception $previous = null)
    {
        parent::__construct($message, 0, $previous);
    }
}
