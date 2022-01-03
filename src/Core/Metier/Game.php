<?php

namespace Framework\Metier;

use \Exception;
use Framework\Metier\Modele;
use Framework\Metier\Question;

class Game extends Modele
{
    protected int $id;
    protected array $players;
    protected array $winners;
    protected array $scores;
    protected User $currentPlayer;
    protected Question $currentQuestion;
    protected array $answeredQuestion;
    const winPoint = 48;

    public function nextPlayer():void{

        $temporaryPlayer=next($this->players);
        if($temporaryPlayer==false)
            $this->currentPlayer=reset($this->players);
        else
        $this->currentPlayer=$temporaryPlayer;
    }

    public function __construct(int $id)
    {
        $this->id = $id;
        $this->players = [];
        $this->winners = [];
    }

    public function setCurrentQuestion(Question $question){
        $this->currentQuestion=$question;
    }

    public function getCurrentQuestion(): Question{
        return $this->currentQuestion;
    }

    public function addPlayer(User $player): void
    {
        if(!$this->notInGame($player))
            throw new Exception("Ce joueurs est déjà dans la partie");
        array_push($this->players, $player);
        $this->scores[$player->getUsername()] = 0;
        if(!isset($this->currentPlayer))
            $this->currentPlayer=current($this->players);
    }

    public function addPoints(int $nb, User $player): void
    {
        if (!$this->inGame($player))
            throw new Exception("Ce joueurs n'est pas dans la partie");
        else {
            $this->scores[$player->getUsername()] += $nb;
            if ($this->scores[$player->getUsername()] >= 48) {
                array_push($this->winners, $player);
                if (($key = array_search($player, $this->players)) !== false) {
                    array_splice($this->players, $key, 1);
                }
            }
        }
    }

    public function removePoints(int $nb, User $player): void
    {
        if ($this->inGame($player))
            $this->scores[$player->getUsername()] += $nb;
    }

    public function inGame(User $player): bool
    {
        if (!in_array($player, $this->players))
            throw new Exception("Ce joueurs n'est pas dans la partie");
        return true;
    }

    public function notInGame(User $player): bool
    {
        if (in_array($player, $this->players))
            throw new Exception("Ce joueurs est déjà dans la partie");
        return true;
    }

    public function inQuestion(Answer $Answer){
        if (!in_array($Answer, $this->currentQuestion->getAnswers()))
            throw new Exception("Cet réponse n'est pas dans la question");
        return true;
    }

    public function response(Answer $Answer):void
    {
        if ($this->inQuestion($Answer))
            {
                if($Answer->isValid())
                    $this->addPoints((int) $this->currentQuestion->getLevel(),$this->currentPlayer);
                else
                    $this->removePoints((int) $this->currentQuestion->getLevel(),$this->currentPlayer);
            }
        $this->nextPlayer();    
    }

    public function addAnswered(Question $question){
        array_push($this->answeredQuestion,$question);
    }

    public function inAnswered(Question $question){
        return in_array($question,$this->answeredQuestion);
    }

    public function responseManual(bool $choice):void
    {
            if($choice)
                $this->addPoints((int) $this->currentQuestion->getLevel(),$this->currentPlayer);
            else
                $this->removePoints((int) $this->currentQuestion->getLevel(),$this->currentPlayer);
        $this->nextPlayer();    
    }

    /**
     * @return array
     */
    public function getWinners(): array
    {
        return $this->winners;
    }

    /**
     * @param array $winners
     */
    public function setWinners(array $winners): void
    {
        $this->winners = $winners;
    }


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }


    /**
     * @return array
     */
    public function getScores(): array
    {
        return $this->scores;
    }

    /**
     * @return array
     */
    public function getPlayers(): array
    {
        return $this->players;
    }

    /**
     * @param array $players
     */
    public function setPlayers(array $players): void
    {
        $this->players = $players;
    }

    /**
     * @return User
     */
    public function getCurrentPlayer(): User
    {
        return $this->currentPlayer;
    }

    /**
     * @param User $currentPlayer
     */
    public function setCurrentPlayer(User $currentPlayer): void
    {
        $this->currentPlayer = $currentPlayer;
    }

    /**
     * @param array $scores
     */
    public function setScores(array $scores): void
    {
        $this->scores = $scores;
    }


    public function allDataSet(): bool
    {
        // TODO: Implement allDataSet() method.
        return isset($id) && isset($this->players);
    }
}
