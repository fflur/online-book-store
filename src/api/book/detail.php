<?php

declare(strict_types = 1);

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405); // Method not allowed.
    echo json_encode([
        'error' => 'Method not allowed. Only GET requests are supported.'
    ]);
    exit;
}

require_once __DIR__ . '/../../utils/api_utils.php';

$book_id = $_GET['id'] ?? null;

// Validating inputs
if ($book_id == null) {
    http_response_code(400);
    echo json_encode(['error' => 'Book ID is required.']);
    exit;
}

if (!is_numeric($book_id) || $book_id <= 0) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid book ID. Must be a positive integer.']);
    exit;
}

$book = GetBookDetail((int) $book_id);
$reasons = array(
    'No books found for given criteria.',
    'Internal database query failed.'
);

if ($book) {
    http_response_code(200);
    echo json_encode(['book_detail' => $book]);
} else {
    http_response_code(500);
    echo json_encode([
        'message' => 'No books fetched',
        'reasons' => $reasons
    ]);
}

?>
