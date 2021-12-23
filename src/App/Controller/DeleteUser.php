<?php

namespace App\Controller;

use Exception;
use Framework\Controller\AbstractController;
use Framework\Controller\UsersController;

class DeleteUser extends AbstractController
{
    public function __invoke(): string
    {

        if (!isset($_SESSION['user']) || $_SESSION['user']->getRole() != 1)
            header('Location: /');

        $userCont = new UsersController();
        if ($_SESSION['user']->getRole() == 1) {
            header('Content-type: application/json');
            try {
                $userCont->deleteUser($_POST['id_user']);
                $response_array['status'] = 'success';
            } catch (Exception $e) {
                $response_array['status'] = 'error';
                $response_array['exception'] = $e->getMessage();
            }
            return json_encode($response_array);
        } else
            header('Location: /');

        header('Location: /users');
    }
}
