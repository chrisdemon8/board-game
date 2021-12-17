<?php

namespace App\Controller;

use Exception;
use Framework\Controller\AbstractController;
use Framework\Controller\UsersController;
use Framework\Metier\User;

class CheckUser extends AbstractController
{
    public function __invoke(): string
    {
        $userCont = new UsersController();
        try {
            $usernameId = $userCont->checkUser($_POST['email'], $_POST['password']);
            $user = $userCont->getUserById($usernameId);
        } catch (Exception $e) {
            return $this->render('user/connexion.html.twig', [
                'error' => $e->getMessage(),
            ]);
        }

        $_SESSION['user'] = $user;
        if ($user->getRole() === 1)
            header('Location: /admin');
        else
            header('Location: /');
    }
}
