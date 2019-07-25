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


    // Register Blade View helper
    $container['view'] = function ($c) {
        $settings = $c->get('settings');
        return new \Slim\Views\Blade(
            $settings['renderer']['blade_template_path'],
            $settings['renderer']['blade_cache_path']
        );
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



    $container['auth'] = function($container) {
        return new \App\Controller\Auth\AuthController($container);
    };

    $container['flash'] = function($container) {
        return new \Slim\Flash\Messages;
    };

    // -----------------------------------------------------------------------------
    // Controller factories
    // -----------------------------------------------------------------------------

    /*
    $container['App\Controller\HomeController'] = function ($c) {
        return new App\Action\HomeAction($c->get('view'), $c->get('logger'));
    };
    */
    $container['HomeController'] = function ($c) {
        $fotoResource = new \App\Resource\FotoResource($c->get('em'));
        return new Controller\HomeController($c,$fotoResource);
    };

    $container['AuthController'] = function ($c) {
        return new Controller\Auth\AuthController($c);
    };


};
