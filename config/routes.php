<?php

use App\Controllers\TodoController\TodoController;
use App\Core\Router;


$route = new Router();

$route->get('/', function() {
    echo 'Home';
});

$route->resolve();
