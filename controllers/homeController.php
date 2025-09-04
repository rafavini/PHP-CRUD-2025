<?php


class HomeController
{
    private $fileModel;

    public function __construct()
    {
        $this->fileModel = new FileModel();
    }
    public function index()
    {
        $result = $this->fileModel->getAllFiles();   
        require __DIR__ . '/../views/home.php';
    }
}