<?php
session_start();
session_regenerate_id(true);
require_once '../model/user.php';

$user = new User();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Determine the action: login or signup
    $action = $_POST['action'] ?? '';

    if ($action === 'login') {
        try {
            $email = trim($_POST['email']) . '@citycollegeoftagaytay.edu.ph';
            $password = $_POST['password'];

            $result = $user->login($email, $password);

            if ($result) {
                $_SESSION['user_id'] = $result['intAccountID'];

                header("Location: ../view/index.php");
                exit();
            } else {
                header("Location: ../view/login.php?error=" . urlencode("Invalid email or password."));
                exit();
            }
        } catch (Exception $e) {
            error_log("Login error: " . $e->getMessage());
            header("Location: ../view/login.php?error=" . urlencode("An internal error occurred. Please try again later."));
            exit();
        }
    } elseif ($action === 'signup') {
        $email = trim($_POST['email']) . "@citycollegeoftagaytay.edu.ph";
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $recovery_email = trim($_POST['recovery_email']);
        $contact_number = trim($_POST['contact_number']);

        if ($password !== $confirm_password) {
            header("Location: ../view/signup.php?error=" . urlencode("Passwords do not match."));
            exit();
        }

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
        header("Location: ../view/login.php");
        exit();
    }

} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && ($_GET['action'] ?? '') === 'logout') {
    // Logout process
    $_SESSION = [];
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params['path'], $params['domain'],
            $params['secure'], $params['httponly']
        );
    }
    session_destroy();

    header("Location: ../view/login.php");
    exit();
} else {
    header("Location: ../view/login.php");
    exit();
}


?>