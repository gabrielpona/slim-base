<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

use App\Middleware;

return function (App $app) {

    $container = $app->getContainer();



    $app->get('/', 'HomeController:index')->setName('home');

    $app->group('', function () {
        $this->get('/auth/signup', 'AuthController:getSignUp')->setName('auth.signup');
        $this->post('/auth/signup', 'AuthController:postSignUp');
        $this->get('/auth/signin', 'AuthController:getSignIn')->setName('auth.signin');
        $this->post('/auth/signin', 'AuthController:postSignIn')->setName('auth.signin.post');
    })->add(new Middleware\GuestMiddleware($container));



    $app->group('', function () {
        $this->get('/auth/signout', 'AuthController:getSignOut')->setName('auth.signout');
        $this->get('/auth/password/change', 'PasswordController:getChangePassword')->setName('auth.password.change');
        $this->post('/auth/password/change', 'PasswordController:postChangePassword');
        $this->get('/protected',  function () {
            echo 'Página protegida';
        })->setName('protected');
    })->add(new Middleware\AuthMiddleware($container));




    /*

    $app->group('/auth', function () {
            $this->map(['GET', 'POST'], '/login', 'App\controllers\AuthController:login');
            $this->map(['GET', 'POST'], '/logout', 'App\controllers\AuthController:logout');
    });

    $app->get('/','App\Controller\HomeController:index')->setName('index');

    $app->get('/protected', $app->auth, function () {
        echo 'Página protegida';
    });

    */


    /*
    $app->get('/hello', function ($request, $response, $args) {

    })->setName('profile');
    */

/*
    $app->get('/', function (Request $request, Response $response, array $args) use ($container) {
        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/' route");


        // Render index view
        return $container->get('renderer')->render($response, 'index.phtml', $args);
    });

    $app->get('/books', 'Bookshelf\BookController:listBooks')->setName('list-books');
*/
};
