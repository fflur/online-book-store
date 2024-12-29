<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode([
        'message' => 'Method not allowed. Only GET requests are supported.'
    ]);
    exit;
}

// Check if the connection is HTTPS
/*if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] !== 'on') {*/
/*    http_response_code(403);*/
/*    echo json_encode(['message' => 'HTTPS is required.']);*/
/*    exit;*/
/*}*/

require_once __DIR__ . '/../../../utils/api_database.php';
require_once __DIR__ . '/../../../utils/api_utils.php';
session_start();

if (!isset($_SESSION['owner_username'])) {
    http_response_code(401);
    echo json_encode(['message' => 'Unauthorized. Only owners can view managers.']);
    exit;
}

$owner_username = $_SESSION['owner_username'];

$limit =
    isset($_GET['limit']) && is_numeric($_GET['limit']) ?
    (int)$_GET['limit'] : 10
;

$offset =
    isset($_GET['offset']) && is_numeric($_GET['offset']) ?
    (int)$_GET['offset'] : 0
;

$managers = FetchManagers($limit, $offset);

if ($managers !== false) {
    http_response_code(200);
    echo json_encode(['managers' => $managers]);
} else {
    http_response_code(500);
    echo json_encode(['message' => 'Failed to fetch managers.']);
}


?>
