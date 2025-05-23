<?php


class HomeController extends BaseController
{
    public  function index()
    {
        $nome = "rafael";

        $model = $this->loadModel('userModel');

        $this->renderView("home/index", ["data" => $nome]);
        // require_once './app/views/home/home.php';
    }
  
}
