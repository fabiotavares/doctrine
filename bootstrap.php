<?php

require_once __DIR__ . '/vendor/autoload.php';

use Doctrine\Common\Cache\ArrayCache,
    Doctrine\Common\Annotations\AnnotationReader,
    Doctrine\Common\Annotations\CachedReader,
    Doctrine\ORM\Mapping\Driver\AnnotationDriver,
    Doctrine\ORM\Mapping\Driver\DriverChain,
    Doctrine\ORM\Configuration,
    Doctrine\Common\Annotations\AnnotationRegistry,
    Doctrine\Common\EventManager,
    Doctrine\ORM\EntityManager,
    FT\Sistema\Application;

$cache = new ArrayCache;
$annotationReader = new AnnotationReader;

$cachedAnnotationReader = new CachedReader(
    $annotationReader, // use reader
    $cache // and a cache driver
);

$annotationDriver = new AnnotationDriver(
    $cachedAnnotationReader, // our cached annotation reader
    array(__DIR__ . DIRECTORY_SEPARATOR . 'src')
);

$driverChain = new DriverChain();
$driverChain->addDriver($annotationDriver,'FT');

$config = new Configuration;
$config->setProxyDir('/tmp');
$config->setProxyNamespace('Proxy');
$config->setAutoGenerateProxyClasses(true); // this can be based on production config.
// register metadata driver
$config->setMetadataDriverImpl($driverChain);
// use our allready initialized cache driver
$config->setMetadataCacheImpl($cache);
$config->setQueryCacheImpl($cache);

AnnotationRegistry::registerFile(__DIR__. DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR
    . 'doctrine' . DIRECTORY_SEPARATOR . 'orm' . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'Doctrine'
    . DIRECTORY_SEPARATOR . 'ORM' . DIRECTORY_SEPARATOR . 'Mapping' . DIRECTORY_SEPARATOR . 'Driver' . DIRECTORY_SEPARATOR
    . 'DoctrineAnnotations.php');

$evm = new EventManager();

$em = EntityManager::create(
    array(
        'driver'  => 'pdo_mysql',
        'host'    => '127.0.0.1',
        'port'    => '3306',
        'user'    => 'root',
        'password'  => 'root',
        'dbname'  => 'code_doctrine',
    ),
    $config,
    $evm
);

$app = new Application(array(
    "debug" => true, // Habilita debug
    "em"    => $em   // EntityManager
));
