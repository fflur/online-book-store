<?php

declare(strict_types = 1);
require_once __DIR__ . '/User.php';
require_once __DIR__ . '/../utils/UserType.php';

final class Customer extends User {
    private UserType $mber_stts = UserType::Normal;

    public function __construct(
        string $frst_name,
        ?string $mdle_name,
        string $last_name,
        string $user_name,
        string $mail_addr,
        string $phne_nmbr,
        string $stte,
        string $dsrt,
        string $strt,
        string $home_nmbr,
        ?string $desc,
        UserType $user_type = UserType::Normal,
    ) {
        parent::__construct(
            $frst_name,
            $mdle_name,
            $last_name,
            $user_name,
            $mail_addr,
            $phne_nmbr,
            $stte,
            $dsrt,
            $strt,
            $home_nmbr,
            $desc
        );

        $this->mber_stts = $user_type;
    }

    public function GetMemberStatus(): UserType {
        return $this->mber_stts;
    }
}

?>
