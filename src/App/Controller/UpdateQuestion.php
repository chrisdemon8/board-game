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


            if ($this->questionCont->updateQuestion($question)) {
                return true;
            } else
                return false;
        } catch (Exception $e) {
            return $this->render('error.html.twig', [
                'error' => $e->getMessage(),
            ]);
        }
        return '';
    }
}
