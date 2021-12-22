<?php

namespace App\Controller;

use Framework\Controller\AbstractController;

use \Exception;
use Framework\Controller\QuestionController;

class UpdateQuestion extends AbstractController
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
            if ($data['success'] === true) {
                $data = $data["jsonData"];
            }
            $this->questionCont = new QuestionController();

            $question = $this->questionCont->getQuestionById($data['id_question']);

            $question->hydrate($data);

            $this->questionCont->updateQuestion($question);
            $response_array['status'] = 'success';
        } catch (Exception $e) {
            $response_array['status'] = 'error';
            $response_array['exception'] = $e->getMessage();
        }
        return json_encode($response_array);
    }
}
