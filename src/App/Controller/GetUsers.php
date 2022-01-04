<?php

namespace App\Controller;

use Framework\Controller\AbstractController;
use \Exception;
use Framework\Controller\UsersController;
use Framework\Metier\User;

class GetUsers extends AbstractController
{
    private UsersController $userCont;
    public function __invoke(): string
    {

        if (!isset($_SESSION['user']))
            header('Location: /');


        header('Content-type: application/json');
        try {
            $this->userCont = new UsersController();
            $users = $this->userCont->getAllUsersJSON();
            $response_array['status'] = 'success';
            $response_array['res'] = $users;
        } catch (Exception $e) {
            $response_array['status'] = 'error';
            $response_array['exception'] = $e->getMessage();
        }

        return json_encode($response_array);
    }
}
