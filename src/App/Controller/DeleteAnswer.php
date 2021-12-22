<?php

namespace App\Controller;

use Exception;
use Framework\Controller\AbstractController;
use Framework\Controller\AnswerController;

class DeleteAnswer extends AbstractController
{
    public function __invoke(): string
    {

        if (!isset($_SESSION['user']) || $_SESSION['user']->getRole() != 1)
            header('Location: /');

        $content = trim(file_get_contents("php://input"));

        $data = json_decode($content, true);
        $data['success'] = true;

        if ($data['success'])
            $id_answer = $data['jsonData']['id_answer'];


        $answerCont = new AnswerController();
        header('Content-type: application/json');
        
        if ($_SESSION['user']->getRole() === 1) {
            try {
                $answerCont->deleteAnswer($id_answer);
                $response_array['status'] = 'success';
            } catch (Exception $e) {
                $response_array['status'] = 'error';
                $response_array['exception'] = $e->getMessage();
            }
            return json_encode($response_array);
        } else
            header('Location: /');
        return '';
    }
}
