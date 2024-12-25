<?php

declare(strict_types = 1);

function IsCustomer(mysqli $msql_dtbs, string $username, string $email): bool {
    $stmt = $msql_dtbs->prepare(
        'SELECT ID FROM CUSTOMERS WHERE USERNAME = ? OR EMAIL = ?'
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
    $stmt = $msql_dtbs->prepare("
        INSERT INTO CUSTOMERS
        (FIRST_NAME, MIDDLE_NAME, LAST_NAME, USERNAME,
        EMAIL, PHONE_NUMBER, STATE, DISTRICT, STREET, HOME_NUMBER)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    if ($stmt === false) {
        error_log("Database query preparation failed: " . $msql_dtbs->error);
        return false;
    }

    $stmt->bind_param("ssssssssss",
        $customer->frst_name,
        $customer->mdle_name,
        $customer->last_name,
        $customer->user_name,
        $customer->mail_addr,
        $customer->phne_nmbr,
        $customer->stte,
        $customer->dsrt,
        $customer->strt,
        $customer->home_nmbr
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
