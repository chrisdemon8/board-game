<?php

namespace App\Controller;

use Framework\Controller\AbstractController;



class Disconnected extends AbstractController
{
    public function __invoke(): void
    {
        session_destroy();

        header('Location: /');
    }
}
