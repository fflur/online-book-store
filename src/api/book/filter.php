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

$filters = [];
$allowed_filters = [
    'genre',
    'author',
    'publishing_year',
    'review_score',
    'language'
];

foreach ($_GET as $key => $value)
    if (in_array(strtolower($key), $allowed_filters))
        $filters[strtoupper($key)] = $value; // Store filters in uppercase for database columns

$limit = $_GET['limit'] ?? 10;
$offset = $_GET['offset'] ?? 0;

// Validate Inputs
if (!(is_numeric($limit) || is_numeric($offset))) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid! Must be an integer.']);
    $msql_dtbs->close();
    exit;
}

$limit = (int)$limit;
$offset = (int)$offset;

if ($limit < 0 || $offset < 0) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid! Must be a non-negative integer.']);
    $msql_dtbs->close();
    exit;
}

$books = GetBooksBy($filters, $limit, $offset);

if ($books) {
    http_response_code(200);
    echo json_encode(['books' => $books]);
} else {
    http_response_code(500);
    echo json_encode(['message' => 'Failed to fetch books']);
}

?>
