<?php

declare(strict_types = 1);
require(__DIR__ . '/Customer.php');

final class Member extends Customer {
    private bool $is_member = true;

    public function __construct(Customer $csmr) {
        parent::__construct(
            $csmr.getIdentifierCode(),
            $csmr.getPhoneNumber(),
            $csmr.getState(),
            $csmr.getCity,
            $csmr.getUserName(),
            $csmr.getMailAddr(),
            $csmr.getFirstName(),
            $csmr.getLastName(),
        );

        this->setMiddleName($csmr.getMiddleName);
    }
}

?>
