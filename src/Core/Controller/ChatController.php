<?php


namespace Framework\Controller;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;


session_start();


class ChatController implements MessageComponentInterface
{
    protected $clients;
    private $subscriptions;
    private $users;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
        $this->subscriptions = [];
        $this->users = [];
        $this->games = [];
        // variable test en attendant la classe game
        $this->number = 0;
    }

    public function onOpen(ConnectionInterface $conn)
    {
 
        var_dump($conn->httpRequest->getHeader('Cookie'));
        // Store the new connection to send messages to later
        $this->clients->attach($conn);
        $this->users[$conn->resourceId] = $conn;
        echo "New connection! ({$conn->resourceId})\n";
    } 

    public function onMessage(ConnectionInterface $conn, $msg)
    {

        $data = json_decode($msg);
        switch ($data->command) {
            case "subscribe":
                $this->subscriptions[$conn->resourceId] = $data->channel;
                $currentGame = $this->games[$data->channel]; 

                //if (in_array($_SESSION['user']->getUsername(), $currentGame->jsonDataGame->players)) {
                $this->number += 1;
                // on renvoie les info à tout les souscrivants au channel pour actualise l'affichage quand qqun souscrit pour actualiser le nombre de joueur connecté
                // mieux gérer avec le futur objet game 
                if (isset($this->subscriptions[$conn->resourceId])) {
                    $target = $this->subscriptions[$conn->resourceId];
                    echo 'partie concernée ' . $target . ' | ';
                    foreach ($this->subscriptions as $id => $channel) {
                        if ($channel == $target) {
 
                            // ICI stock de certaine info de l'objet game
                            $objSend["currentNumberPlayer"] = $this->number;
                            $objSend["numberPlayer"] = 4;
                            $objSend["games"] = $currentGame;

                            $this->users[$id]->send(json_encode($objSend));
                        }
                    }
                }
                //   } 
 
                break;
            case "message":
                if (isset($this->subscriptions[$conn->resourceId])) {
                    $target = $this->subscriptions[$conn->resourceId];
                    echo 'partie concernée ' . $target . ' | ';
                    foreach ($this->subscriptions as $id => $channel) {
                        if ($channel == $target && $id != $conn->resourceId) {
                            $this->users[$id]->send($data->message);
                        }
                    }
                }
            case "create":
                $jsonDataGame =  json_decode($data->message);
                $this->games[$jsonDataGame->jsonDataGame->partyId] = $jsonDataGame;
        }


        /*
        $numRecv = count($this->clients) - 1;
        echo sprintf(
            'Connection %d sending message "%s" to %d other connection%s' . "\n",
            $from->resourceId,
            $msg,
            $numRecv,
            $numRecv == 1 ? '' : 's'
        );

        foreach ($this->clients as $client) {
            if ($from !== $client) {
                // The sender is not the receiver, send to each client connected
                $client->send($msg);
            }
        }*/
    }

    public function onClose(ConnectionInterface $conn)
    {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);
        unset($this->users[$conn->resourceId]);
        unset($this->subscriptions[$conn->resourceId]);
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
}
