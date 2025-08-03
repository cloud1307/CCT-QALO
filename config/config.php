<?php
date_default_timezone_set('Asia/Manila');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Database {
	private $host = "localhost";
	private $user = "root";
	private $pass = "";
	private $dbname = "db_cct_qalo";

	public function connect() {
		$conn = new mysqli($this->host, $this->user, $this->pass, $this->dbname);

		if ($conn->connect_error) {
			throw new Exception("Connection failed: " . $conn->connect_error);
		}

		return $conn;
	}
}
?>