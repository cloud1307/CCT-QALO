<?php
require_once '../include/config.php';

class User {
	private $conn;

	public function __construct() {
		$db = new Database();
		$this->conn = $db->connect();

		if (!$this->conn) {
			throw new Exception("Database connection failed.");
		}
	}

	public function login($email, $password) {
		$query = "SELECT * FROM tbl_account WHERE varEmail = ?";
		$stmt = $this->conn->prepare($query);

		if (!$stmt) {
			throw new Exception("Login query preparation failed: " . $this->conn->error);
		}

		$stmt->bind_param("s", $email);
		$stmt->execute();
		$result = $stmt->get_result();
		$user = $result->fetch_assoc();

		$stmt->close();

		if ($user && password_verify($password, $user['varPassword'])) {
			return $user;
		}

		return false;
	}

	public function emailExists($email) {
		$query = "SELECT intAccount_ID FROM tbl_account WHERE varEmail = ?";
		$stmt = $this->conn->prepare($query);

		if (!$stmt) {
			throw new Exception("Email check query preparation failed: " . $this->conn->error);
		}

		$stmt->bind_param("s", $email);
		$stmt->execute();
		$stmt->store_result();
		$exists = $stmt->num_rows > 0;
		$stmt->close();

		return $exists;
	}

	public function register($email, $password, $recoveryEmail, $contactNumber) {
		$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

		$query = "INSERT INTO tbl_account (varEmail, varPassword, varRecoveryEmail, varContactNumber, dateCreated)
		          VALUES (?, ?, ?, ?, NOW())";
		$stmt = $this->conn->prepare($query);

		if (!$stmt) {
			throw new Exception("Registration query preparation failed: " . $this->conn->error);
		}

		$stmt->bind_param("ssss", $email, $hashedPassword, $recoveryEmail, $contactNumber);
		$success = $stmt->execute();
		$stmt->close();

		return $success;
	}
}
?>