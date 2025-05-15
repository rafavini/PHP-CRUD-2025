<?php

// Define a class named Book this will be the Book model
class UserModel
{

    // Declare a private property to hold the database connection
    private $db;

    // Constructor method to initialize the database connection
    public function __construct()
    {
        // Create a new instance of the Database class and assign it to $db
        $this->db = new Database();
    }

    public function AddUser($username, $password, $email, $role)
    {
        $this->db->query("INSERT INTO USUARIO (username,password,email,role) VALUES(:username, :password, :email, :role)");
        $this->db->bind(':username', $username);
        $this->db->bind(':password', $password);
        $this->db->bind(':email', $email);
        $this->db->bind(':role', $role);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

        public function UpdateUser($id, $username, $password, $email, $role)
    {
        // Prepare a SQL query to update a record in the book table
        $this->db->query("UPDATE usuario SET username=:username, password=:password, email=:email, role=:role WHERE id=:id");
        // Bind the isbn parameter to the query
        $this->db->bind(':username', $username);
        // Bind the title parameter to the query
        $this->db->bind(':password', $password);
        // Bind the author parameter to the query
        $this->db->bind(':email', $email);
        $this->db->bind(':role', $role);
        // Bind the id parameter to the query
        $this->db->bind(':id', $id);
        // Execute the prepared query
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function getUserById($id)
    {
        // Prepare a SQL query to select a record from the book table by ID
        $this->db->query("SELECT * FROM usuario WHERE id=:id");
        // Bind the id parameter to the query
        $this->db->bind(':id', $id);
        // Execute the prepared query
        $this->db->execute();
        // Return the result of the query
        return $this->db->result();
    }
}
