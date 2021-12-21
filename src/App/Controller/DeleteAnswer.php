<?php

namespace App\Controller;

use Exception;
use Framework\Controller\AbstractController;
use Framework\Controller\AnswerController;

class DeleteAnswer extends AbstractController
{
    public function __invoke(): string
    {

        if (!isset($_SESSION['user']) || $_SESSION['user']->getRole() != 1)
            header('Location: /');

        $content = trim(file_get_contents("php://input"));

        $data = json_decode($content, true);
        $data['success'] = true;

        if ($data['success'])
            $id_answer = $data['jsonData']['id_answer'];


        $answerCont = new AnswerController();
        if ($_SESSION['user']->getRole() === 1) {
            try {
                $answerCont->deleteAnswer($id_answer);
            } catch (Exception $e) {
                return $this->render('user/connexion.html.twig', [
                    'error' => $e->getMessage(),
                ]);
            }
        } else
            header('Location: /');
        return '';
    }
}
