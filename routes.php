<?php
require __DIR__ . '/vendor/autoload.php';
require 'Core/Router.php';


$router = new Router();

// $router->get('/','homeController:index');

$router->get('/','loginController:index',);
$router->get('/home','homeController:index', ["admin", "professor"]);
$router->get('/adminHome','adminController:index',['admin']);
$router->get('/adminCreateUser','adminController:createUserView',['admin']);


// Rotas API (não precisa passar o namespace)
$router->post('/api/auth', 'authController:authenticate',["admin"]);
$router->post('/api/file', 'fileController:createFile', ["admin"]);
$router->post('/api/user', 'userController:createUser', ["admin"]);
// print_r($router);
$router->run();