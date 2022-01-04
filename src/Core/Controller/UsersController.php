<?php

namespace Framework\Controller;

use Framework\Metier\User;
use App\bdd\MyConnection;
use Framework\Controller\ErrorManager;
use \PDO;

class UsersController extends AbstractControllerBdd
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


    public function getUserByUsername(string $username): User
    {
        $request = $this->connection->prepare('SELECT * FROM user WHERE username = :username');

        $request->bindValue(':username', $username);

        $request->execute();

        $user = $request->fetch();
        if ($user == null)
            ErrorManager::notExist('USERNAME');
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

    public function getAllUsersJSON(): array
    {
        $request = $this->connection->prepare('SELECT * FROM user ');
        $request->execute();
        $usersData = $request->fetchAll();
        $users = [];
        foreach ($usersData as $userData) {
            $user = User::Objectify($userData);
            array_push($users, $user->jsonSerialize());
        }
        return $users;
    }

    public function verifyUniqueEmail($email): bool
    {
        $request = $this->connection->prepare('SELECT COUNT(*) as exist FROM user WHERE email =:email');
        $request->bindValue(':email', $email);
        $request->execute();
        $user = $request->fetch();

        if ($user['exist'] > 0) {
            $messageError = 'email deja utilise';
            ErrorManager::CustomError($messageError);
            return false;
        }
        return true;
    }

    public function ExistByMail($email): bool
    {
        $request = $this->connection->prepare('SELECT COUNT(*) as exist FROM user WHERE email =:email');
        $request->bindValue(':email', $email);
        $request->execute();
        $user = $request->fetch();

        if ( $user['exist'] != 1 ) {
            $messageError = 'user non existant';
            ErrorManager::CustomError($messageError);
            return false;
        }
        return true;
    }

    public function ExistByUsername($pseudo): bool
    {
        $request = $this->connection->prepare('SELECT COUNT(*) as exist FROM user WHERE username =:username');
        $request->bindValue(':username', $pseudo);
        $request->execute();
        $user = $request->fetch();

        if ( $user['exist'] != 1 ) {
            $messageError = 'user non existant';
            ErrorManager::CustomError($messageError);
            return false;
        }
        return true;
    }

    public function checkUser(string $email, string $password): int
    {
        $request = $this->connection->prepare('SELECT id_user, password FROM user WHERE email = :email OR username =:email');

        $request->bindValue(':email', $email);

        $request->execute();
        $user = $request->fetch();

        if (!$user) {
            $messageError = 'Identifiant incorrect';
            ErrorManager::CustomError($messageError);
            return false;
        }
        if (!password_verify($password, $user["password"])) {
            $messageError = 'Mot de passe incorrect';
            ErrorManager::CustomError($messageError);
            return false;
        };

        return $user["id_user"];
    }
    //TODO: a testé
    public function updateUser(User $user, int $role, bool $changePassword): void
    {

        $this->conform($user);

        $messageError = "";
        $request = $this->connection->prepare('SELECT COUNT(*) as exist FROM user WHERE email = :email AND NOT id_user = :id_user');
        $request->bindValue(':email', $user->getEmail());
        $request->bindValue(':id_user', $user->getIdUser());

        if (!$request->execute()) {
            $messageError .= "ERROR SQL 1";
        };

        $emailUnique = $request->fetch();

        if ($emailUnique["exist"] > 0)
            $messageError .= 'ERROR_MAIL';

        if ($messageError == '') {
            if ($role === 1) {
                $sql = "UPDATE user SET email = :email,role = :role, lastname = :lastname, firstname = :firstname WHERE id_user = :id";
            } else if ($changePassword && $role == 2) {
                $sql = "UPDATE user SET password = :password,email = :email, lastname = :lastname, firstname = :firstname WHERE id_user = :id";
            } else {
                $sql = "UPDATE user SET email = :email, lastname = :lastname, firstname = :firstname WHERE id_user = :id";
            }

            $request = $this->connection->prepare($sql);

            $request->bindValue(':id', $user->getIdUser(), PDO::PARAM_INT);
            $request->bindValue(':email', $user->getEmail());
            $request->bindValue(':firstname', $user->getFirstName());
            $request->bindValue(':lastname', $user->getLastName());

            if ($role === 1)
                $request->bindValue(':role', $user->getRole());
            else {
                if ($changePassword && $role === 2)
                    $request->bindValue(':password', password_hash($user->getPassword(), PASSWORD_DEFAULT));
            }


            $request->execute();
        } else
            ErrorManager::CustomError($messageError);
    }

    public function countUsers(): int
    {
        $request = $this->connection->prepare('SELECT COUNT(*) as number FROM user ');
        $request->execute();
        $number = $request->fetch();

        if ($number['number'] > 0)
            return $number['number'];

        return 0;
    }


    public function deleteUser(int $id_user): void
    {
        $request = $this->connection->prepare('DELETE FROM `user` WHERE id_user = :id');
        $request->bindValue(':id', $id_user);
        $request->execute();
    }



    public function AddUser(User $user): void
    {
        $messageError = '';
        $this->conform($user);

        //le 0 est la pour match le nombre d'arguement , il n'est pas mis dans la bdd
        $request = $this->connection->prepare('SELECT COUNT(*) as exist FROM user WHERE email = :email');
        $request->bindValue(':email', $user->getEmail());

        if (!$request->execute()) {
            $messageError .= "ERROR SQL 1";
        };

        $emailUnique = $request->fetch();

        $request = $this->connection->prepare('SELECT COUNT(*) as exist FROM user WHERE username = :username');
        $request->bindValue(':username', $user->getUsername());


        if (!$request->execute()) {
            $messageError .= "ERROR SQL 2";
        };

        $usernameUnique = $request->fetch();

        if ($emailUnique["exist"] > 0)
            $messageError .= 'ERROR_MAIL';
        if ($usernameUnique["exist"] > 0)
            $messageError .= '/ERROR_USERNAME';


        if ($messageError == '') {
            $request = $this->connection->prepare('INSERT INTO user VALUES (0,:username,:password,:email,:role,:firstname,:lastname,:createdAt)');

            $request->bindValue(':username', $user->getUsername());
            $request->bindValue(':password', password_hash($user->getPassword(), PASSWORD_DEFAULT));
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
