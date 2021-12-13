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
        if (isset($_SESSION["user"]))
            header('Location: /');
        try {

            $content = trim(file_get_contents("php://input"));

            $data = json_decode($content, true);
            $data['success'] = true;




            if ($data['success'])
                $data = $data['jsonData'];

            $userCont = new UsersController();
            $user = user::create($data);
            $userCont->AddUser($user);
            return true; 
        } catch (Exception $e) {
            return  $e->getMessage();
        }

 
    }
}
