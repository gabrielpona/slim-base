<?php

use Slim\App;

use App\Controller as Controller;

return function (App $app) {
    $container = $app->getContainer();

    // view renderer
    $container['renderer'] = function ($c) {
        $settings = $c->get('settings')['renderer'];
        return new \Slim\Views\PhpRenderer($settings['template_path']);
    };

    // monolog
    $container['logger'] = function ($c) {
        $settings = $c->get('settings')['logger'];
        $logger = new \Monolog\Logger($settings['name']);
        $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
        $logger->pushHandler(new \Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
        return $logger;
    };

    //Register Twig Helper
    $container['view'] = function ($container) {
        $settings = $container->get('settings')['twig'];
        $view = new \Slim\Views\Twig( $settings['template_path'], [
            'cache' => $settings['cache'],
        ]);

        $view->addExtension(new \Slim\Views\TwigExtension(
            $container->router,
            $container->request->getUri()
        ));

        $view->getEnvironment()->addGlobal('auth', [
            /*'check' => $container->auth->check(),
            'user' => $container->auth->user()
            */
            'check' => false,
            'usuario' => new \App\Entity\Usuario()
        ]);

        $view->getEnvironment()->addGlobal('flash', $container->flash);

        $view->offsetSet("slim_environment",getenv('SLIM_ENVIRONMENT'));
        $view->offsetSet("app_name",getenv('APP_NAME'));
        $view->offsetSet("app_version",getenv('APP_VERSION'));
        //$view->offsetSet('xablau','xablau');

        if(isset($_SESSION['usuario'])){
            $view->offsetSet('userSession',$_SESSION['usuario']);
        }else{
            $view->offsetSet('userSession',new \App\Entity\Usuario());
        }
        return $view;
    };

    // Doctrine
    $container['em'] = function ($c) {
        $settings = $c->get('settings');

        $config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration(
            $settings['doctrine']['meta']['entity_path'],
            $settings['doctrine']['meta']['auto_generate_proxies'],
            $settings['doctrine']['meta']['proxy_dir'],
            null,
            false
        );

        return \Doctrine\ORM\EntityManager::create($settings['doctrine']['connection'], $config);
    };

    $container['auth'] = function($c) {
        //$userResource = new \App\Resource\UsuarioDao($c->get('em'));
        //return new \App\Controller\Auth\AuthController($c,$userResource);
        return new \App\Helper\AuthHelper();
    };

    $container['flash'] = function($container) {
        return new \Slim\Flash\Messages;
    };

    // -----------------------------------------------------------------------------
    // Controller factories
    // -----------------------------------------------------------------------------


    $container['AuthController'] = function ($c) {
        return new Controller\Auth\AuthController($c);
    };

    $container['HomeController'] = function ($c) {
        return new Controller\HomeController($c);
    };

    $container['PainelController'] = function ($c) {
        return new Controller\PainelController($c);
    };

    $container['UnidadeController'] = function($c){
        return new Controller\UnidadeController($c);
    };

    $container['UsuarioController'] = function ($c) {
        return new Controller\UsuarioController($c);
    };

};
