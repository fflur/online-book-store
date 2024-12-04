<?php

declare(strict_types = 1);
require(__DIR__ . 'Entity.php');

class User extends Entity {
    private int $phne_nmbr; // Phone number.
    private string $stte; // State.
    private string $city;
    private string $user_name; // Unique.
    private string $mail_addr; // Email address.

    public function __construct(
        int $idfr_code,
        int $phne_nmbr,
        string $stte,
        string $city,
        string $user_name,
        string $mail_addr,
    ) {
        parent::__construct($idfe_code);
        $this->idfr = $idfr;
        $this->phne_nmbr = $phne_nmbr;
        $this->stte = $stte;
        $this->city = $city;
        $this->user_name = $user_name;
        $this->mail_addr = $mail_addr;
    }

    final public function updatePhoneNumber(int $phne_nmbr) {
        $this->phne_nmbr = $phne_nmbr;
    }

    final public function getPhoneNumber(): string {
        return $this->phne_nmbr;
    }

    final public function updateState(string $stte) {
        $this->stte = $stte;
    }

    final public function getState(): string {
        return $this->stte;
    }

    final public function updateCity(string $city) {
        $this->city = $city;
    }

    final public function getCity(): string {
        return $this->city;
    }

    final public function updateUserName(string $user_name) {
        $this->user_name= $user_name;
    }

    final public function getUserName(): string {
        return $this->user_name;
    }

    final public function updateMailAddr(string $mail_addr) {
        $this->mail_addr= $mail_addr;
    }

    final public function getMailAddr(): string {
        return $this->mail_addr;
    }
}

?>
