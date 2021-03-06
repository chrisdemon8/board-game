<?php

namespace App\Controller;

use Framework\Controller\AbstractController;
use Framework\Controller\QuestionController;
use \Exception;
use Framework\Controller\UsersController;

class Admin extends AbstractController
{
    private QuestionController $questionCont;
    private UsersController $userCont;


    public function __invoke(): string
    {

        if(!isset($_SESSION['user']) || $_SESSION['user']->getRole()!=1)
            header('Location: /');
        try {
            $this->questionCont = new QuestionController();
            $this->userCont = new UsersController();
            $questions = $this->questionCont->countQuestions();
            $users = $this->userCont->countUsers(); 
            return $this->render('/user/admin.html.twig', [
                'questions' => $questions,
                'users' => $users
            ]);
        } catch (Exception $e) {
            return $this->render('error.html.twig', [
                'error' => $e->getMessage(),
            ]);
        }
        return '';
    }
}
