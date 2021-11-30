<?php

namespace App\Controller;

use Framework\Controller\AbstractController;
use Framework\Controller\QuestionController;

use \Exception;

class Question extends AbstractController
{

    private QuestionController $questionController;

    public function __invoke(int $id): string
    {
         

        try {
            $this->questionController = new QuestionController();
            $question = $this->questionController->getQuestionById($id);
            
            //Pas forcément utile on peut juste passer $user en paramètre
            return $this->render('question/question.html.twig', [
                'id' => $id,
                'level' => $question->getLevel(), 
                'label' => $question->getLabelQuestion(),
                'answers' => $question->getAnswers(),
            ]);
        } catch (Exception $e) {
            return $this->render('error.html.twig', [
                'error' => $e->getMessage(),
            ]);
        }
        return '';


    }
}
