<?php

namespace App\Controller;

use Framework\Controller\AbstractController;
use Framework\Controller\QuestionController;
use \Exception;


class GetQuestions extends AbstractController
{
    private QuestionController $questionCont;
    public function __invoke(): string
    {
        try {
            $this->questionCont = new QuestionController();
            $questions = $this->questionCont->getAllQuestionsJson(); 
            return json_encode($questions);
        } catch (Exception $e) {
            return $this->render('error.html.twig', [
                'error' => $e->getMessage(),
            ]);
        }
        return '';
    }
}
