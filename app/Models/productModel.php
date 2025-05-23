<?php

// Define a class named Book this will be the Book model
class ProductModel
{

    // Declare a private property to hold the database connection
    private $db;

    // Constructor method to initialize the database connection
    public function __construct()
    {
        // Create a new instance of the Database class and assign it to $db
        $this->db = new Database();
    }

    public function GetAllProducts()
    {
        // Prepare a SQL query to select all records from the book table
        $this->db->query("SELECT * FROM book");
        // Execute the prepared query
        $this->db->execute();
        // Return the results of the query
        return $this->db->results();
    }
}