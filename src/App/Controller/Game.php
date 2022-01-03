<?php

namespace App\Controller;

use Framework\Controller\AbstractController;

class Game extends AbstractController
{
    public function __invoke(int $partyId): string
    {


        if (!isset($_SESSION["user"]))
            header('Location: /');


        return $this->render('game/lobby.html.twig', [
            'id' => $partyId
        ]);
    }
}
