<?php

declare(strict_types = 1);
require(__DIR__ . '../entities/User.php');

// Customer is anyone who wanna buy a book.
class Customer extends User {
    private string $frst_name; // Required.
    private string $mdle_name; // Optional.
    private string $last_name; // Required.

    public function __construct(string $frst_name, string $last_name) {
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
}

?>
