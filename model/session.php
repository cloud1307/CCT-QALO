<?php
require_once "../config/config.php";

class Session {
	private $conn;

	public function __construct() {
		$db = new Database();
		$this->conn = $db->connect();

		if (!$this->conn) {
			throw new Exception("Database connection failed.");
		}
	}

	// Retrieves joined user details by user ID
	public function getSessionDetailsByUserId($userId) {
		$sql = "SELECT 
					a.*,
					b.*
				FROM tbl_account a
				INNER JOIN tbl_employee b ON b.intAccountID = a.intAccountID
				WHERE a.intAccountID = ?
				LIMIT 1";

		$stmt = $this->conn->prepare($sql);
		
		if (!$stmt) {
			throw new Exception("Prepare failed: " . $this->conn->error);
		}

		$stmt->bind_param("i", $userId);

		if (!$stmt->execute()) {
			throw new Exception("Execute failed: " . $stmt->error);
		}

		$result = $stmt->get_result();
		return $result->fetch_assoc();  // return single row as assoc array
	}
}
?>
