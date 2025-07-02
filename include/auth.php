<?php
if (session_status() === PHP_SESSION_NONE) {
	session_start();
}

// Optional: Regenerate session ID every 10 mins to avoid fixation
if (!isset($_SESSION['CREATED'])) {
    $_SESSION['CREATED'] = time();
} elseif (time() - $_SESSION['CREATED'] > 600) {
    session_regenerate_id(true);
    $_SESSION['CREATED'] = time();
}

// Session timeout logic (15 minutes)
$timeout = 900; // // 900 seconds = 15 mins
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $timeout)) {
    session_unset();
    session_destroy();
    header("Location: ../view/login.php?timeout=1");
    exit();
}
$_SESSION['LAST_ACTIVITY'] = time(); // Update last activity timestamp

if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    header("Location: ../view/login.php");
    exit();
}
?>