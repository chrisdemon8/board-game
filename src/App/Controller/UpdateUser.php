<?php

namespace App\Controller;

use Exception;
use Framework\Controller\AbstractController;
use Framework\Controller\UsersController;
use Framework\Metier\User;

class UpdateUser extends AbstractController
{
    public function __invoke(): string
    {
        if (!isset($_SESSION['user']))
            header('Location: /');

        $userCont = new UsersController();

        $updatebyadmin = false;

        $changePassword = false;

        if (isset($_POST["jsonData"])) {
            $valueJSON = json_decode($_POST["jsonData"]);
            foreach ($valueJSON as $key => $value) {
                $_POST[$key] = $value;
            }

            $user = $userCont->getUserById($_POST['id_user']);
        } else
            $user = $_SESSION["user"];

        if ($_POST['email'] != $user->getEmail()) {
            try {
                $userCont->verifyUniqueEmail($_POST['email']);
            } catch (Exception $e) {
                return $this->render('error.html.twig', [
                    'error' => $e->getMessage(),
                ]);
            }
        }


        try {
            if (!isset($_POST['passwordCheck']))
                $_POST['passwordCheck'] = "0";
            $userCont->checkUser($_POST['email'], $_POST['passwordCheck']);
            $role = 2;
            $user->hydrate($_POST);
            $user->setPassword(password_hash($_POST['passwordCheck'], PASSWORD_DEFAULT));
        } catch (Exception $e) {
            if ($_SESSION["user"]->getRole() == 1) {
                $role = 1;
                $user->hydrate($_POST);
                $updatebyadmin = true;
            } else {
                header('Location: /');
            }
        }


        if (isset($_POST['changePassword'])) {
            if ($_POST['changePassword'] === 'on') {
                $changePassword = true;
            }
        }

        
        var_dump($user); 

        try {
            $userCont->updateUser($user, $role, $changePassword);
        } catch (Exception $e) {
            return $this->render('error.html.twig', [
                'error' => $e->getMessage(),
            ]);
        }



        if ($updatebyadmin) {
            return "true";
        } else
            header('Location: /profil');
    }
}
