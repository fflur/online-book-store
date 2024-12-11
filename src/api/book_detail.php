<?php

require(__DIR__ . '/Connector.php');

header('Access-Control-Allow-Origin: http://localhost');
header('Access-Control-Allow-Methods: GET');
header('Content-Type: application/json; charset=utf-8');

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if (!isset($_GET['id'])) {
            header("HTTP 204 'id' value not found");
        }

        else {
            header('HTTP/1.1 200 OK');
            $rows = $msql_dtbs->query(
                'SELECT PBLG_DATE, TTLE, ATHR, GNRE,'.
                'PBLR, CVER_IMGE_UFRL, REVW_SCRE FROM BOOKS WHERE ID = ' .
                $_GET['id'] .
                ';'
            );
            echo json_encode($rows->fetch_assoc());
        }

        break;

    default:
        header('HTTP/1.1 405 Method not allowed');
}

header_remove();

?>
