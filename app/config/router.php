<?php

$router = $di->getRouter();

// Define your routes here
$router->add("/index", "Index::index", ["GET"]);
$router->add("/upload", "Index::upload", ["POST"]);


$router->handle($_SERVER['REQUEST_URI']);
