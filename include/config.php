<?php
    // session_start();
    // date_default_timezone_set('Asia/Manila');
    // $host = "localhost";
    // $db_user = "root";
    // $db_pass = "";
    // $db_name = "db_cct_qalo";
    // $conn = new mysqli($host, $db_user, $db_pass, $db_name);
    // if ($conn->connect_error) {
    //     die("Connection failed: " . $conn->connect_error);
    // }
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