<?php
session_start();
require_once '../model/user.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $user = new User();
        $result = $user->login($_POST['email'], $_POST['password']);

        if ($result) {
            $_SESSION['user_id'] = $result['id']; // Make sure 'id' exists in your tbl_account
            $_SESSION['user_email'] = $result['varEmail'] . '@citycollegeoftagaytay.edu.ph'; // Use 'varEmail' as per your database
            header("Location: ../index.php");
            exit();
        } else {
            $error = "Invalid email or password.";
            include '../view/login.php';
        }
    } catch (Exception $e) {
        $error = "An application error occurred: " . $e->getMessage();
        // In a production environment, you would log this error and show a generic message to the user.
        include '../view/login.php';
    }
} else {
    include '../view/login.php';
}

?>