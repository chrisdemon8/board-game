<?php

use App\Controller\Homepage;
use App\Controller\Question;
use App\Controller\ShowUser;
use App\Controller\ShowAllUsers;
use App\Controller\addUser;
use App\Controller\inscription;
use Framework\Routing\Route;

return [
    new Route('GET', '/', Homepage::class),
    new Route('GET', '/question/{id}', Question::class),
    new Route('GET', '/user/{id}', ShowUser::class),
    new Route('GET', '/allUsers', ShowAllUsers::class),
    new Route('GET', '/addUser', addUser::class),
    new Route('GET', '/inscription', inscription::class),
];