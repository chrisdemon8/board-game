<?php

namespace Framework\Controller;

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
                echo " User " . $conn->resourceId . " rejoint la partie n°" .  $data->channel . ' | ';
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
                $this->games[$msg] = $msg;
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
