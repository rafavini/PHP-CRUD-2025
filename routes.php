<?php
require __DIR__ . '/vendor/autoload.php';
require 'Core/Router.php';


$router = new Core\Router();

// $router->get('/','homeController:index');

$router->get('/','loginController:index');
$router->get('/home','homeController:index');


// Rotas API (não precisa passar o namespace)
// $router->get('/api/auth', 'authController:index');
$router->post('/api/auth', 'authController:authenticate');

$router->run();