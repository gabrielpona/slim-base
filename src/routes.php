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
        $this->post('/auth/signout', 'AuthController:postSignOut')->setName('auth.signout.post');
        $this->get('/auth/password/change', 'PasswordController:getChangePassword')->setName('auth.password.change');
        $this->post('/auth/password/change', 'PasswordController:postChangePassword');
        $this->get('/protected',  function () {
            phpinfo();
        })->setName('protected');
    })->add(new Middleware\AuthMiddleware($container));


    $app->group('/painel', function () {
        $this->get('/index', 'PainelController:getIndex')->setName('painel.index');
        $this->get('/teste',  function () {
            $version = phpversion();
            echo 'Página protegida - PHP '.$version;
        })->setName('protected');
        $this->get('/usuario/list', 'UsuarioController:getList')->setName('usuario.list');
        $this->get('/usuario/create', 'UsuarioController:getCreate')->setName('usuario.create');
        $this->post('/usuario/add', 'UsuarioController:postCreate')->setName('usuario.add');
        $this->get('/usuario/edit/{id}', 'UsuarioController:getEdit')->setName('usuario.edit');
        $this->post('/usuario/update', 'UsuarioController:postEdit')->setName('usuario.update');
        $this->post('/usuario/password-change', 'UsuarioController:postPwdChange')->setName('usuario.pwd.change');

        $this->get('/unidade/list', 'UnidadeController:getList')->setName('unidade.list');
        $this->get('/unidade/create', 'UnidadeController:getCreate')->setName('unidade.create');
        $this->post('/unidade/add', 'UnidadeController:postCreate')->setName('unidade.add');
        $this->get('/unidade/edit/{id}', 'UnidadeController:getEdit')->setName('unidade.edit');
        $this->post('/unidade/update', 'UnidadeController:postEdit')->setName('unidade.update');
    })->add(new Middleware\AuthMiddleware($container));


    //Authenticated JSON Routes
    $app->group('/json', function () {
        $this->post('/usuario/list', 'UsuarioController:postDtJson')->setName('usuario.list.json');
        $this->post('/unidade/list', 'UnidadeController:postDtJson')->setName('unidade.list.json');

        $this->post('/usuario/remove','UsuarioController:postRemoveJson')->setName('usuario.remove.json');
        $this->post('/unidade/remove','UnidadeController:postRemoveJson')->setName('unidade.remove.json');
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
