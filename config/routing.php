<?php

use App\Controller\Homepage;
use App\Controller\Question;
use App\Controller\ShowUser;
use App\Controller\ShowAllUsers;
use App\Controller\ShowAllQuestions;
use App\Controller\AddUser;
use App\Controller\CheckUser;
use App\Controller\Inscription;
use App\Controller\Connexion;
use App\Controller\Disconnected;
use App\Controller\Profil;
use App\Controller\UpdateUser;
use App\Controller\DeleteUser; 
use App\Controller\GetUser; 
use App\Controller\GetQuestions; 
use App\Controller\GetQuestion; 
use App\Controller\Admin; 
use App\Controller\DeleteQuestion;
use App\Controller\UpdateQuestion;
use App\Controller\UpdateAnswer;
use App\Controller\AddAnswer;
use App\Controller\AddQuestion;
use Framework\Routing\Route;

return [
    new Route('GET', '/', Homepage::class),
    new Route('GET', '/Admin', Admin::class),
    new Route('POST', '/GetUser', GetUser::class),
    new Route('POST', '/UpdateAnswer', UpdateAnswer::class),
    new Route('POST', '/AddAnswer', AddAnswer::class),
    new Route('POST', '/DeleteQuestion', DeleteQuestion::class),
    new Route('POST', '/UpdateQuestion', UpdateQuestion::class),
    new Route('GET', '/GetQuestions', GetQuestions::class),
    new Route('POST', '/GetQuestion', GetQuestion::class),
    new Route('POST', '/AddQuestion', AddQuestion::class),
    new Route('GET', '/deconnexion', Disconnected::class),
    new Route('GET', '/question/{id}', Question::class),
    new Route('GET', '/user/{id}', ShowUser::class),
    new Route('GET', '/allUsers', ShowAllUsers::class),
    new Route('GET', '/allQuestions', ShowAllQuestions::class),
    new Route('POST', '/AddUser', AddUser::class),
    new Route('POST', '/checkUser', CheckUser::class),
    new Route('GET', '/profil', Profil::class),
    new Route('POST', '/deleteUser', DeleteUser::class), 
    new Route('POST', '/updateUser', UpdateUser::class),
    new Route('GET', '/inscription', Inscription::class),
    new Route('GET', '/connexion', Connexion::class),

];
