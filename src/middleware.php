<?php

use Slim\App;


return function (App $app) {
    // e.g: $app->add(new \Slim\Csrf\Guard);

    /*
    $auth = function () use($app) {
        if (!isset($_SESSION['user']) or !is_array($_SESSION['user']))
            $app->redirect('/login');
    };

    $app->add($auth);

    $app->add(new SessionCookie([
        'secret' => 'SEU_TOKEN_AQUI',
        'cipher' => MCRYPT_RIJNDAEL_256,
        'cipher_mode' => MCRYPT_MODE_CBC
    ]));

    */

};
