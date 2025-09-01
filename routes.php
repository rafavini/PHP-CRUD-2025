<?php
require 'Core/Router.php';


$router = new Core\Router();

$router->get('/','HomeController:index');

$router->run();