<?php

declare(strict_types = 1);
require_once __DIR__ . '/Entity.php';

class User extends Entity {
    private string $user_name;
    private string $mail_addr;
    private ?string $phne_nmbr;
    private ?string $stte;
    private ?string $city;

    public function __construct(
        string $user_name,
        string $mail_addr,
        ?string $phne_nmbr = null,
        ?string $stte = null,
        ?string $city = null,
        ?string $desc = null
    ) {
        parent::__construct($desc);
        $this->user_name = $user_name;
        $this->mail_addr = $mail_addr;
        $this->phne_nmbr = $phne_nmbr;
        $this->stte = $stte;
        $this->city = $city;
    }

    public function GetUsername(): string {
        return $this->user_name;
    }

    public function SetUsername(string $user_name): void {
        $this->user_name = $user_name;
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

    public function GetCity(): ?string {
        return $this->city;
    }

    public function SetCity(?string $city): void {
        $this->city = $city;
    }
}

?>
