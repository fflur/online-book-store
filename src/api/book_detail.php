<?php

require(__DIR__ . '/Connector.php');

header('Access-Control-Allow-Origin: http://localhost');
header('Access-Control-Allow-Methods: GET');
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $rows = $msql_dtbs->query(
        'SELECT PBLG_DATE, TTLE, ATHR, GNRE,'.
        'PBLR, CVER_IMGE_UFRL, REVW_SCRE FROM BOOKS WHERE ID = ' .
        $_GET['idfr'] .
        ';'
    );

    echo json_encode($rows->fetch_assoc());
}

else header('HTTP/1.1 405 Method not allowed');

header_remove();

?>
