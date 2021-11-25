<?php

namespace Framework\Controller;

use Framework\Metier\User;
use App\bdd\MyConnection;
use Framework\Controller\ErrorManager;
use \PDO;

class UsersController
{
    public ?\PDO $connection;
    public function __construct()
    {
        $this->connection = MyConnection::getInstance();
    }

    public function getUserById(int $id): User
    {
        $request = $this->connection->prepare('SELECT * FROM user WHERE id_user = :id');

        $request->bindValue(':id', $id, PDO::PARAM_INT);

        $request->execute();

        $user = $request->fetch();
        if ($user == null)
            ErrorManager::notExist('ID');
        return User::Objectify($user);
    }

    public function getAllUsers(): array
    {
        $request = $this->connection->prepare('SELECT * FROM user ');
        $request->execute();
        $usersData = $request->fetchAll();
        $users = [];
        foreach ($usersData as $userData) {
            $user = User::Objectify($userData);
            array_push($users, $user);
        }
        return $users;
    }
//TODO: a testé
    public function updateUser(User $user): void
    {
        $request = $this->connection->prepare('UPDATE user SET username = :username,password = :password,email = :email,role = :role, lastname = :lastname WHERE id_user = :id');

        $request->bindValue(':id', $user->getIdUser(), PDO::PARAM_INT);
        $request->bindValue(':username', $user->getUsername());
        $request->bindValue(':password', $user->getPassword());
        $request->bindValue(':email', $user->getEmail());
        $request->bindValue(':role', $user->getRole());

        $request->execute();
    }

    public function addUser(User $user): void
    {
        $messageError = '';

        //le 0 est la pour match le nombre d'arguement , il n'est pas mis dans la bdd
        $request = $this->connection->prepare('SELECT * FROM user WHERE email = :email');
        $request->bindValue(':email', $user->getEmail());
        $emailUnique = $request->execute();

        $request = $this->connection->prepare('SELECT * FROM user WHERE username = :username');
        $request->bindValue(':username', $user->getUsername());
        $usernameUnique = $request->execute();

        if ($emailUnique != NULL)
            $messageError .= 'ERROR_MAIL';
        if ($usernameUnique != NULL)
            $messageError .= '/ERROR_USERNAME';


        if ($messageError == '') {
            $request = $this->connection->prepare('INSERT INTO user VALUES (0,:username,:password,:email,:role,:firstname,:lastname,:createdAt)');

            $request->bindValue(':username', $user->getUsername());
            $request->bindValue(':password', $user->getPassword());
            $request->bindValue(':email', $user->getEmail());
            $request->bindValue(':role', $user->getRole());
            $request->bindValue(':firstname', $user->getFirstName());
            $request->bindValue(':lastname', $user->getLastName());
            $request->bindValue(':createdAt', $user->getCreatedAt()->format('Y-m-d H:i:s'), PDO::PARAM_STR);

            $request->execute();
        } else
            ErrorManager::CustomError($messageError);
    }
}
