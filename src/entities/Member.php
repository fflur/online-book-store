<?php

declare(strict_types = 1);
require(__DIR__ . '../entities/Customer.php');

final class Member extends Customer {
    private bool $is_member;
}

?>
