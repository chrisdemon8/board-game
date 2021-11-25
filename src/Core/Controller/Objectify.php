<?php
namespace Framework\Controller;

interface objectify{
    //Transforme en objet un set de donnée sans modifié ou rajouter d'élément non présent dans $data
    public static function objectify($data):objectify;
}