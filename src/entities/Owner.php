<?php

declare(strict_types = 1);
require(__DIR__ . '/User.php');

final class Owner extends User {
    public string $frst_name; // Required.
    public string $mdle_name; // Optional.
    public string $last_name; // Required.

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

?>
