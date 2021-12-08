<?php

namespace App\Controller;

use Framework\Controller\AbstractController;
use Framework\Controller\UsersController;

use \Exception;
use Framework\Controller\QuestionController;

class GetQuestion extends AbstractController
{
    private QuestionController $questionCont;

    public function __invoke(): string
    {
        try {
            $content = trim(file_get_contents("php://input"));

            $data = json_decode($content, true);
            $data['success'] = true; 
            
            if ($data['success'])
                $id_question = $data['data']['id_question'];

            $this->questionCont = new QuestionController();
            $question = $this->questionCont->getQuestionById($id_question);
            header('Content-type: application/json');
            return json_encode($question->jsonSerialize());
        } catch (Exception $e) {
            return $this->render('error.html.twig', [
                'error' => $e->getMessage(),
            ]);
        }
        return '';
    }
}
