<?php

namespace App\Controller;

use Exception;
use Framework\Controller\AbstractController;
use Framework\Controller\GameController;
use Framework\Controller\UsersController;
use Framework\Metier\User;

class CreateGame extends AbstractController
{
    public function __invoke(): string
    {


        if (!isset($_SESSION["user"]))
            header('Location: /');



        $content = trim(file_get_contents("php://input"));

        $data = json_decode($content, true);

        $data['success'] = true;

        if ($data['success']) {
            $numberPlayer = $data['jsonData']['numberPlayer'];

            $players = $data['jsonData']['players'];
            $colors = $data['jsonData']['colors'];

            $userArray = [];

            foreach ($players as $key => $value) {
                $userController = new UsersController();
                $user = $userController->getUserByUsername($value);

                if ($user instanceof User) {
                    $user->setColor($colors[$key]);
                    $userArray[] = $user;
                } else
                    throw new Exception("Données client corrompues");
            }

            $partyId = $numberPlayer . rand();

            // fonction sendMail et QRCODE pour join la party 
 
        }



        header('Content-type: application/json');

        try { 
            $gameController = new GameController();
            $game = $gameController->newGame($partyId, $userArray);
 
 
            $response_array['status'] = 'success';
            $response_array['res']['partyId'] = $partyId;
            $response_array['res']['numberPlayer'] = $numberPlayer;
            $response_array['res']['players'] = $players;
            $response_array['res']['colors'] = $colors;
            $response_array['res']['game'] = $game->jsonSerialize();
        } catch (Exception $e) {
            $response_array['status'] = 'error';
            $response_array['exception'] = $e->getMessage();
        }
        return json_encode($response_array);
    }
}
