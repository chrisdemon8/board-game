<?php

namespace App\Controller;

use Framework\Controller\AbstractController;
use Framework\Controller\UsersController;

use \Exception;

class ShowAllUsers extends AbstractController
{
    private UsersController $userCont;

    public function __invoke(): string
    {
        try {
            $this->userCont = new UsersController();
            $users = $this->userCont->getAllUser();

            return $this->render('/user/users.html.twig', [
                'users' => $users,
            ]);
        } catch (Exception $e) {
            return $this->render('error.html.twig', [
                'error' => $e->getMessage(),
            ]);
        }
        return '';
    }
}
