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
        'error' => 'Method not allowed. '.
            'Only POST requests are supported for login.'
    ]);
    exit;
}

require_once __DIR__ . '/../../utils/api_database.php';
require_once __DIR__ . '/../../utils/api_customer.php';

$rqst_body = file_get_contents('php://input');
$data = json_decode($rqst_body, true);

// Check if JSON is parsed or not.
if ($data === null) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid JSON data.']);
    $msql_dtbs->close();
    exit;
}

// Check if username and password are provided
if (!isset($data['user_name']) || !isset($data['pswd'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Username and password are required.']);
    $msql_dtbs->close();
    exit;
}

$username = $data['user_name'];
$password = $data['pswd'];

if (!IsUsername($msql_dtbs, $username)) {
    http_response_code(404);
    echo json_encode(['error' => 'No such username.']);
    $msql_dtbs->close();
    exit;
}

if (!IsPassword($msql_dtbs, $username, $password)) {
    http_response_code(401);
    echo json_encode(['error' => 'Incorrect password.']);
    exit;
}

ini_set('session.gc_maxlifetime', 10); // 1800 seconds = 30 minutes

session_set_cookie_params([
    'lifetime' => 1800,
    'secure' => true,
    'httponly' => true,
    'samesite' => 'Strict',
]);

session_start();
session_regenerate_id(true);
$_SESSION['username'] = $username;
http_response_code(200);
echo json_encode(['session_id' => session_id()]);
$msql_dtbs->close();

?>
