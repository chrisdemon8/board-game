<?php

namespace App\Controller;

use Framework\Controller\AbstractController;

class Profil extends AbstractController
{
    public function __invoke(): string
    {
        return $this->render('user/profil.html.twig');
    }
}
