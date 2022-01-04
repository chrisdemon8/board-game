<?php

namespace App\Controller;

use Framework\Controller\AbstractController;

use \Exception;
use Framework\Controller\GameController;
use Framework\Controller\QuestionController;
use Framework\Metier\User;

class GetRandomQuestion extends AbstractController
{
    private GameController $gameCont;

    public function __invoke($level): string
    {
        $gameCont=new GameController();

        $user=new User();
        $user->setUsername('admin');
        $user2=new User();
        $user2->setUsername('chris');
        $user3=new User();
        $user3->setUsername('chrisdemon8');
        $users=[];
        array_push($users,$user,$user2,$user3);
        $gameCont->newGame(165411354,$users);
      //  $question=$gameCont->getQuestion($level);
        //$gameCont
       // $answer=$question->getAnswers()[0];
       // $gameCont->responseManual(true);
       // $gameCont->getGame()->addPoints(50,$user2);
        echo '<pre>';
       // print_r($Question);

        print_r($gameCont->getGame());
         return $this->render('testChris.html.twig',[
            'test' => $level,
         ]
        );
    }
}
