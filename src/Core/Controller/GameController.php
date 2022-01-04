<?php

namespace Framework\Controller;

use Framework\Controller\QuestionController;
use Framework\Controller\ErrorManager;
use Framework\Metier\Answer;
use Framework\Metier\Game;
use Framework\Metier\Question;
use Framework\Metier\User;
use App\bdd\MyConnection;
use \PDO;
use Exception;

class GameController extends AbstractControllerBdd
{
    protected QuestionController $questionController;
    protected UsersController $usersController;
    protected Game $game;

    public function __construct()
    {
        $this->questionController = new QuestionController();
        $this->usersController = new UsersController();
    }

    public function newGame(int $id, $players): Game
    {
        $this->game = new Game($id); 
        foreach ($players as $player) { 
            if ($player instanceof User)
                if (!$this->usersController->ExistByUsername($player->getUsername()))
                    ErrorManager::notExist($player->getUsername());
                else {
                    $this->game->addPlayer($player);
                }
        }
        return $this->game;
    }


    public function getQuestion(int $level): Question
    {
        $this->game->setCurrentQuestion($this->questionController->getRandomQuestionByLevel($level));
        return $this->game->getCurrentQuestion();
    }

    public function response(Answer $Answer): void
    {
        $this->game->response($Answer);
    }

    public function responseManual(bool $choice): void
    {
        $this->game->responseManual($choice);
    }

    /**
     * @return Question
     */
    public function getCurrentQuestion(): Question
    {
        return $this->currentQuestion;
    }

    /**
     * @return Game
     */
    public function getGame(): Game
    {
        return $this->game;
    }

    /**
     * @void Game
     */
    public function setGame(Game $game): void
    {
        $this->game = $game;
    }
}
