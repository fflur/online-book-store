<?php

declare(strict_types = 1);
require_once __DIR__ . '/database_connector.php';
require_once __DIR__ . '/../entities/Book.php'

header('Access-Control-Allow-Origin: http://localhost');
header('Access-Control-Allow-Methods: GET');
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405); // Method Not Allowed
    exit;
}

?>
