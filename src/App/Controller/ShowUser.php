<?php

namespace App\Controller;

use Framework\Controller\AbstractController;
use Framework\Controller\UsersController;

use \Exception;

class ShowUser extends AbstractController
{
    private UsersController $userCont;

    public function __invoke(int $id): string
    {
        try {
            $this->userCont = new UsersController();
            $user = $this->userCont->getUserById($id);

            //Pas forcément utile on peut juste passer $user en paramètre
            return $this->render('/user/user.html.twig', [
                'username' => $user->getUsername(),
                'email' => $user->getEmail(),
                'role' =>$user->getRole(),
                'firstname' =>$user->getFirstName(),
                'lastname' =>$user->getLastName(),
                'createdAt' =>date_format($user->getCreatedAt(),'Y-m-d H:i:s'),
            ]);
        } catch (Exception $e) {
            return $this->render('error.html.twig', [
                'error' => $e->getMessage(),
            ]);
        }
        return '';
    }
}
