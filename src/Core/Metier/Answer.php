<?php

namespace Framework\Metier;

use \Exception;
use Framework\Metier\Modele;
use Framework\Controller\Objectify;

class Answer extends Modele implements Objectify
{
    protected int $id_answer;
    protected string $label_answer;
    protected int  $id_question;
    protected bool $valid;

    
    public static function Objectify($data):Answer{
        $Answer = new Answer();

        if($data == NULL)
            throw new Exception("Données non conforme !");
        $Answer->hydrate($data);
        return $Answer;
    }

    public function allDataSet():bool{
        return $this->label_answer !=null && $this->valid!=null && $this->id_question!=null;
    }
  
    
    /**
     * @return int
     */
    public function getIdAnswer(): int
    {
        return $this->id_answer;
    }

    /**
     * @param int $id_answer
     */
    public function setIdAnswer(int $id_answer): void
    {
        $this->id_answer = $id_answer;
    }

    /**
     * @return string
     */
    public function getLabelAnswer(): string
    {
        return $this->label_answer;
    }

    /**
     * @param string $label_answer
     */
    public function setLabelAnswer(string $label_answer): void
    {
        $this->label_answer = $label_answer;
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
     * @return bool
     */
    public function isValid(): bool
    {
        return $this->valid;
    }

    /**
     * @param bool $valid
     */
    public function setValid(int $valid): void
    {
        $this->valid = ($valid==1);
    }

}