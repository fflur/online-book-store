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

require_once __DIR__ . '/../../utils/api_database.php';
require_once __DIR__ . '/../../utils/api_book.php';
require_once __DIR__ . '/../../entities/Book.php';

$book_id = $_GET['id'] ?? null;

// Validating inputs
if ($book_id == null) {
    http_response_code(400);
    echo json_encode(['error' => 'Book ID is required.']);
    $msql_dtbs->close();
    exit;
}

if (!is_numeric($book_id) || $book_id <= 0) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid book ID. Must be a positive integer.']);
    $msql_dtbs->close();
    exit;
}

$book = GetBookDetail($msql_dtbs, (int) $book_id);

if ($book) echo json_encode($book);
else {
    http_response_code(404);
    echo json_encode(['error' => 'Book not found.']);
}

$msql_dtbs->close();

?>
