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
    echo json_encode([
        'message' => 'Method not allowed. Only POST requests are supported.'
    ]);
    exit;
}

/*if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] !== 'on') {*/
/*    http_response_code(403); // Forbidden*/
/*    echo json_encode(['error' => 'HTTPS is required.']);*/
/*    exit;*/
/*}*/

session_start();
require_once __DIR__ . '/../../../utils/api_database.php';
require_once __DIR__ . '/../../../utils/auth_utils.php';
require_once __DIR__ . '/../../../utils/api_utils.php';
require_once __DIR__ . '/../../../entities/Manager.php';

if (!isset($_SESSION['owner_username'])) {
    http_response_code(401);
    echo json_encode([
        'message' => 'Unauthorized. Only owners can create managers.'
    ]);
    exit;
}

$mngr_data = json_decode(file_get_contents('php://input'), true);

$required_fields = [
    'first_name',
    'last_name',
    'username',
    'password',
    'email_address',
    'phone_number',
    'state',
    'district',
    'street',
    'house_number',
];

foreach ($required_fields as $field)
    if (!isset($mngr_data[$field])) {
        http_response_code(400);
        echo json_encode(['message' => 'Missing required field: ' . $field]);
        $msql_dtbs->close();
        exit;
    }

$manager = new Manager(
    $mngr_data['first_name'],
    $mngr_data['middle_name'] ?? null,
    $mngr_data['last_name'],
    $mngr_data['username'],
    $mngr_data['password'],
    $mngr_data['email_address'],
    $mngr_data['phone_number'],
    $mngr_data['state'],
    $mngr_data['district'],
    $mngr_data['street'],
    $mngr_data['house_number'],
    $mngr_data['description'] ?? null,
);

if (AddManager($manager)) {
    http_response_code(201);
    echo json_encode([
        'message' => 'Success!'
    ]);
} else {
    http_response_code(500);
    echo json_encode([
        'message' => 'Failed! Already exists.'
    ]);
}

?>
