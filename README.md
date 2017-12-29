# Simple-Dependency-Container
Simple PHP Dependency Injection Container

```php
<?php
/**
 * @author : Ugurkan Kaya
 * @date   : 29.12.2017
 */

require "vendor/autoload.php";

$container = new \Container\Container();

/**
 * Register multiple services.
 */
$container->registerServices([
   "another.service" => [
       "serviceResolver" => \Container\Test\Connection\Connection::class
   ]
]);

/**
 * Add a closure service.
 */
$container->addClosureService(function(\Container\Container $container) {
   $container->addService("app.connection.service", \Container\Test\Connection\Connection::class);
});

/**
 * Add a service.
 */
$container->addService("app.connection.manager.service", \Container\Test\Connection\ConnectionManager::class, [
    "app.connection.service",
    "localhost",
    3306,
    "root",
    "password",
    "database"
]);
$container->addService("app.service", \Container\Test\App::class, ["app.connection.manager.service"]);

/**
 * Get the registered service.
 */
$getService = $container->resolveService("app.service");

print_r($getService->getConnectionManager());

var_dump($getService->getConnectionManager()->getConnection()->didConnect());

print_r($container->getServices());
```
