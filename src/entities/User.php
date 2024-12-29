<?php

declare(strict_types = 1);
require_once __DIR__ . '/Entity.php';

class User extends Entity {
    private string $frst_name; // First name.
    private ?string $mdle_name; // Middle name.
    private string $last_name; // Last name.
    private string $user_name; // Username.
    private string $pswd; // Password.
    private string $mail_addr; // Email address.
    private string $phne_nmbr; // Phone number.
    private string $stte; // State.
    private string $dsrt; // District.
    private string $strt; // Street or road number.
    private string $home_nmbr; // House or building number.

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
        ?string $desc
    ) {
        parent::__construct($desc);
        $this->user_name = $user_name;
        $this->pswd = $pswd;
        $this->mail_addr = $mail_addr;
        $this->phne_nmbr = $phne_nmbr;
        $this->stte = $stte;
        $this->dsrt = $dsrt;
        $this->strt = $strt;
        $this->home_nmbr = $home_nmbr;
        $this->frst_name = $frst_name;
        $this->mdle_name = $mdle_name;
        $this->last_name = $last_name;
    }

    public function GetUsername(): string {
        return $this->user_name;
    }

    public function SetUsername(string $user_name): void {
        $this->user_name = $user_name;
    }

    public function GetPassword(): string {
        return $this->pswd;
    }

    public function GetMailAddr(): string {
        return $this->mail_addr;
    }

    public function SetMailAddr(string $mail_addr): void {
        $this->mail_addr = $mail_addr;
    }

    public function GetPhoneNumber(): ?string {
        return $this->phne_nmbr;
    }

    public function SetPhoneNumber(?string $phne_nmbr): void {
        $this->phne_nmbr = $phne_nmbr;
    }

    public function GetState(): ?string {
        return $this->stte;
    }

    public function SetState(?string $stte): void {
        $this->stte = $stte;
    }

    public function GetDistrict(): ?string {
        return $this->dsrt;
    }

    public function SetDistrict(?string $dsrt): void {
        $this->dsrt = $dsrt;
    }

    public function GetStreet(): ?string {
        return $this->strt;
    }

    public function SetStreet(?string $strt): void {
        $this->strt = $strt;
    }

    public function GetHomeNumber(): ?string {
        return $this->home_nmbr;
    }

    public function SetHomeNumber(?string $home_nmbr): void {
        $this->home_nmbr = $home_nmbr;
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
}

?>
