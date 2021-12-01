<?php

namespace App\Controller;

use Exception;
use Framework\Controller\AbstractController;
use Framework\Controller\UsersController;
use Framework\Metier\User;

class checkUser extends AbstractController
{
    public function __invoke(): string
    { 
        $userCont = new UsersController();
        try {
            $bool = $userCont->checkUser($_GET['email'], $_GET['password']);
        } catch (Exception $e) {
            return $this->render('error.html.twig', [
                'error' => $e->getMessage(),
            ]);
        }

        if ($bool) {
            return $this->render('home.html.twig');
        } else
            return $this->render('user/connexion.html.twig');
    }
}
