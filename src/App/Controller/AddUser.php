<?php

namespace App\Controller;

use Exception;
use Framework\Controller\AbstractController;
use Framework\Controller\UsersController;
use Framework\Metier\User;

class AddUser extends AbstractController
{
    public function __invoke(): string
    {
     if(isset($_SESSION))
        header('Location: /');
        try {
            $userCont = new UsersController();
            $user = user::create($_GET);
            $userCont->addUser($user);
        } catch (Exception $e) {
            return $this->render('error.html.twig', [
                'error' => $e->getMessage(),
            ]);
        }


        header('Location: /connexion');
    }
}
