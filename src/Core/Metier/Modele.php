<?php

namespace Framework\Metier;

abstract class Modele 
{
    public function jsonSerialize(){
        return json_encode(get_object_vars($this));
    }
}