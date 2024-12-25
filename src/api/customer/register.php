<?php

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

declare(strict_types = 1);
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

// Check if username and email are provided
if (!isset($data['user_name']) || !isset($data['mail_addr'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Username and email are required.']);
    $msql_dtbs->close();
    exit;
}

$username = $data['user_name'];
$email = $data['mail_addr'];

if (IsCustomer($msql_dtbs, $username, $email)) {
    http_response_code(409); // Conflict (resource already exists)
    echo json_encode(['error' => 'Username or email already exists.']);
    $msql_dtbs->close();
    exit;
}

// Check for required fields
$required_fields = [
    'frst_name',
    'last_name',
    'user_name',
    'mail_addr',
    'mdle_name',
    'phne_nmbr',
    'stte',
    'dsrt',
    'strt',
    'home_nmbr',
];

foreach ($required_fields as $field) {
    if (!isset($data[$field])) {
        http_response_code(400);
        echo json_encode(['error' => "Missing required field: " . $field]);
        $msql_dtbs->close();
        exit;
    }
}

// Create Customer object
$customer = new Customer(
    $data['frst_name'],
    $data['mdle_name'] ?? null,
    $data['last_name'],
    $data['user_name'],
    $data['mail_addr'],
    $data['phne_nmbr'],
    $data['stte'],
    $data['dsrt'],
    $data['strt'],
    $data['home_nmbr'],
    $data['desc'] ?? null
);

if (RegisterCustomer($msql_dtbs, $customer)) {
    http_response_code(201); // Created
    echo json_encode(['message' => 'Customer registered successfully.']);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Customer registration failed.']);
}

$msql_dtbs->close();

?>
