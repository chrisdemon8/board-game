<?php

namespace Framework\Controller;

use Exception;

class ErrorManager{

    public static function errorId(){
        throw new Exception('ERROR_ID');
    }

    public static function notExist($var){
        $var=strtoupper($var);
        $var=trim($var);
        $var=str_replace(' ','_',$var);
        throw new Exception('ERROR_'.$var.'NOT_EXIST');
    }

    public static function notUnique(string $var){
        $var=strtoupper($var);
        $var=trim($var);
        $var=str_replace(' ','_',$var);
        throw new Exception('ERROR_'.$var.'_NOT_UNIQUE');
    }

    public static function notConform(){
        throw new Exception('ERROR_DATA_NOT_CONFORM');
    }

    public static function CustomError($var){
        $var=strtoupper($var);
        $var=trim($var);
        $var=str_replace(' ','_',$var);
        throw new Exception($var);
    }


}