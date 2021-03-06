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


        header('Content-type: application/json');
        try {

            $content = trim(file_get_contents("php://input"));

            $data = json_decode($content, true);
            $data['success'] = true;

            if ($data['success'])
                $id_user = $data['data']['id_user'];


            $this->userCont = new UsersController();
            $user = $this->userCont->getUserById($id_user);

            $response_array['status'] = 'success';
            $response_array['res'] = $user->jsonSerialize();
        } catch (Exception $e) {
            $response_array['status'] = 'error';
            $response_array['exception'] = $e->getMessage();
        }
        return json_encode($response_array);
    }
}
