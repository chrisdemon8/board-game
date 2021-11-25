<?php

namespace Framework\Controller;

interface Create{
    //crée une toute nouvelle instance avec les données envoyés et set celles de base (style : date de création)
    public static function create($data):create;

}