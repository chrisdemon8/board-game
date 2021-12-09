<?php

namespace App\Controller;

use Exception;
use Framework\Controller\AbstractController;
use Framework\Controller\QuestionController;
use Framework\Metier\Question;


class AddQuestion extends AbstractController
{
    public function __invoke(): string
    {
        if(!isset($_SESSION['user']) || $_SESSION[ 'user']->getRole()!=1)
            header('Location: /');

        $content = trim(file_get_contents("php://input"));

        $data = json_decode($content, true);
        $data['success'] = true;
        if ($data['success'] === true) {
            $data = $data["jsonData"];
        }

        try {
            $QuestionController = new QuestionController();
            $Question = Question::Create($data);
            $QuestionController->addQuestion($Question);
        } catch (Exception $e) {
            return $this->render('error.html.twig', [
                'error' => $e->getMessage(),
            ]);
        }
 
    }
    }
