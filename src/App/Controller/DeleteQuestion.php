<?php

namespace App\Controller;

use Exception;
use Framework\Controller\AbstractController;
use Framework\Controller\QuestionController; 

class DeleteQuestion extends AbstractController
{
    public function __invoke(): string
    {

        if(!isset($_SESSION['user'])&& $_SESSION['user']->getRole()!=1)
            header('Location: /');
            
        $questCont = new QuestionController();
        if ($_SESSION['user']->getRole() == 1) {
            try {
                $questCont->deleteQuestion($_POST['id_question']);
            } catch (Exception $e) {
                return $this->render('user/connexion.html.twig', [
                    'error' => $e->getMessage(),
                ]);
            }
        }else   
            header('Location: /'); 

        header('Location: /users');
    }
}
