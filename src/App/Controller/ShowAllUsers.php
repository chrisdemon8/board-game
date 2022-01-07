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
        if (!isset($_SESSION['user']) || $_SESSION['user']->getRole() != 1)
            header('Location: /');

        try {
            $this->userCont = new UsersController();
            $users = $this->userCont->getAllUsers();
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
