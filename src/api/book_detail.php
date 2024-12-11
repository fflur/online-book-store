<?php

require_once(__DIR__ . '/Connector.php');

header('Access-Control-Allow-Origin: http://localhost');
header('Access-Control-Allow-Methods: GET');
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405); // Method Not Allowed
    exit;
}

try {
    $stmt = $msql_dtbs->prepare(
        'SELECT PBLG_DATE, TTLE, ATHR, GNRE, PBLR,' .
        'CVER_IMGE_UFRL, REVW_SCRE FROM BOOKS WHERE ID = ?'
    );
    $stmt->bind_param('i', $_GET['id']); 
    $stmt->execute();
    $rslt = $stmt->get_result();
    $row = $rslt->fetch_assoc();

    http_response_code(200);
    echo json_encode($row); 
}

catch (Exception $e) {
    http_response_code(500); 
    echo json_encode(['error' => $e->getMessage()]);
}

?>
