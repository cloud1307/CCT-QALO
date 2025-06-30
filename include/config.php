<?php
    date_default_timezone_set('Asia/Manila');

class Database {
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $dbname = "db_cct_qalo";
    public $conn;

    public function connect() {
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->dbname);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

        return $this->conn;
    }
}

?>