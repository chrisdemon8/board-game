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

            var_dump($question);

            if ($this->questionCont->updateQuestion($question)) {
                return true;
            } else
                return false;
            echo "tesg";
        } catch (Exception $e) {
            return $this->render('error.html.twig', [
                'error' => $e->getMessage(),
            ]);
        }
        return '';
    }
}
