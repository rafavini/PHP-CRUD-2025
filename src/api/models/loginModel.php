<?php
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../../utils/utils.php";
require_once __DIR__ . "/../../utils/alerts.php";

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
            $this->db->query("SELECT * FROM usuario where email = :email");
            $this->db->bind(':email', $data['email']);
            $this->db->execute();
            $result = $this->db->result();
            if ($result) {
                // Verifica a senha
                if (password_verify($data['password'], $result['password'])) {
    
                    $roleName = MapRole($result["role"]);
    
                    $_SESSION['userAuth'] = [
                        'id' => $result["id"],
                        'username' => $result["username"],
                        'email' => $result["email"],
                        'role' => $roleName
                    ];
    
                    return $result;
                } else {
                    return false; // senha incorreta
                }
            } else {
                return false; // email não encontrado
            }
        } catch (\Throwable $th) {
            echo "Error: " . $th->getMessage();
        }
    }
}
