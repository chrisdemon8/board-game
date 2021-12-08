<?php

namespace App\Controller;

use Exception;
use Framework\Controller\AbstractController;
use Framework\Controller\UsersController;

class DeleteUser extends AbstractController
{
    public function __invoke(): string
    {

        if(isset($_SESSION)&& $_SESSION['user']->getRole()!=1)
            header('Location: /');
            
        $userCont = new UsersController();
        if ($_SESSION['user']->getRole() == 1) {
            try {
                $userCont->deleteUser($_POST['id_user']);
            } catch (Exception $e) {
                return $this->render('user/connexion.html.twig', [
                    'error' => $e->getMessage(),
                ]);
            }
        }else   
            header('Location: /'); 

        header('Location: /users');
    }
}
