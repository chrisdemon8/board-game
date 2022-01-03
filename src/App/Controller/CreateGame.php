<?php

namespace App\Controller;

use Exception;
use Framework\Controller\AbstractController;

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

            $partyId = $numberPlayer . rand();

            // fonction sendMail et QRCODE pour join la party 

            /*
            var_dump($numberPlayer);
            var_dump($players);
            var_dump($colors);
            var_dump($partyId);*/
        }

        header('Content-type: application/json');

        try {
            $response_array['status'] = 'success';
            $response_array['res']['partyId'] = $partyId;
            $response_array['res']['numberPlayer'] = $numberPlayer;
            $response_array['res']['players'] = $players;
            $response_array['res']['colors'] = $colors;
        } catch (Exception $e) {
            $response_array['status'] = 'error';
            $response_array['exception'] = $e->getMessage();
        }
        return json_encode($response_array);
    }
}
