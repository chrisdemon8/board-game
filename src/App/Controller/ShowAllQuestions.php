<?php

namespace App\Controller;

use Framework\Controller\AbstractController;
use Framework\Controller\QuestionController;
use \Exception;


class ShowAllQuestions extends AbstractController
{
    private QuestionController $questionCont;
    public function __invoke(): string
    {
        if(!isset($_SESSION['user']) || $_SESSION['user']->getRole()!=1)
            header('Location: /');
        try {
            $this->questionCont = new QuestionController();
            $questions = $this->questionCont->getAllQuestions(); 
            return $this->render('/question/questions.html.twig', [
                'questions' => $questions,
            ]);
        } catch (Exception $e) {
            return $this->render('error.html.twig', [
                'error' => $e->getMessage(),
            ]);
        }
        return '';
    }
}
