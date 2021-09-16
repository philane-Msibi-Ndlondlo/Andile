<?php

use Andile\Domain\Core\Request;
use Andile\Domain\Core\Response;
use Andile\Domain\Core\Router;

$router = new Router();

$router->get("/", function(Request $request, Response $response) {

    $data = [
        "Header" => ["page_title"=> "Home - Andile"]
    ];

    $response->render('welcome', $data);

});

$router->get("/about", function(Request $request, Response $response) {

    $data = [
        "main" => ["description" => "Andile is a free open source PHP framework designed by Philane Msibi"], 
        "Header" => ["page_title"=> "About Andile"]
    ];

    $response->render('about', $data);

});

$router->get("/create-todo", function(Request $request, Response $response) {

    $data = [
        "main" => ["description" => "Andile is a free open source PHP framework designed by Philane Msibi"], 
        "Header" => ["page_title"=> "About Andile"]
    ];

    $response->render('create-todo', $data);

});

$router->get("/todo-success", function(Request $request, Response $response) {

    $data = [
        "main" => ["message" => "Todo was created"], 
        "Header" => ["page_title"=> "Success"]
    ];

    $response->render('todo-success', $data);
});

$router->get("404", function(Request $request, Response $response) {

    $response->render('404', ["Header" => ["page_title"=> "Oops!"]]);

});