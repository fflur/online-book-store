<?php

declare(strict_types = 1);

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Method Not Allowed
    echo json_encode([
        'message' => 'Method not allowed. '.
            'Only POST requests are supported for login.'
    ]);
    exit;
}

require_once __DIR__ . '/../../utils/auth_utils.php';
$rqst_body = file_get_contents('php://input');
$data = json_decode($rqst_body, true);

// Check if JSON is parsed or not.
if ($data === null) {
    http_response_code(400);
    echo json_encode(['message' => 'Invalid JSON data.']);
    exit;
}

// Check if username and password are provided
if (!isset($data['owner_username']) || !isset($data['password'])) {
    http_response_code(400);
    echo json_encode(['message' => 'Username and password are required.']);
    exit;
}

$username = $data['owner_username'];
$password = $data['password'];

if (!IsOwner($username, $password)) {
    http_response_code(404);
    echo json_encode(['message' => 'No such user!']);
    exit;
}

ini_set('session.gc_maxlifetime', 60 * 5); // 5 minutes.

session_set_cookie_params([
    'lifetime' => 1800,
    'secure' => true,
    'httponly' => true,
    'samesite' => 'Strict',
]);

session_start();
session_regenerate_id(true);
$_SESSION['owner_username'] = $username;
http_response_code(200);
echo json_encode(['session_id' => session_id()]);

?>
