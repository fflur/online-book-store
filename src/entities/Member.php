<?php

declare(strict_types = 1);
require(__DIR__ . '../entities/Customer.php');

final class Member extends Customer {
    private bool $is_member;

    public function __construct(Customer csmr) {
        parent::__construct(
            csmr.getIdentifierCode(),
            csmr.getPhoneNumber(),
            csmr.getState(),
            csmr.getCity,
            csmr.getUserName(),
            csmr.getMailAddr(),
            csmr.getFirstName(),
            csmr.getLastName(),
        );

        this->setMiddleName(csmr.getMiddleName);
    }
}

?>
