<?php

namespace Framework\Metier;

use DateTime;
use \Exception;

abstract class Modele
{

    protected $RegexLetter = "/^[\p{L}-]*$/u";
   // protected $RegexLetter = "/^[a-zA-Z\x{00C0}-\x{00FF}]*$/";
    

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
                $value = $this->arrayFy($value);
            }

            if ($value instanceof DateTime) {
                $value = $value->format('Y-m-d H:i:s'); 
            }
            
            if (gettype($value) == 'object' && !($value instanceof DateTime)) {
                $value = $this->arrayFy(get_object_vars($value));
            }
            $arrayFinal[$key] = $value;
        }
        return $arrayFinal;
    }

    public function hydrate($data): void
    {
        foreach ($data as $attribute => $value) {
            $method = 'set' . str_replace(' ', '', ucwords(str_replace('_', ' ', $attribute)));
            if (is_callable(array($this, $method))) {
                $this->$method($value);
            }
        }
    }

    public function checkLettersOnly(string $word)
    {
        $word=str_replace('\'','',$word);
        $word=str_replace('"','',$word);
        if (preg_match($this->RegexLetter, $word) && $word!= '') {
            return true;
        } else {
            return false;
        }
        return false;
    }

    public abstract function allDataSet(): bool;
}
