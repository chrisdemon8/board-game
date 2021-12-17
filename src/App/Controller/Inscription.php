<?php

namespace App\Controller;

use Framework\Controller\AbstractController;

class Inscription extends AbstractController
{
    public function __invoke(): string
    {
        if (isset($_SESSION["user"]))
            header('Location: /');
        else
            return $this->render('user/inscription.html.twig');
    }
}
