<?php

declare(strict_types = 1);

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

?>
