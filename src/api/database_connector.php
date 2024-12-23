<?php

declare(strict_types = 1);

class DatabaseConnectionDetails {
    public string $dtbs_name = 'BOOKSTORE';
    public string $user_name = 'root';
    public string $domn = 'localhost';
    public string $pswd = '9051';
}

$dtbs_cntn_dtls = new DatabaseConnectionDetails();

$msql_dtbs = new mysqli(
    $dtbs_cntn_dtls->domn,
    $dtbs_cntn_dtls->user_name,
    $dtbs_cntn_dtls->pswd,
    $dtbs_cntn_dtls->dtbs_name,
);

?>
