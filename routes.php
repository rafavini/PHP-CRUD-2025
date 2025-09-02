<?php
require __DIR__ . '/vendor/autoload.php';
require 'Core/Router.php';


$router = new Core\Router();

$router->get('/','homeController:index');

$router->get('/login','loginController:index');
$router->run();