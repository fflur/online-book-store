<?php

declare(strict_types = 1);
require(__DIR__ . '/Entity.php');

class User extends Entity {
    public string $phne_nmbr; // Phone number.
    public string $stte; // State.
    public string $city;
    public string $user_name; // Unique.
    public string $mail_addr; // Email address.

    public function __construct(
        int $idfr_code,
        string $phne_nmbr,
        string $stte,
        string $city,
        string $user_name,
        string $mail_addr,
    ) {
        parent::__construct($idfr_code);
        $this->phne_nmbr = $phne_nmbr;
        $this->stte = $stte;
        $this->city = $city;
        $this->user_name = $user_name;
        $this->mail_addr = $mail_addr;
    }
}

?>
