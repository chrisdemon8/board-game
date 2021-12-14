<?php

namespace App\Command;

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use Framework\Controller\ChatController;
 
require dirname(__DIR__) . '../../vendor/autoload.php';



$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new ChatController()
        )
    ),
    8080
);

$server->run();
