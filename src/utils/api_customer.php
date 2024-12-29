<?php

// IsCustomer
// RegisterCustomer
// IsMailAddress
// IsUsername
// IsPassword

declare(strict_types = 1);

// Deprecated. Use `IsMailAddress` and `IsUsername` method instead.
function IsCustomer(mysqli $msql_dtbs, string $username, string $email): bool {
    $stmt = $msql_dtbs->prepare(
        'SELECT EMAIL_ADDRESS FROM CUSTOMERS WHERE USER_NAME = ? OR EMAIL_ADDRESS = ?'
    );

    if ($stmt === false) {
        // Log the error for debugging (don't expose database errors to the client in production)
        error_log("Database query preparation failed: " . $msql_dtbs->error);
        return true; // Treat as if customer exists to prevent information disclosure
    }

    $stmt->bind_param("ss", $username, $email);

    if (!$stmt->execute()) {
        error_log("Database query execution failed: " . $stmt->error);
        $stmt->close();
        return true;
    }

    $stmt->store_result();
    $exists = $stmt->num_rows > 0;
    $stmt->close();
    return $exists;
}

function RegisterCustomer(mysqli $msql_dtbs, Customer $customer): bool {
    $stmt = $msql_dtbs->prepare('
        INSERT INTO CUSTOMERS
        (FIRST_NAME, MIDDLE_NAME, LAST_NAME, USER_NAME,
        EMAIL_ADDRESS, PHONE_NUMBER, STATE, DISTRICT, STREET, HOME_NUMBER)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ');

    if ($stmt === false) {
        error_log("Database query preparation failed: " . $msql_dtbs->error);
        return false;
    }

    $frst_name = $customer->GetFirstName();
    $last_name = $customer->GetLastName();
    $user_name = $customer->GetUserName();
    $mail_addr = $customer->GetMailAddr();
    $mdle_name = $customer->GetMiddleName();
    $phne_nmbr = $customer->GetPhoneNumber();
    $stte = $customer->GetState();
    $dsrt = $customer->GetDistrict();
    $strt = $customer->GetStreet();
    $home_nmbr = $customer->GetHomeNumber();

    $stmt->bind_param('ssssssssss',
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
    );

    if (!$stmt->execute()) {
        error_log("Database query execution failed: " . $stmt->error);
        $stmt->close();
        return false;
    }

    $stmt->close();
    return true;
}

function IsMailAddress(mysqli $msql_dtbs, string $mail_addr): bool {
    $stmt = $msql_dtbs->prepare("SELECT ID FROM CUSTOMERS WHERE EMAIL = ?");

    if ($stmt === false) {
        error_log("Database query preparation failed: " . $msql_dtbs->error);
        return true; // Return true to prevent information disclosure
    }

    $stmt->bind_param("s", $mail_addr);

    if (!$stmt->execute()) {
        error_log("Database query execution failed: " . $stmt->error);
        $stmt->close();
        return true; // Return true to prevent information disclosure
    }

    $stmt->store_result();
    $exists = $stmt->num_rows > 0;
    $stmt->close();

    return $exists;
}

function IsUsername(mysqli $msql_dtbs, string $user_name): bool {
    $stmt = $msql_dtbs->prepare("SELECT USER_NAME FROM CUSTOMERS WHERE USER_NAME = ?");

    if ($stmt === false) {
        error_log("Database query preparation failed: " . $msql_dtbs->error);
        return true; // Prevent information disclosure on error
    }

    $stmt->bind_param("s", $user_name);

    if (!$stmt->execute()) {
        error_log("Database query execution failed: " . $stmt->error);
        $stmt->close();
        return true; // Prevent information disclosure on error
    }

    $stmt->store_result();
    $exists = $stmt->num_rows > 0;
    $stmt->close();

    return $exists;
}

function IsPassword(mysqli $msql_dtbs, string $username, string $clnt_hshd_pswd): bool {
    $stmt = $msql_dtbs->prepare("SELECT PASSWORD FROM CUSTOMERS WHERE USER_NAME = ?");

    if ($stmt === false) {
        error_log("Database query preparation failed: " . $msql_dtbs->error);
        return false;
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($dtbs_hshd_pswd);
        $stmt->fetch();
        $stmt->close();
        return hash_equals($dtbs_hshd_pswd, $clnt_hshd_pswd);
    }

    $stmt->close();
    return false;
}

?>
