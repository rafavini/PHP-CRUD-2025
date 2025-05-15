<?php

// Define a class named Book this will be the Book model
class LoginModel
{

    // Declare a private property to hold the database connection
    private $db;

    // Constructor method to initialize the database connection
    public function __construct()
    {
        // Create a new instance of the Database class and assign it to $db
        $this->db = new Database();
    }

    public function Auth($username, $password){
        $this->db->query("SELECT * FROM usuario WHERE username = :username and password = :password");
        $this->db->bind(':username', $username);
        $this->db->bind(':password', $password);
        $this->db->execute();
        $data = $this->db->result();
        if($data){
            session_start();
            $_SESSION['userAuth'] = [
                'id' => $data["id"],
                'username' => $data["username"],
                'role' => $data["role"]
            ];
            return True;
        }else{
            return false;
        }
    }
}