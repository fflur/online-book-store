<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed. Only POST requests are supported.']);
    exit;
}

session_start();

if (!isset($_SESSION['owner_username'])) {
    http_response_code(200);
    echo json_encode(['message' => 'Invalid! Login first.']);
    exit;
}

$_SESSION = array();

if (ini_get("session.use_cookies")) {
    $_SESSION = []; // Clearing session variables.
    $params = session_get_cookie_params();

    // Clearing session cookie.
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Destroy the session.
session_destroy();
http_response_code(200);
echo json_encode([
    'message' => 'Logout successful.',

]);

?>
