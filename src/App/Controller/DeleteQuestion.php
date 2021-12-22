<?php

namespace App\Controller;

use Exception;
use Framework\Controller\AbstractController;
use Framework\Controller\QuestionController;

class DeleteQuestion extends AbstractController
{
    public function __invoke(): string
    {

        if (!isset($_SESSION['user']) || $_SESSION['user']->getRole() != 1)
            header('Location: /');

        $questCont = new QuestionController();
        if ($_SESSION['user']->getRole() === 1) {
            header('Content-type: application/json');
            try {
                $questCont->deleteQuestion($_POST['id_question']);
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
