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
        $userCont = new UsersController();

        $changePassword = false;

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
            $userCont->checkUser($_POST['email'], $_POST['passwordCheck']);
            $role = 2;
            $user->hydrate($_POST);
        } catch (Exception $e) {
            if ($_SESSION["user"]->getRole() == 1) {
                $role = 1;
                $user->hydrate($_POST);
            } else {
                header('Location: /');
            }
        }


        if (isset($_POST['changePassword'])) {
            if ($_POST['changePassword'] === 'on') {
                $changePassword = true;
            }
        }

        try {
            $userCont->updateUser($user, $role, $changePassword);
        } catch (Exception $e) {
            return $this->render('error.html.twig', [
                'error' => $e->getMessage(),
            ]);
        }

        header('Location: /profil');
    }
}
