<?php
session_start();
require_once '../model/user.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	try {
		$email = trim($_POST['email']);
		$password = $_POST['password'];

		$user = new User();
		$result = $user->login($email, $password);

		if ($result) {
			$_SESSION['user_id'] = $result['intAccount_ID'];
			$_SESSION['user_email'] = $result['varEmail'] . '@citycollegeoftagaytay.edu.ph';
			header("Location: ../index.php");
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