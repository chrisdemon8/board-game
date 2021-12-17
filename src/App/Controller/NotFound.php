<?php

namespace App\Controller;

use Framework\Controller\AbstractController;

class NotFound extends AbstractController
{
    public function __invoke(): string
    {
        return $this->render('error.html.twig', [
            'error' => "404 page non trouvée",
        ]);
    }
}
