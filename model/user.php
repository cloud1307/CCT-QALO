<?php

require_once '../include/config.php'; // Make sure config.php correctly defines and includes the Database class

class User {
    private $conn;

    // Change 'user()' to '__construct()'
    public function __construct() {
        $db = new Database(); // Assuming Database class is defined in config.php and handles the connection
        $this->conn = $db->connect();
        // It's good practice to add error checking for the connection here
        if ($this->conn === null) {
            // Handle connection error, e.g., throw an exception or log it
            throw new Exception("Database connection failed.");
        }
    }

    public function login($email, $password) {
        // Ensure $this->conn is not null before proceeding
        if ($this->conn === null) {
            throw new Exception("Database connection not established for login.");
        }

        $stmt = $this->conn->prepare("SELECT * FROM tbl_account WHERE varEmail = ?");
        
        // Always check if prepare() was successful
        if ($stmt === false) {
            // Handle SQL prepare error
            throw new Exception("Failed to prepare statement: " . $this->conn->error);
        }

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user['varPassword'])) {
            return $user;
        }

        return false;
    }
}

?>