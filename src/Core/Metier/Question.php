<?php

namespace Framework\Metier;

use \Exception;
use Framework\Controller\Objectify;

class Question implements Objectify
{
    private int $id_question;
    private string $label_question;
    private string  $level;
    private array $answers;

    
    public function __construct()
    {}

    
    public static function Objectify($data):Question{
        $question = new Question();

        if($data == NULL)
            throw new Exception("Données non conforme !");
        $question->hydrate($data);
        return $question;
    }

    public function hydrate($data): void
    {
        foreach ($data as $attribute => $value) {
            $method = 'set' . str_replace(' ', '', ucwords(str_replace('_', ' ', $attribute)));
            //var_dump($value);
            if (is_callable(array($this, $method))) {
                $this->$method($value);
            }
        }
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