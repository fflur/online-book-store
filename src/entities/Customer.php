<?php

declare(strict_types = 1);
require_once __DIR__ . '/User.php';
require_once __DIR__ . '/../utils/UserType.php';

class Customer extends User {
    private string $frst_name;
    private ?string $mdle_name;
    private string $last_name;
    private UserType $mber_stts = UserType::Normal;

    public function __construct(
        string $frst_name,
        ?string $mdle_name = null,
        string $last_name,
        string $user_name,
        string $mail_addr,
        string $phne_nmbr,
        string $stte,
        string $dsrt,
        string $strt,
        string $home_nmbr,
        ?string $desc = null,
    ) {
        parent::__construct(
            $user_name,
            $mail_addr,
            $phne_nmbr,
            $stte,
            $dsrt,
            $strt,
            $home_nmbr,
            $desc
        );
        $this->frst_name = $frst_name;
        $this->mdle_name = $mdle_name;
        $this->last_name = $last_name;
    }

    public function GetFirstName(): string {
        return $this->frst_name;
    }

    public function SetFirstName(string $frst_name): void {
        $this->frst_name = $frst_name;
    }

    public function GetMiddleName(): ?string {
        return $this->mdle_name;
    }

    public function SetMiddleName(?string $mdle_name): void {
        $this->mdle_name = $mdle_name;
    }

    public function GetLastName(): string {
        return $this->last_name;
    }

    public function SetLastName(string $last_name): void {
        $this->last_name = $last_name;
    }

    public function GetMemberStatus(): UserType {
        return $this->mber_stts;
    }

    public function SetMemberStatus(UserType $mber_stts): void {
        $this->mber_stts = $mber_stts;
    }
}

?>
