<?php

namespace App\Controller;

use Framework\Controller\AbstractController;

class Connexion extends AbstractController
{
    public function __invoke(): string
    {
        return $this->render('user/connexion.html.twig');
    }
}
