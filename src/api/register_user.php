<?php

require_once __DIR__ . '/Connector.php';
require_once __DIR__ . '/../entities/Customer.php';

header('Access-Control-Allow-Origin: http://localhost');
header('Access-Control-Allow-Methods: POST');
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Method Not Allowed
    exit;
}

try {
    $data = json_decode(file_get_contents('php://input'), true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        http_response_code(400); // Bad Request
        echo json_encode(['error' => 'Invalid JSON data']);
        exit;
    }

    $cstr = new Customer(
        $data['phne_nmbr'],
        $data['stte'],
        $data['city'],
        $data['user_name'],
        $data['mail_addr'],
        $data['frst_name'],
        $data['last_name']
    );

    $stmt = $msql_dtbs->prepare("
        INSERT INTO CUSTOMER 
        (USERNAME, PHONE_NUMBER, STATE, CITY,
        EMAIL_ADDRESS, FIRST_NAME, LAST_NAME)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");

    $stmt->bind_param(
        'sssssss',
        $cstr->user_name,
        $cstr->phne_nmbr,
        $cstr->stte,
        $cstr->city,
        $cstr->mail_addr,
        $cstr->frst_name,
        $cstr->last_name
    );

    if ($stmt->execute()) {
        http_response_code(201); // Created
        echo json_encode(['message' => 'User registered successfully']);
    }

    else {
        http_response_code(500); // Internal Server Error
        echo json_encode(['error' => 'Failed to register user']);
    }
}

catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}

?>
