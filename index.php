<?php
require "vendor/autoload.php";
require "src/Configs/constants.php";
use Andile\Domain\Core\App;
use Andile\Domain\Core\Router;

$app = new App();

$router = new Router();

include_once ROUTES_PATH;

$app->register($router);

$app->router->resolve()

?>