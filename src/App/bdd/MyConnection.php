<?php

namespace App\bdd;

use \PDO;

use Framework\Config\Config;

class MyConnection extends PDO
{
    private static $connection=null;

    private function __construct()
    {
        
    }

    private function test():void{
        echo 'test';
    }

    public static function getInstance() {
 
        if(is_null(self::$connection)) {
          self::$connection = new PDO ('mysql:host=localhost;dbname='.Config::get('DBNAME'),Config::get('USERNAME'), Config::get('PASSWORD'));
        }
    
        return self::$connection;
      }

}
