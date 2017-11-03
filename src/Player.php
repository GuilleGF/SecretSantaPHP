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
    /** @var Player */
    private $secretSanta;

    /**
     * Player constructor.
     * @param string $name
     * @param string $email
     */
    private function __construct(string $name, string $email)
    {
        $this->setName($name);
        $this->setEmail($email);
    }

    /**
     * @param string $name
     * @param string $email
     * @return Player
     */
    public static function create(string $name, string $email)
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
     * @throws PlayerException
     * @return Player
     */
    public function secretSanta()
    {
        if (is_null($this->secretSanta)) {
            throw new PlayerException("Secret Santa is not yet generated");
        }
        
        return $this->secretSanta;
    }
    
    /**
     * @param Player $secretSanta
     * @return Player
     */
    public function setSecretSanta(Player $secretSanta)
    {
        $this->secretSanta = $secretSanta;
        
        return $this;
    }

    /**
     * @param string $name
     * @throws PlayerException
     * @return Player
     */
    private function setName(string $name)
    {
        if (strlen($name) < 3) {
            throw new PlayerException("Name must have more than 3 characters");
        }

        $this->name = $name;
        
        return $this;
    }

    /**
     * @param string $email
     * @throws PlayerException
     * @return Player
     */
    private function setEmail(string $email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            throw new PlayerException("Email must be a valid format");
        }

        $this->email = $email;
        
        return $this;
    }

    /**
     * @return Player
     */
    private function generateId()
    {
        $this->id = Uuid::uuid5(Uuid::NAMESPACE_DNS, $this->email)->toString();
        
        return $this;
    }
}
