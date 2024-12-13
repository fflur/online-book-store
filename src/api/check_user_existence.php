<?php

require_once __DIR__ . '/Connector.php';

header('Access-Control-Allow-Origin: http://localhost');
header('Access-Control-Allow-Methods: GET');
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405); // Method Not Allowed
    exit;
}

try {
    $stmt = $msql_dtbs->prepare(
        'SELECT COUNT(*) as count FROM CUSTOMER WHERE USERNAME = ?'
    );
    $stmt->bind_param('s', $_GET['user_name']); 
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    http_response_code(200);
    echo json_encode(['exists' => $row['count'] > 0]); 
}

catch (Exception $e) {
    http_response_code(500); 
    echo json_encode(['error' => $e->getMessage()]);
}

?>
