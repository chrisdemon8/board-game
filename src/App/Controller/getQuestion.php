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

        if (!isset($_SESSION['user']) || $_SESSION['user']->getRole() != 1)
            header('Location: /');


        header('Content-type: application/json');
        try {
            $content = trim(file_get_contents("php://input"));

            $data = json_decode($content, true);
            $data['success'] = true;

            if ($data['success'])
                $id_question = $data['data']['id_question'];

            $this->questionCont = new QuestionController();
            $question = $this->questionCont->getQuestionById($id_question);
 

            $response_array['status'] = 'success';
            $response_array['res'] = $question->jsonSerialize();
        } catch (Exception $e) {
            $response_array['status'] = 'error';
            $response_array['exception'] = $e->getMessage();
        }
        return json_encode($response_array);
    }
}
