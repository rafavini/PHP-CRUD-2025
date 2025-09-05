<?php
require_once __DIR__ . '/../models/fileModel.php';

class HomeController
{
    private $fileModel;

    public function __construct()
    {
        $this->fileModel = new FileModel();
    }
    public function index()
    {
        RequireAuth("admin");
        $result = $this->fileModel->getAllFiles();   
        require __DIR__ . '/../views/home.php';
    }
}