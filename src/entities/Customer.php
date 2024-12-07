<?php

declare(strict_types = 1);
require(__DIR__ . '/User.php');
require(__DIR__ . '/../utils/UserType.php');

// Customer is anyone who wanna buy a book.
class Customer extends User {
    private string $frst_name; // Required.
    private ?string $mdle_name; // Optional.
    private string $last_name; // Required.
    private UserType $mber_stts = UserType::Normal;

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

    final public function updateFirstName(string $frst_name) {
        $this->frst_name = $frst_name;
    }

    final public function getFirstName(): string {
        return $this->frst_name;
    }

    final public function setMiddleName(string $mdle_name) {
        $this->mdle_name= $mdle_name;
    }

    final public function getMiddleName(): string {
        return $this->mdle_name;
    }

    final public function updateLastName(string $last_name) {
        $this->last_name = $last_name;
    }

    final public function getLastName(): string {
        return $this->last_name;
    }

    final public function promoteToMember() {
        $this->mber_stts = UserType::Member;
    }

    final public function isMember(): bool {
        return $this->mber_stts == UserType.Member;
    }

    final public function demoteToCustomer() {
        $this->mber_stts = UserType::Normal;
    }
}

?>
