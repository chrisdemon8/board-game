<?php

namespace Framework\Metier;

abstract class Modele
{
    public function jsonSerialize()
    {
        $array = get_object_vars($this);
        return  $this->arrayFy($array);
    }

    private function arrayFy($data)
     {
        $arrayFinal = [];
        foreach ($data as $key => $value) {
            if (gettype($value) == 'array') {
                $value= $this->arrayFy($value);
            }
            if (gettype($value) == 'object') {
                $value= $this->arrayFy(get_object_vars($value));
            }
            $arrayFinal[$key] = $value;
        }
        return $arrayFinal;
    }

    public function hydrate($data):void
    {
        foreach ($data as $attribute => $value) {
            $method = 'set'.str_replace(' ', '', ucwords(str_replace('_', ' ', $attribute)));
            if (is_callable(array($this, $method))) {
                $this->$method($value);
            }
        }
    }

    public abstract function allDataSet():bool;
}
