<?php

namespace Framework\Controller;

use Framework\Templating\Twig;

session_start(); 


abstract class AbstractController
{
    public function render(string $template, array $args = []): string
    {
        $twig = new Twig();


        return $twig->render($template, $args);
    }
}
