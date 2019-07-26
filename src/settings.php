<?php

if (!defined('APP_ROOT')) {
    define('APP_ROOT', __DIR__);
}

return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Twig settings
        'twig' => [
            'template_path' => __DIR__ . '/../resources/views/',
            'cache' => false
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],


        //Doctrine Settings
        'doctrine' => [
            // if true, metadata caching is forcefully disabled
            'dev_mode' => true,

            // path where the compiled metadata info will be cached
            // make sure the path exists and it is writable
            //'cache_dir' => APP_ROOT . '/../var/doctrine',

            // you should add any other path containing annotated entity classes
            //'metadata_dirs' => [APP_ROOT . '/Domain'],

            'connection' => [
                'driver' => getenv('DB_DRIVER'),
                'host' => getenv('DB_HOST'),
                'port' => getenv('DB_PORT'),
                'dbname' => getenv('DB_DATABASE'),
                'user' => getenv('DB_USERNAME'),
                'password' => getenv('DB_PASSWORD'),
                'charset' => getenv('DB_CHARSET')
            ],'meta' => [
                'entity_path' => [
                    APP_ROOT . '/Domain'
                ],
                'auto_generate_proxies' => true,
                'proxy_dir' => APP_ROOT . '/../tmp/doctrine/proxies',
                'cache_dir' => APP_ROOT . '/../tmp/doctrine'
            ],

        ]

    ]
];
