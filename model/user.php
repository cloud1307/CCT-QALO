<?php
require_once '../config/config.php';

class User {
	private $conn;
	private $table_name = "tbl_account";

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
		$query = "SELECT intAccountID FROM tbl_account WHERE varEmail = ?";
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
		$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

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

// class User {
//     private $db;
//     private $table_name = "tbl_account";

//     public function __construct() {
//         $this->db = Database::getInstance()->getConnection();
//     }

//     public function findByUsername($username) {
//         $query = "SELECT intAccount_ID, varEmail, varPassword FROM " . $this->table_name . " WHERE varEmail = ? LIMIT 1";
//         $stmt = $this->db->prepare($query);
//         $stmt->bind_param("s", $username);
//         $stmt->execute();
//         $result = $stmt->get_result();
//         return $result->fetch_assoc();
//     }

//     public function findById($id) {
//         $query = "SELECT intAccount_ID, varEmail FROM " . $this->table_name . " WHERE intAccount_ID = ? LIMIT 1";
//         $stmt = $this->db->prepare($query);
//         $stmt->bind_param("i", $id);
//         $stmt->execute();
//         $result = $stmt->get_result();
//         return $result->fetch_assoc();
//     }

//     public function create($username, $email, $password) {
//         $hashed_password = password_hash($password, PASSWORD_DEFAULT);
//         $query = "INSERT INTO " . $this->table_name . " (username, email, password) VALUES (?, ?, ?)";
//         $stmt = $this->db->prepare($query);
//         $stmt->bind_param("sss", $username, $email, $hashed_password);
//         return $stmt->execute();
//     }

//     public function update($id, $username, $email) {
//         $query = "UPDATE " . $this->table_name . " SET username = ?, email = ? WHERE id = ?";
//         $stmt = $this->db->prepare($query);
//         $stmt->bind_param("ssi", $username, $email, $id);
//         return $stmt->execute();
//     }

//     public function delete($id) {
//         $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
//         $stmt = $this->db->prepare($query);
//         $stmt->bind_param("i", $id);
//         return $stmt->execute();
//     }

//     public function getAllUsers() {
//         $query = "SELECT id, username, email, created_at FROM " . $this->table_name;
//         $result = $this->db->query($query);
//         return $result->fetch_all(MYSQLI_ASSOC);
//     }
// }

?>