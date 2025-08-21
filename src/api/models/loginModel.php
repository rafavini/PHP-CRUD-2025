<?php
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../../utils/utils.php";

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

    public function Auth(array $data)
    {
        try {
            $this->db->query("SELECT * FROM usuario where email = :email and password = :password");
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':password', $data['password']);
            $this->db->execute();
            $result = $this->db->results();
            if ($result) {

                $roleName = MapRole($result[0]["role"]);

                $_SESSION['userAuth'] = [
                    'id' => $result[0]["id"],
                    'email' => $result[0]["email"],
                    'role' => $roleName
                ];
                return $result[0];
            } else {
                return false;
            }
        } catch (\Throwable $th) {
            echo "Error: " . $th->getMessage();
        }
    }
}
