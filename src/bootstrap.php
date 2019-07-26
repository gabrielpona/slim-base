<?php

// bootstrap.php

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Cache\FilesystemCache;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\ORM\Tools\Setup;
use Slim\Container;

/*
if (!defined('APP_ROOT')) {
    $spl = new SplFileInfo(__DIR__ . '/src');
    define('APP_ROOT', $spl->getRealPath());
}
*/

require_once __DIR__ . '/../vendor/autoload.php';

//Loading Dotenv Parameters
$dotenv = null;
try {
    $dotenv = (new \Dotenv\Dotenv(__DIR__ . '/../'))->load();
} catch (\Dotenv\Exception\InvalidPathException $e) {
    echo $e;
}

$container = new Container(require __DIR__ . '/settings.php');

$container[EntityManager::class] = function (Container $container): EntityManager {

    $config = Setup::createAnnotationMetadataConfiguration(
        $container['settings']['doctrine']['meta']['entity_path'],
        $container['settings']['doctrine']['dev_mode']
    );

    $config->setMetadataDriverImpl(
        new AnnotationDriver(
            new AnnotationReader,
            $container['settings']['doctrine']['meta']['entity_path']
        )
    );

    $config->setMetadataCacheImpl(
        new FilesystemCache(
            $container['settings']['doctrine']['meta']['cache_dir']
        )
    );

    return EntityManager::create(
        $container['settings']['doctrine']['connection'],
        $config
    );
};

return $container;