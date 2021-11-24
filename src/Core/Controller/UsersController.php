<?php

namespace Framework\Controller;

use Framework\Templating\Twig;

class AbstractController
{
    public function render(string $template, array $args = []): string
    {
        $twig = new Twig();

        return $twig->render($template, $args);
    }
}
