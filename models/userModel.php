<?php

require_once __DIR__ . "/../Core/database.php";
require_once __DIR__ . "/../Core/helper.php";
require_once __DIR__ . "/../components/alerts.php";
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

    public function getAllUser($limit, $offset)
    {

        try {
            $this->db->query("SELECT * FROM usuario LIMIT $limit OFFSET $offset");
            $this->db->execute();
            $result = $this->db->results();

            $this->db->query("SELECT COUNT(*) as total FROM usuario");
            $totalUsers = $this->db->result()['total'];
            if ($result) {
                return [
                    'users' => $result,
                    'totalUsers' => $totalUsers
                ];
            } else {
                return false;
            }
        } catch (\Throwable $th) {
            echo "Error: " . $th->getMessage();
        }
    }

    public function CreateUser(array $data)
    {
        try {
            $this->db->query("INSERT INTO usuario (username, email, password, role, is_active, date_joined) VALUES (:username, :email, :password, :role, :is_active, CURRENT_TIMESTAMP)");
            $this->db->bind(':username', $data['username']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':password', password_hash($data['password'], PASSWORD_BCRYPT));
            $this->db->bind(':role', $data['role']);
            $this->db->bind(':is_active', 1);
            $result = $this->db->execute();
            if($result){
                return $result;
            }else{
                return false;
            }
        } catch (\Throwable $th) {
            echo "Error: " . $th->getMessage();
        }
    }
}
