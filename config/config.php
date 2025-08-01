<?php
date_default_timezone_set('Asia/Manila');
error_reporting(1);

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