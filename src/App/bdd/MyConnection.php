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
          self::$connection = new PDO ('mysql:host='.Config::get('HOST').';port='.Config::get('PORT').';dbname='.Config::get('DBNAME'),Config::get('USERNAME'), Config::get('PASSWORD'));
          //self::$connection = new PDO ('mysql:host=localhost;dbname=projet_php','root', '');
          self::$connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }

        return self::$connection;
      }

}
