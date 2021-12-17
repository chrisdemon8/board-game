<?php

namespace App\Controller;

use Framework\Controller\AbstractController;

class Profil extends AbstractController
{
    public function __invoke(): string
    {
        if (!isset($_SESSION['user']))
            header('Location: /');
        return $this->render('user/profil.html.twig');
    }
}
