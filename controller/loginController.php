<?php
session_start();
session_regenerate_id(true);
require_once '../model/user.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	try {
		$email = trim($_POST['email']) . '@citycollegeoftagaytay.edu.ph';
		$password = $_POST['password'];

		$user = new User();
		$result = $user->login($email, $password);

		if ($result) {
			$_SESSION['user_id'] = $result['intAccount_ID'];
			$_SESSION['user_email'] = $result['varEmail'];
			$_SESSION['user_level'] = $result['enumUserLevel'];
		
			header("Location: ../view/index.php");
			exit();

		} else {
			header("Location: ../view/login.php?error=" . urlencode("Invalid email or password."));
			exit();
		}
	} catch (Exception $e) {
		// Log error message instead of showing it to user
		error_log("Login error: " . $e->getMessage());
		header("Location: ../view/login.php?error=" . urlencode("An internal error occurred. Please try again later."));
		exit();
	}
} else {
	header("Location: ../view/login.php");
	exit();
}

?>