<?php
session_start();
session_regenerate_id(true);
require_once '../model/user.php';

$user = new User();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'login') {
        try {
            $email = trim($_POST['email']) . '@citycollegeoftagaytay.edu.ph';
            $password = $_POST['password'];

            $result = $user->login($email, $password);

            switch ($result['status']) {
                case 'success':
                    $_SESSION['user_id'] = $result['data']['intAccountID'];
                    $_SESSION['employeeID'] = $result['data']['intEmployeeID'];
                    header("Location: ../view/index.php");
                    exit();

                case 'deactivated':
                    header("Location: ../view/login.php?error=" . urlencode("Your account is deactivated. Please contact the admin."));
                    exit();

                case 'invalid_password':
                case 'not_found':
                default:
                    header("Location: ../view/login.php?error=" . urlencode("Invalid email or password."));
                    exit();
            }

        } catch (Exception $e) {
            error_log("Login error: " . $e->getMessage());
            header("Location: ../view/login.php?error=" . urlencode("An internal error occurred."));
            exit();
        }
    } elseif ($action === 'signup') {
        $email = trim($_POST['email']) . "@citycollegeoftagaytay.edu.ph";
        $recovery_email = trim($_POST['alternativeEmail']);
        $contact_number = trim($_POST['contact_number']);

        if ($user->emailExists($email)) {
            header("Location: ../view/signup.php?error=" . urlencode("Your Email is already in use."));
            exit();
        }

        $password = $user->generateSecurePassword();

        if ($user->register($email, $password, $recovery_email, $contact_number)) {
            header("Location: ../view/login.php?success=" . urlencode("Registration successful."));
            exit();
        } else {
            header("Location: ../view/signup.php?error=" . urlencode("Registration failed."));
            exit();
        }
    }

} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && ($_GET['action'] ?? '') === 'logout') {
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
