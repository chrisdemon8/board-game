<?php

namespace Framework\Metier;

use Framework\Controller\Objectify;
use Framework\Controller\Create;
use \DateTime;
use \Exception;

class User implements Objectify, Create
{
    private int $id_user;
    private string $username;
    private string  $password;
    private string $email;
    private int $role;
    private string $firstName;
    private string $lastName;
    private Datetime $createdAt;

    public function __construct()
    {
    }

    public function jsonSerialize() {
        return [
            'idUser' => $this->getIdUser(),
            'username' => $this->getUsername(),
            'email' => $this->getEmail(),
            'role' => $this->getRole(),
            'firstName' => $this->getFirstName(),
            'lastName' => $this->getLastName(), 
            'createdAt' => $this->getCreatedAt(),
        ];
    }


    public static function create($data): User
    {
        $user = new User();

        if ($data == NULL)
            throw new Exception("Données non conforme !");
        $user->hydrate($data);
        //set de base a user
        $user->setRole(2);

        //set automatique de la date
        date_default_timezone_set('Europe/Paris');
        $date = new DateTime();
        $user->setCreatedAt(date_format($date, "Y-m-j H:m:s"));

        return $user;
    }

    public static function Objectify($data): User
    {
        $user = new User();
        $user->hydrate($data);
        return $user;
    }

    public function hydrate($data): void
    {
        foreach ($data as $attribute => $value) {
            $method = 'set' . str_replace(' ', '', ucwords(str_replace('_', ' ', $attribute)));
            if (is_callable(array($this, $method))) {
                $this->$method($value);
            }
        }
    }

    /**
     * @return int
     */
    public function getIdUser(): int
    {
        return $this->id_user;
    }

    /**
     * @param int $id_user
     */
    private function setIdUser(int $id_user): void
    {
        $this->id_user = $id_user;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return int
     */
    public function getRole(): int
    {
        return $this->role;
    }

    /**
     * @param int $role
     */
    public function setRole(int $role): void
    {
        $this->role = $role;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }


    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }


    /**
     * @param string $createdAt
     */
    private function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = date_create_from_format('Y-m-d H:i:s', $createdAt);
        $this->createdAt->getTimestamp();
    }
}
