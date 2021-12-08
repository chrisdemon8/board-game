<?php

namespace Framework\Controller;

use Framework\Templating\Twig;
use Framework\Controller\ErrorManager;
use Framework\Metier\Modele;

session_start(); 


abstract class AbstractControllerBdd
{
    public function conform(Modele $object)
    {
        if($object->allDataSet()){
            return true;
        }else{
            ErrorManager::notConform();
        }
    }
}
