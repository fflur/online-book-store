<?php

declare(strict_types = 1);
require_once __DIR__ . '/User.php';
require_once __DIR__ . '/../utils/UserType.php';

class Manager extends User {
    private UserType $mber_stts = UserType::Manager;

    public function __construct(
        string $frst_name,
        ?string $mdle_name,
        string $last_name,
        string $user_name,
        string $pswd,
        string $mail_addr,
        string $phne_nmbr,
        string $stte,
        string $dsrt,
        string $strt,
        string $home_nmbr,
        ?string $desc,
    ) {
        parent::__construct(
            $frst_name,
            $mdle_name,
            $last_name,
            $user_name,
            $pswd,
            $mail_addr,
            $phne_nmbr,
            $stte,
            $dsrt,
            $strt,
            $home_nmbr,
            $desc
        );
    }

    public function GetMemberStatus(): UserType {
        return $this->mber_stts;
    }
}

?>
