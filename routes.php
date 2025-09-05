<?php
require __DIR__ . '/vendor/autoload.php';
require 'Core/Router.php';


$router = new Router();

// $router->get('/','homeController:index');

$router->get('/','loginController:index');
$router->get('/home','homeController:index',['admin']);


// Rotas API (não precisa passar o namespace)
$router->post('/api/auth', 'authController:authenticate', ['admin']);
// $router->get('/api/file', 'fileController:index', ['admin']);
$router->post('/api/file', 'fileController:createFile', ['admin']);
// print_r($router);
$router->run();