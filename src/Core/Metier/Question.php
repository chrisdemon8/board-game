<?php

namespace Framework\Metier;

use \Exception;
use Framework\Controller\Objectify;
use Framework\Metier\Modele;

class Question  extends Modele implements Objectify
{
    protected int $id_question;
    protected string $label_question;
    protected string  $level;
    protected array $answers;

    
    public function __construct()
    {}

    
    public static function Objectify($data):Question{
        $question = new Question();

        if($data == NULL)
            throw new Exception("Données non conforme !");
        $question->hydrate($data);
        return $question;
    }



    /**
     * @return int
     */
    public function getIdQuestion(): int
    {
        return $this->id_question;
    }

    /**
     * @param int $id_question
     */
    public function setIdQuestion(int $id_question): void
    {
        $this->id_question = $id_question;
    }

    /**
     * @return string
     */
    public function getLabelQuestion(): string
    {
        return $this->label_question;
    }

    /**
     * @param string $label_question
     */
    public function setLabelQuestion(string $label_question): void
    {
        $this->label_question = $label_question;
    }

    /**
     * @return string
     */
    public function getLevel(): string
    {
        return $this->level;
    }

    /**
     * @param string $level
     */
    public function setLevel(string $level): void
    {
        $this->level = $level;
    }

    /**
     * @return array
     */
    public function getAnswers(): array
    {
        return $this->answers;
    }

    /**
     * @param array $answers
     */
    public function setAnswers(array $answers): void
    {
        $this->answers = $answers;
    }


}