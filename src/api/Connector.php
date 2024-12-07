<?php

declare(strict_types = 1);

class DatabaseConnectionDetails {
    private string $dtbs_name = 'BOOKSTORE';
    private string $user_name = 'root';
    private string $domn = 'localhost';
    private string $pswd = '9051';

    final public function getDatabaseName(): string {
        return $this->dtbs_name;
    }

    final public function getUserName(): string {
        return $this->user_name;
    }

    final public function getDomain(): string {
        return $this->domn;
    }

    final public function getPassword(): string {
        return $this->pswd;
    }
}

$dtbs_cntn_dtls = new DatabaseConnectionDetails();

$dtbs_cntn = new mysqli(
    $dtbs_cntn_dtls->getDomain(),
    $dtbs_cntn_dtls->getUserName(),
    $dtbs_cntn_dtls->getPassword(),
    $dtbs_cntn_dtls->getDatabaseName(),
);

?>
