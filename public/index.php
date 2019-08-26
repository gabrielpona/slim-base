<?php
if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}


//Custom Functions
//TODO: Criar arquivo separado
//----------------------------------------------------------------------------------------------------------------------
function url($compl = null){

    $protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : 'http://';
    $hostname = $_SERVER['SERVER_NAME'];
    $port = $_SERVER['SERVER_PORT']!="80"?":".$_SERVER['SERVER_PORT']:"";

    return $protocol.$hostname.$port.$compl;
}

function appName(){
    return "SLIM Base";
}
//----------------------------------------------------------------------------------------------------------------------

$app = require __DIR__ . '/../src/bootstrap.php';

session_start();

// Instantiate the app
$settings = require __DIR__ . '/../src/settings.php';
$app = new \Slim\App($settings);

// Set up dependencies
$dependencies = require __DIR__ . '/../src/dependencies.php';
$dependencies($app);

// Register middleware
$middleware = require __DIR__ . '/../src/middleware.php';
$middleware($app);

// Register routes
$routes = require __DIR__ . '/../src/routes.php';
$routes($app);

// Run app
$app->run();


//php -S localhost:8080 -t public public/index.php

//https://github.com/dappur/framework
//https://github.com/bryanjhv/slim-session
//SLIMBORN

//$conn->getParams()