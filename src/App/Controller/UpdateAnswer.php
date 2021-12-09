<?php

namespace App\Controller;

use Framework\Controller\AbstractController;

use \Exception;
use Framework\Controller\AnswerController;

class UpdateAnswer extends AbstractController
{
    private AnswerController $answerCont;

    public function __invoke(): string
    {
        try {
            $content = trim(file_get_contents("php://input"));

            $data = json_decode($content, true);
            $data['success'] = true;
            if ($data['success'] === true) {
                $data = $data["jsonData"];
            }
            $this->answerCont = new AnswerController();

            $answer = $this->answerCont->getAnswerByAnswerId($data['id_answer']);

            $answer->hydrate($data);

            if ($this->answerCont->updateAnswer($answer)) {
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
