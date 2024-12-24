<?php

declare(strict_types = 1);
require_once __DIR__ . '/database_connector.php';

header('Content-Type: application/json');
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

$rqst_uri = $_SERVER['REQUEST_URI'];
$path_prts = explode('/', trim($rqst_uri, '/'));

if (empty($path_prts[0])) {
    array_shift($path_prts);
}

if ($path_prts[0] !== 'books') {
    http_response_code(404);
    echo json_encode(['error' => 'Not Found']);
    exit;
}

array_shift($path_prts);
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
$offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;

switch (count($path_prts)) {
    case 0:
        GetAllBooks($msql_dtbs, $limit, $offset);
        break;

    case 1:
        if (is_numeric($path_prts[0]))
            GetBooksById($msql_dtbs, (int)$path_prts[0]);
        else {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid book ID.']);
        }
        break;

    case 2:
        GetBooksByFilter($path_prts[0], $path_prts[1]);
        break;

    default:
        http_response_code(400);
        echo json_encode(['error' => 'Invalid request.']);
}

?>
