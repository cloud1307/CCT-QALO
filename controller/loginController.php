<?php
session_start();
require_once '../model/user.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = new User();
    $result = $user->login($_POST['email'], $_POST['password']);

    if ($result) {
        $_SESSION['user_id'] = $result['id'];
        $_SESSION['user_email'] = $result['email'];
        header("Location: ../index.php");
        exit();
    } else {
        $error = "Invalid email or password.";
        include '../view/login.php';
    }
} else {
    include '../view/login.php';
}

?>