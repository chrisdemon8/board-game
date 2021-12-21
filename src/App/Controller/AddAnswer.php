<?php

namespace App\Controller;

use Exception;
use Framework\Controller\AbstractController;
use Framework\Controller\AnswerController;
use Framework\Metier\Answer;

class AddAnswer extends AbstractController
{
    public function __invoke(): string
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']->getRole() != 1)
            header('Location: /');
        $content = trim(file_get_contents("php://input"));

        $data = json_decode($content, true);
        $data['success'] = true;
        if ($data['success'] === true) {
            $data = $data["jsonData"];
        }

        header('Content-type: application/json');
        try {
            $answerController = new AnswerController();
            $answer = Answer::Objectify($data);
            $answerController->addAnswer($answer);
            $response_array['status'] = 'success';
        } catch (Exception $e) {
            $response_array['status'] = 'error';
            $response_array['exception'] = $e->getMessage();
        }

        return json_encode($response_array);
    }
}
