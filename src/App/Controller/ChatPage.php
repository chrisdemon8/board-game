<?php

namespace App\Controller;

use Framework\Controller\AbstractController;
use Framework\Controller\ChatController;

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;


class ChatPage extends AbstractController
{
    public function __invoke(): string
    {
        return $this->render('chatbeta.html.twig');
    }
}
