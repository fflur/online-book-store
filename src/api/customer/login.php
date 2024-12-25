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
            'Only POST requests are supported for registration.'
    ]);
    exit;
}

require_once __DIR__ . '/../database_connector.php';
require_once __DIR__ . '/customer_procedures.php';
require_once __DIR__ . '/../../entities/Customer.php';

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

?>
