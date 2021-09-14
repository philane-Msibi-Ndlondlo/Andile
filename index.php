<?php
require "vendor/autoload.php";
require "src/Configs/constants.php";
use Andile\Domain\Core\App;
use Andile\Domain\Core\Request;
use Andile\Domain\Core\Response;
use Andile\Domain\Core\Router;

$app = new App();

$router = new Router();

$router->get("/", function(Request $request, Response $response) {

    $response->render('welcome');

});
    
$app->register($router);
