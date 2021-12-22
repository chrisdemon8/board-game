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

        if (!isset($_SESSION['user']) || $_SESSION['user']->getRole() != 1)
            header('Location: /');


        header('Content-type: application/json');
        try {
            $this->questionCont = new QuestionController();
            $questions = $this->questionCont->getAllQuestionsJson();


            $response_array['status'] = 'success';
            $response_array['res'] = $questions;
        } catch (Exception $e) {
            $response_array['status'] = 'error';
            $response_array['exception'] = $e->getMessage();
        }
        return json_encode($response_array);
    }
}
