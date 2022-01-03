<?php

namespace Framework\Metier;

use \Exception;
use Framework\Metier\Modele;

class Answer extends Modele
{
    protected int $id;
    protected Array $joueurs;
    protected Array $scores;

    public function __construct(int $id,...$players)
    {
        
    }

    public function allDataSet(): bool
    { 
        return $this->label_answer != null && isset($this->valid) && $this->id_question != null;
    }


    /**
     * @return int
     */
    public function getIdAnswer(): int
    {
        return $this->id_answer;
    }

}
