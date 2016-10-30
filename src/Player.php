<?php

namespace SecretSanta;

use SecretSanta\Exceptions\PlayerException;
use Ramsey\Uuid\Uuid;

/**
 * Class Player
 * @package SecretSanta
 */
class Player
{
    /** @var string */
    private $id;
    /** @var string */
    private $name;
    /** @var string */
    private $email;

    /**
     * Player constructor.
     * @param string $name
     * @param string $email
     */
    private function __construct($name, $email)
    {
        $this->setName($name);
        $this->setEmail($email);
    }

    /**
     * @param string $name
     * @param string $email
     * @return Player
     */
    public static function create($name, $email)
    {
        return new self($name, $email);
    }

    /**
     * @return string
     */
    public function id()
    {
        if (is_null($this->id)) {
            $this->generateId();
        }

        return $this->id;
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function email()
    {
        return $this->email;
    }

    /**
     * @param string $name
     * @throws PlayerException
     */
    private function setName($name)
    {
        if (!is_string($name)) {
            throw new PlayerException("Name must be a string");
        }
        if (strlen($name) < 3) {
            throw new PlayerException("Name must have more than 3 characters");
        }

        $this->name = $name;
    }

    /**
     * @param string $email
     * @throws PlayerException
     */
    private function setEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            throw new PlayerException("Email must be a valid format");
        }

        $this->email = $email;
    }

    private function generateId()
    {
        $this->id = Uuid::uuid5(Uuid::NAMESPACE_DNS, $this->email)->toString();
    }
}
