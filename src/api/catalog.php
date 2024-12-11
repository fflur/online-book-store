<?php

require(__DIR__ . '/Connector.php');

header('Access-Control-Allow-Origin: http://localhost');
header('Access-Control-Allow-Methods: GET');
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    header('HTTP/1.1 200 OK');

    $rows = $msql_dtbs->query(
        'SELECT * FROM CUSTOMERS WHERE ID = ' .
        $_GET['idfr'] .
        ';'
    );

    echo json_encode($rows->fetch_assoc());
}

else header('HTTP/1.1 405 Method not allowed');

header_remove();

?>
