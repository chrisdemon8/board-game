<?php

namespace App\Controller;

use Framework\Controller\AbstractController;

class Inscription extends AbstractController
{
    public function __invoke(): string
    {
        return $this->render('user/inscription.html.twig');
    }
}
