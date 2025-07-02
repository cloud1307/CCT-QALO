<?php
require_once '../model/user.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$email = trim($_POST['email']) . "@citycollegeoftagaytay.edu.ph";
	$password = $_POST['password'];
	$confirm_password = $_POST['confirm_password'];
	$recovery_email = trim($_POST['recovery_email']);
	$contact_number = trim($_POST['contact_number']);

	if ($password !== $confirm_password) {
		header("Location: ../view/signup.php?error=" . urlencode("Passwords do not match."));
		exit();
	}

	$user = new User();
	if ($user->emailExists($email)) {
		header("Location: ../view/signup.php?error=" . urlencode("Email is already in use."));
		exit();
	}

	if ($user->register($email, $password, $recovery_email, $contact_number)) {
		header("Location: ../view/login.php?success=" . urlencode("Registration successful."));
		exit();
	} else {
		header("Location: ../view/signup.php?error=" . urlencode("Something went wrong. Try again."));
		exit();
	}
} else {
	header("Location: ../view/signup.php");
	exit();
}
