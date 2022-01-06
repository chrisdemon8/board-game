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
        // $session =  $this->getPHPSESSID($conn->httpRequest->getHeader('Cookie'));

        // Store the new connection to send messages to later 
        $this->clients->attach($conn);


        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $conn, $msg)
    {
        //$session =  $this->getPHPSESSID($conn->httpRequest->getHeader('Cookie'));

        $data = json_decode($msg);

        switch ($data->command) {
            case "subscribe":
                $this->users[$conn->resourceId] = ['connection' => $conn, 'username' => $data->username];

                $alreadyExist = false;

                foreach ($this->subscriptions as $key => $value) {
                    if ($this->users[$key]['username'] === $data->username) {
                        $alreadyExist = true;
                        $objSend["type"] = "redirect";
                        var_dump($conn->resourceId);
                        $this->users[$conn->resourceId]['connection']->send(json_encode($objSend));
                        return;
                    }
                }


                if (isset($this->games[$data->channel])) {


                    $currentGame = $this->games[$data->channel];

                    $UserController = new UsersController();
                    $user = $UserController->getUserByUsername($data->username);


                    try {
                        $currentGame->inGame($user);
                    } catch (\Exception $th) {
                        $alreadyExist = true;
                        var_dump($th->getMessage());
                    }

                    if (!$alreadyExist) {

                        $this->subscriptions[$conn->resourceId] = $data->channel;

                        $currentGame->increaseConnected();
                        // on renvoie les info à tout les souscrivants au channel pour actualise l'affichage quand qqun souscrit pour actualiser le nombre de joueur connecté
                        // mieux gérer avec le futur objet game 
                        if (isset($this->subscriptions[$conn->resourceId])) {
                            $target = $this->subscriptions[$conn->resourceId];
                            echo 'partie concernée ' . $target . ' | ';
                            foreach ($this->subscriptions as $id => $channel) {
                                if ($channel == $target) {

                                    $objSend["type"] = "subcription";
                                    $objSend["currentNumberPlayer"] = $currentGame->getConnectedPlayer();
                                    $objSend["numberPlayer"] = count($currentGame->getPlayers()) + 1;
                                    $objSend["games"] = $currentGame->jsonSerialize();

                                    $this->users[$id]['connection']->send(json_encode($objSend));
                                }
                            }
                        }
                    }
                } else {
                    $objSend["type"] = "redirect";
                    $this->users[$conn->resourceId]['connection']->send(json_encode($objSend));
                }
                break;
            case "message":
                if (isset($this->subscriptions[$conn->resourceId])) {
                    $target = $this->subscriptions[$conn->resourceId];
                    echo 'partie concernée ' . $target . ' | ';

                    $json["type"] = "message";
                    $json["msg"] = $data->message;

                    foreach ($this->subscriptions as $id => $channel) {
                        if ($channel == $target && $id != $conn->resourceId) {
                            $this->users[$id]['connection']->send(json_encode($json));
                        }
                    }
                }
                break;
            case "question":
                if (isset($this->games[$data->channel])) {
                    $currentGame = $this->games[$data->channel];

                    $gameController = new GameController();
                    $gameController->setGame($currentGame);

                    $gameController->getQuestion($data->level);

                    if (isset($this->subscriptions[$conn->resourceId])) {
                        $target = $this->subscriptions[$conn->resourceId];
                        foreach ($this->subscriptions as $id => $channel) {
                            if ($channel == $target) {
                                $objSend["type"] = "question";
                                $objSend["games"] = $currentGame->jsonSerialize();
                                $this->users[$id]['connection']->send(json_encode($objSend));
                            }
                        }
                    } else
                        echo "Partie non existante";
                }
                break;
            case "eval":
                if (isset($this->games[$data->channel])) {
                    $currentGame = $this->games[$data->channel];

                    $gameController = new GameController();
                    $gameController->setGame($currentGame);

                    try {
                        $gameController->responseManual($data->response);
                    } catch (Exception $e) {
                        echo  $e->getMessage();
                    }


                    //var_dump($currentGame);

                    if (isset($this->subscriptions[$conn->resourceId])) {
                        $target = $this->subscriptions[$conn->resourceId];
                        foreach ($this->subscriptions as $id => $channel) {
                            if ($channel == $target) {
                                $objSend["type"] = "next";
                                $objSend["games"] = $currentGame->jsonSerialize();
                                $this->users[$id]['connection']->send(json_encode($objSend));
                            }
                        }
                    } else
                        echo "Partie non existante";
                }
                break;
            case "showAnswer":
                if (isset($this->games[$data->channel])) {
                    $currentGame = $this->games[$data->channel];

                    $gameController = new GameController();
                    $gameController->setGame($currentGame);

                    if (isset($this->subscriptions[$conn->resourceId])) {
                        $target = $this->subscriptions[$conn->resourceId];
                        foreach ($this->subscriptions as $id => $channel) {
                            if ($channel == $target) {
                                $objSend["type"] = "showAnswer";
                                $objSend["games"] = $currentGame->jsonSerialize();
                                $this->users[$id]['connection']->send(json_encode($objSend));
                            }
                        }
                    } else
                        echo "Partie non existante";
                }
                break;
            case "create":
                $jsonDataGame =  json_decode($data->message);

                // echo '<pre>';print_r($jsonDataGame->jsonDataGame);
                $players = $jsonDataGame->jsonDataGame->players;
                $colors = $jsonDataGame->jsonDataGame->colors;
                $partyId = $jsonDataGame->jsonDataGame->partyId;
                $game = $jsonDataGame->jsonDataGame->game;

                $GameObj = new Game($partyId);
                $GameObj->addPlayersArray($game->players);
                $GameObj->setWinners($game->winners);
                $GameObj->setScores($game->scores);
                $GameObj->setMaster(User::Objectify($game->Master));
                /* echo '<pre>';
                print_r($GameObj);*/
                $this->games[$partyId] = $GameObj;
                break;
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
        // $session =  $this->getPHPSESSID($conn->httpRequest->getHeader('Cookie'));

        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);

        if (isset($this->subscriptions[$conn->resourceId])) {
            $channel = $this->subscriptions[$conn->resourceId];
            $currentGame = $this->games[$channel];
            $currentGame->decreaseConnected();
        }

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
