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
use App\Controller\ChatPage;
use App\Controller\CreateGame;
use App\Controller\DeleteAnswer;
use App\Controller\GetUsers;
use App\Controller\NotFound;
use App\Controller\UpdateUserAdmin;
use Framework\Routing\Route;

return [
    new Route('GET', '/', Homepage::class),
    new Route('GET', '/404', NotFound::class),
    new Route('GET', '/admin', Admin::class),
    new Route('POST', '/getUser', GetUser::class),
    new Route('POST', '/updateAnswer', UpdateAnswer::class),
    new Route('POST', '/addAnswer', AddAnswer::class),
    new Route('POST', '/deleteAnswer', DeleteAnswer::class),
    new Route('POST', '/deleteQuestion', DeleteQuestion::class),
    new Route('POST', '/updateQuestion', UpdateQuestion::class),
    new Route('POST', '/updateUserAdmin', UpdateUserAdmin::class), 
    new Route('GET', '/getUsers', GetUsers::class),
    new Route('POST', '/createGame', CreateGame::class),
    new Route('GET', '/getQuestions', GetQuestions::class),
    new Route('POST', '/getQuestion', GetQuestion::class),
    new Route('POST', '/addQuestion', AddQuestion::class),
    new Route('GET', '/deconnexion', Disconnected::class),
    new Route('GET', '/question/{id}', Question::class),
    new Route('GET', '/user/{id}', ShowUser::class),
    new Route('GET', '/allUsers', ShowAllUsers::class),
    new Route('GET', '/allQuestions', ShowAllQuestions::class),
    new Route('POST', '/addUser', AddUser::class),
    new Route('POST', '/checkUser', CheckUser::class),
    new Route('GET', '/profil', Profil::class),
    new Route('POST', '/deleteUser', DeleteUser::class), 
    new Route('POST', '/updateUser', UpdateUser::class),
    new Route('GET', '/inscription', Inscription::class),
    new Route('GET', '/connexion', Connexion::class),
    new Route('GET', '/chatpage', ChatPage::class),

];
