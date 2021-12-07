<?php

namespace App\Controller;

use Framework\Controller\AbstractController;
use Framework\Controller\UsersController;

use \Exception;
use Framework\Metier\User;

class GetUser extends AbstractController
{
    private UsersController $userCont;

    public function __invoke(): string
    {
        try {
            $this->userCont = new UsersController();
            $user = $this->userCont->getUserById($_POST['id_user']);
            
            return json_encode($user->jsonSerialize()); 
        } catch (Exception $e) {
            return $this->render('error.html.twig', [
                'error' => $e->getMessage(),
            ]);
        }
        return '';  
    }
}
