<?php

if (!defined('APP_ROOT')) {
    define('APP_ROOT', __DIR__);
}


return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'blade_template_path' => __DIR__ . '/../templates/',
            'blade_cache_path' => __DIR__ .'/../cache/'
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
                'driver' => 'pdo_mysql',
                'host' => 'localhost',
                'port' => 3306,
                'dbname' => 'slimdb',
                'user' => 'root',
                'password' => '',
                'charset' => 'utf8'
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
