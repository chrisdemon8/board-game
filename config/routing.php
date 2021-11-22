<?php

use App\Controller\Homepage;
use App\Controller\Question;
use Framework\Routing\Route;

return [
    new Route('GET', '/', Homepage::class),
    new Route('GET', '/question/{id}', Question::class),
];