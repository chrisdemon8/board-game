<?php

namespace App\Controller;

use Framework\Controller\AbstractController;
use App\bdd\MyConnection;


class ShowUser extends AbstractController
{
    private $connection;

    public function __invoke(): string
    {

        $this->connection=MyConnection::getInstance();
        return $this->render('test.html.twig',[
            'loopUntil' => 10,
        ]);
        
    }
}
