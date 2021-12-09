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

        $content = trim(file_get_contents("php://input"));

        $data = json_decode($content, true);
        $data['success'] = true;
        if ($data['success'] === true) {
            $data = $data["jsonData"];
        }

        try {
            $answerController = new AnswerController();
            $answer = Answer::Objectify($data);
            $answerController->addAnswer($answer);
        } catch (Exception $e) {
            return $this->render('error.html.twig', [
                'error' => $e->getMessage(),
            ]);
        }
 
    }
}
