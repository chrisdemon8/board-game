<?php

namespace Framework\Metier;

abstract class Modele
{
    public function jsonSerialize()
    {

        $array = get_object_vars($this);
        $arrayFinal = [];
        foreach ($array as $key => $value) {

            if (gettype($value) == 'array') {
                foreach ($value as $keyV => $valueV) {
                    if (gettype($valueV) == 'object') {
                        $value[$keyV] = get_object_vars($valueV);
                    }
                }
            }
            $arrayFinal[$key] = $value;
        } 
 
 
        return $arrayFinal;
    }
}
