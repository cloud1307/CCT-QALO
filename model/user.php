<?php

require_once '../include/config.php';

class User {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function login($email, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM tbl_account WHERE varEmail = ? AND varPassword = ?");
        $stmt->bind_param("ss", $email, $password); // In real apps, hash password
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc(); // returns user or null
    }
}

?>
