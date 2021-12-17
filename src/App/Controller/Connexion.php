<?php

namespace App\Controller;

use Framework\Controller\AbstractController;

class Connexion extends AbstractController
{
    public function __invoke(): string
    {
        if (isset($_SESSION["user"]))
            header('Location: /');
        else
            return $this->render('user/connexion.html.twig');
    }
}
