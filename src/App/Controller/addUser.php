<?php

namespace App\Controller;

use Exception;
use Framework\Controller\AbstractController;
use Framework\Controller\UsersController;
use Framework\Metier\User;

class addUser extends AbstractController
{
    public function __invoke(): string
    {
        $userCont = new UsersController();
        $user = user::create($_GET);
        try {
            $userCont->addUser($user);
        } catch (Exception $e) {
            return $this->render('error.html.twig', [
                'error' => $e->getMessage(),
            ]);
        }
        var_dump($user);


        return $this->render('home.html.twig');
    }
}
