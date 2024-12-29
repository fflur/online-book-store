<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
    http_response_code(405);
    echo json_encode(['message' => 'Method not allowed. Only DELETE requests are supported.']);
    exit;
}

// Check if the connection is HTTPS
/*if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] !== 'on') {*/
/*    http_response_code(403);*/
/*    echo json_encode(['error' => 'HTTPS is required.']);*/
/*    exit;*/
/*}*/

require_once __DIR__ . '/../../../utils/api_database.php';
require_once __DIR__ . '/../../../utils/api_utils.php';
require_once __DIR__ . '/../../../utils/auth_utils.php';
session_start();


if (!isset($_SESSION['owner_username'])) {
    http_response_code(401);
    echo json_encode([
        'message' => 'Unauthorized. Only an owner can delete managers.'
    ]);
    exit;
}

$rqst_data = json_decode(file_get_contents('php://input'), true);

if ($rqst_data === null) {
    http_response_code(400);
    echo json_encode(['message' => 'Invalid JSON data.']);
    exit;
}

if (
    !isset($rqst_data['manager_username']) ||
    empty($rqst_data['manager_username'])
) {
    http_response_code(400);
    echo json_encode(['message' => "Missing manager's username"]);
    exit;
}

$manager_username = $rqst_data['manager_username'];

if (RemoveManager($manager_username)) {
    http_response_code(200);
    echo json_encode(['message' => 'Manager deleted successfully.']);
} else {
    http_response_code(500);
    echo json_encode([
        'message' => 'Failed to delete manager.',
        'reasons' => [
            'Manager with such a username doesn\'t exist',
            'Querying database failed'
        ]
    ]);
}

?>
