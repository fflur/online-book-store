<?php

declare(strict_types = 1);
require_once __DIR__ . '/database_connector.php';
require_once __DIR__ . '/book_api_procedures.php';

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

$rqst_uri = $_SERVER['REQUEST_URI'];

//Get the query string
$qery_strg = parse_url($rqst_uri, PHP_URL_QUERY);

//Remove the query string from the URI
$rqst_path = str_replace("?".$qery_strg, "", $rqst_uri);

$path_prts = explode('/', trim($rqst_path, '/'));

if (empty($path_prts[0])) {
    http_response_code(400);
    echo json_encode(['error' => 'No resource specified.']);
    exit;
}

//If the qery_strg is not empty then parse it
if(!empty($qery_strg)) parse_str($qery_strg, $_GET);
$gnre_cgry = 'gnre';
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
$offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;

switch ($path_prts[3]) {
    case 'filter':
        if(!empty($_GET))
            GetBooksByFilter($msql_dtbs, $_GET, $limit, $offset);
        else {
            http_response_code(400);
            echo json_encode(['error' => 'No filter provided.']);
            exit;
        }
        break;

    case 'genre': // New case for genre filtering
        if(!empty($_GET[$gnre_cgry])) { //Check if genre is provided in query parameter
            $genres = is_array(
                $_GET[$gnre_cgry]
            ) ? $_GET[$gnre_cgry] : [$_GET[$gnre_cgry]];
            GetBooksByGenre($msql_dtbs, $genres, $limit, $offset);
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'No genre provided.']);
            exit;
        }
        break;

    default:
        if (is_numeric($path_prts[0]))
            GetBooksById($msql_dtbs, (int)$path_prts[0]);
        else {
            http_response_code(400);
            echo json_encode(['error' => $path_prts]);
        }
}

?>
