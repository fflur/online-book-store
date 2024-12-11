<?php

declare(strict_types = 1);
require(__DIR__ . '/User.php');
require(__DIR__ . '/../utils/UserType.php');

// Customer is anyone who wanna buy a book.
class Customer extends User {
    public string $frst_name; // Required.
    public ?string $mdle_name; // Optional.
    public string $last_name; // Required.
    private UserType $mber_stts = UserType::Normal;

    public function __construct(
        string $phne_nmbr,
        string $stte,
        string $city,
        string $user_name,
        string $mail_addr,
        string $frst_name,
        string $last_name,
    ) {
        parent::__construct(
            -1,
            $phne_nmbr,
            $stte,
            $city,
            $user_name,
            $mail_addr,
        );

        $this->frst_name = $frst_name;
        $this->last_name = $last_name;
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
