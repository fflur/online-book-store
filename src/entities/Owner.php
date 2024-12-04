<?php

declare(strict_types = 1);
require(__DIR__ . '../entities/Owner.php');

final class Owner extends User {
    private string $frst_name; // Required.
    private string $mdle_name; // Optional.
    private string $last_name; // Required.

    public function __construct(
        int $idfr,
        int $phne_nmbr,
        string $stte,
        string $city,
        string $user_name,
        string $mail_addr,
        string $frst_name,
        string $last_name,
    ) {
        parent::__construct(
            $idfr,
            $phne_nmbr,
            $stte,
            $city,
            $user_name,
            $mail_addr,
        );

        $this->frst_name = $frst_name;
        $this->last_name = $last_name;
    }

    public function setFirstName(string $frst_name) {
        $this->frst_name = $frst_name;
    }

    public function setMiddleName(string $mdle_name) {
        $this->mdle_name = $mdle_name;
    }

    public function setLastName(string $last_name) {
        $this->last_name = $last_name;
    }

    public function getFirstName(): string {
        return $this->frst_name;
    }

    public function getMiddleName(): string {
        return $this->mdle_name;
    }

    public function getLastName(): string {
        return $this->last_name;
    }
}

?>
