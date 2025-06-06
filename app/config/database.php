<?php
// usado para tester
// require_once __DIR__ . "/config.php";

class Database{
    private $host = DB_HOST;
    private $dbname = DB_NAME;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbh; // Define database handler
    private $stmt; // Define SQL statement
    private $error; // Define error message

    public function __construct()
    {
        // Data Source Name (DSN) for the PDO connection
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;

        // Options for the PDO connection
        $options = [
            // Use persistent connection 
            // (i.e., This prevents establishing a new connection each time when an instance of Database (object) is created.
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION // Throw exceptions on errors
        ];

        // Try to connect to the database by creating a new PDO instance
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
            
        } catch (PDOException $e) {
            // If an error occurs, store the error message
            $this->error = $e->getMessage();
            // Display error message
            echo $this->error;
        }
    }
    public function query($sql)
    {
        // Prepare the SQL statement
        $this->stmt = $this->dbh->prepare($sql);
    }

    // Method to execute the prepared statement
    public function execute()
    {
        // Execute the statement and return the result
        return $this->stmt->execute();
    }

    // Method to fetch all results as an associative array
    public function results()
    {
        // Fetch all results to an associative array and return them
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Method to fetch a single result to an associative array
    public function result() {
        // Execute the statement
        $this->execute();
        // Fetch and return a single result
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Method to bind a value to a parameter in the SQL statement
    public function bind($param, $value)
    {   
        // Bind the value to the parameter
        $this->stmt->bindValue($param, $value);
    }
}