<?php

namespace App\Controller;

use Framework\Controller\AbstractController;

class SessionExample extends AbstractController
{
    public function __invoke(): string
    {
        print_r($_COOKIE);
        return $this->render('home.html.twig');
    }


    /*
    function getPHPSESSID(array $cookies)
    {
        foreach ($cookies as $cookie) :
            if (strpos($cookie, "PHPSESSID") == 0) :
                $sess_id = explode('=', $cookie)[1];
                break;
            endif;
        endforeach;
        return $sess_id;
    }*/
}
