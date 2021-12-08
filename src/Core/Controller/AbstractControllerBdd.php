<?php

namespace Framework\Controller;

use Framework\Templating\Twig;
use Framework\Controller\ErrorManager;
use Framework\Metier\Modele;



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
