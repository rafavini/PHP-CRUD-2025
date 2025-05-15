<?php

// Define the Controller class
class BaseController
{
    // Method to load a model
    // Takes the model name as a parameter

    // This will load the model from the models directory
    // 
    // ex: Book model from Book.php
    // ------------------------------------------
    // require_once '../app/models/Book.php';
    // return new Book;
    // ------------------------------------------



    protected function loadModel($model)
    {
        // Include the model file from the models directory
        // require_once '../app/models/' . $model . '.php';
        // require_once "../Models/" . $model . ".php";
        // require_once "../Models/BookModel.php";
        require_once __DIR__ . '/../Models/' . $model . '.php';


        // Instantiate and return the model object
        return new $model;
    }

    // Method to render a view
    // Takes the view path, data array, and optional title as parameters
    protected function renderView($viewPath, $data = [], $title = "Book Store")
    {
        // Extract the data array into individual variables
        extract($data);
        // Include the layout file from the views directory
        // require_once '../views/layout.php';
        require_once __DIR__ . "/../Views/layout.php";
    }
}