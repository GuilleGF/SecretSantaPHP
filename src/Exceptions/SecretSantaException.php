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
     * @param int $code
     * @param \Exception|null $previous
     */
    public function __construct($message, $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
