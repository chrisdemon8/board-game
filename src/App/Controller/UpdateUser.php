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

        $user = $_SESSION["user"];

        $user->hydrate($_POST);
        

        echo "<pre>";
        var_dump($_POST); 

        var_dump($user);  
        try {
            $userCont->updateUser($user);
            echo"test"; 
        } catch (Exception $e) {
            return $this->render('error.html.twig', [
                'error' => $e->getMessage(),
            ]);
        }

        header('Location: /profil');
    }
}
