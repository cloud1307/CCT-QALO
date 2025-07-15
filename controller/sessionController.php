<?php
// session_start();
require_once '../model/session.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../view/login.php");
    exit();
}

try {
    $sessionModel = new Session();
    $userData = $sessionModel->getSessionDetailsByUserId($_SESSION['user_id']);

    if (!$userData) {
        $userData = [];
    }
} catch (Exception $e) {
    error_log("SessionController error: " . $e->getMessage());
    $userData = [];
}

//include '../include/mainNavBar.php';
?>
