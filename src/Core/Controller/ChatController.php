<?php


namespace Framework\Controller;

use Exception;
use Framework\Metier\Game;
use Framework\Metier\User;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
 
 
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
    }

    public function onOpen(ConnectionInterface $conn)
    { 
        $session =  $this->getPHPSESSID($conn->httpRequest->getHeader('Cookie'));
        
        
        // Store the new connection to send messages to later 
        $this->clients->attach($conn);
        $this->users[$conn->resourceId] = ['connection' => $conn, 'session' => $session];

        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $conn, $msg)
    {
        $session =  $this->getPHPSESSID($conn->httpRequest->getHeader('Cookie'));

        $data = json_decode($msg);
        switch ($data->command) {
            case "subscribe":
                $this->subscriptions[$conn->resourceId] = $data->channel;
                $currentGame = $this->games[$data->channel];

                // on renvoie les info à tout les souscrivants au channel pour actualise l'affichage quand qqun souscrit pour actualiser le nombre de joueur connecté
                // mieux gérer avec le futur objet game 
                if (isset($this->subscriptions[$conn->resourceId])) {
                    $target = $this->subscriptions[$conn->resourceId];
                    echo 'partie concernée ' . $target . ' | ';
                    foreach ($this->subscriptions as $id => $channel) {
                        if ($channel == $target) {

                            // ICI stock de certaine info de l'objet game
                            $objSend["currentNumberPlayer"] =  count($currentGame->getPlayers());
                            $objSend["numberPlayer"] = count($currentGame->getPlayers());
                            $objSend["games"] = $currentGame->jsonSerialize();

                            $this->users[$id]['connection']->send(json_encode($objSend));
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
                            $this->users[$id]['connection']->send($data->message);
                        }
                    }
                }
            case "create":
                $jsonDataGame =  json_decode($data->message);

                $players = $jsonDataGame->jsonDataGame->players;
                $colors = $jsonDataGame->jsonDataGame->colors;
                $partyId = $jsonDataGame->jsonDataGame->partyId;

                $userArray = [];

                foreach ($players as $key => $value) {
                    $userController = new UsersController();
                    $user = $userController->getUserByUsername($value);

                    if ($user instanceof User) {
                        $user->setColor($colors[$key]);
                        $userArray[] = $user;
                    }
                }

                $gameController = new GameController();
                $game = $gameController->newGame($partyId, $userArray);
                $this->games[$jsonDataGame->jsonDataGame->partyId] = $game;
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
        $session =  $this->getPHPSESSID($conn->httpRequest->getHeader('Cookie'));

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

    private function getPHPSESSID(array $cookies)
    {
        foreach ($cookies as $cookie) :
            if (strpos($cookie, "PHPSESSID") == 0) :
                $sess_id = explode('=', $cookie)[1];
                break;
            endif;
        endforeach;
        return $sess_id;
    }
}
