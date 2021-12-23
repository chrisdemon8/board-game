<?php

namespace Framework\Metier;

use Framework\Controller\Objectify;
use Framework\Controller\Create;
use \DateTime;
use \Exception;

class User extends Modele implements Objectify, Create
{
    protected int $id_user;
    protected string $username;
    private string  $password;
    protected string $email;
    protected int $role;
    protected string $firstName;
    protected string $lastName;
    //protected string $createdAt;
    protected DateTime $createdAt;

    public function __construct()
    {
    }

    public function allDataSet(): bool
    {
        return  isset($this->role) &&  isset($this->username) &&  isset($this->password) &&  isset($this->email) &&  isset($this->firstName) &&  isset($this->lastName) && isset($this->createdAt);
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
        $user->setCreatedAt(date_format($date, "Y-m-d H:m:s"));

        return $user;
    }

    public static function Objectify($data): User
    {
        $user = new User();
        $user->hydrate($data);
        return $user;
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
    protected function setIdUser(int $id_user): void
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
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = $email;
        } else {
            throw new Exception("INVALID_MAIL");
        }
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
        if ($this->checkLettersOnly($firstName))
            $this->firstName = $firstName;
        else {
            throw new Exception("INVALID_FIRST_NAME");
        }
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
        if ($this->checkLettersOnly($lastName)) {
            $this->lastName = $lastName;
        } else {
            throw new Exception("INVALID_LASTNAME");
        }
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
    protected function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = date_create_from_format('Y-m-d H:i:s', $createdAt);
        $this->createdAt->getTimestamp();
    }
}
