<?php
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../../utils/utils.php";
require_once __DIR__ . "/../../utils/alerts.php";

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

    public function GetAllUsers()
    {
        try {

            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $perPage = isset($_GET['perPage']) ? (int)$_GET['perPage'] : 10;
            $offset = ($page - 1) * $perPage;

            $this->db->query("SELECT id, username, email, role, is_active FROM usuario LIMIT $perPage OFFSET $offset ");
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
