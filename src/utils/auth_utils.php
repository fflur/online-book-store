<?php

// So ... what functions it contains?
// Here is the list:
// IsUsername
// IsPassword
// IsOwner
// IsCustomer
// IsManager

declare(strict_types = 1);
require_once __DIR__ . '/../entities/Manager.php';
require_once __DIR__ . '/api_database.php';

function IsUsername(
    mysqli $msql_dtbs,
    string $username,
    string $dtbs_name
): bool {
    $stmt = $msql_dtbs->prepare(
        "SELECT USER_NAME FROM $dtbs_name WHERE USER_NAME = ?"
    );

    if ($stmt === false) {
        error_log("Database query preparation failed: " . $msql_dtbs->error);
        return false;
    }

    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->store_result();
    $exists = $stmt->num_rows > 0;
    $stmt->close();
    return $exists;
}

function IsPassword(
    mysqli $msql_dtbs,
    string $username,
    string $clnt_hshd_pswd,
    string $dtbs_name
): bool {
    $stmt = $msql_dtbs->prepare(
        "SELECT PASSWORD FROM $dtbs_name WHERE USER_NAME = ?"
    );

    if ($stmt === false) {
        error_log("Database query preparation failed: " . $msql_dtbs->error);
        return false;
    }

    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->bind_result($dtbs_hshd_pswd);
    $stmt->fetch();
    $stmt->close();
    $clnt_hshd_pswd = hash('sha256', $clnt_hshd_pswd); // NOTE: Remove after frontend.
    return $clnt_hshd_pswd === $dtbs_hshd_pswd;
}

function IsOwner(
    string $username,
    string $password,
): bool {
    $msql_dtbs = GetDatabaseInstance();
    if (!IsUsername($msql_dtbs, $username, 'OWNER')) return false;
    if (!IsPassword($msql_dtbs, $username, $password, 'OWNER')) return false;
    $msql_dtbs->close();
    return true;
}

function IsCustomer(
    string $username,
    string $password,
): bool {
    $msql_dtbs = GetDatabaseInstance();
    if (!IsUsername($msql_dtbs, $username, 'CUSTOMERS')) return false;
    if (!IsPassword($msql_dtbs, $username, $password, 'CUSTOMERS')) return false;
    $msql_dtbs->close();
    return true;
}

function IsManager(
    mysqli $msql_dtbs,
    string $username,
    string $password,
): bool {
    if (!IsUsername($msql_dtbs, $username, 'MANAGERS')) return false;
    if (!IsPassword($msql_dtbs, $username, $password, 'MANAGERS')) return false;
    return true;
}

/*function IsUsername(mysqli $msql_dtbs, string $user_name): bool {*/
/*    $stmt = $msql_dtbs->prepare(*/
/*        'SELECT USER_NAME FROM OWNER WHERE USER_NAME = ?'*/
/*    );*/
/**/
/*    if ($stmt === false) {*/
/*        error_log('Database query preparation failed: ' . $msql_dtbs->error);*/
/*        return true; // Prevent information disclosure on error*/
/*    }*/
/**/
/*    $stmt->bind_param('s', $user_name);*/
/**/
/*    if (!$stmt->execute()) {*/
/*        error_log('Database query execution failed: ' . $stmt->error);*/
/*        $stmt->close();*/
/*        return true; // Prevent information disclosure on error*/
/*    }*/
/**/
/*    $stmt->store_result();*/
/*    $exists = $stmt->num_rows > 0;*/
/*    $stmt->close();*/
/**/
/*    return $exists;*/
/*}*/
/**/
/*function IsPassword(*/
/*    mysqli $msql_dtbs,*/
/*    string $username,*/
/*    string $clnt_hshd_pswd*/
/*): bool {*/
/*    $stmt = $msql_dtbs->prepare(*/
/*        'SELECT PASSWORD FROM OWNER WHERE USER_NAME = ?'*/
/*    );*/
/**/
/*    if ($stmt === false) {*/
/*        error_log('Database query preparation failed: ' . $msql_dtbs->error);*/
/*        return false;*/
/*    }*/
/**/
/*    $stmt->bind_param('s', $username);*/
/*    $stmt->execute();*/
/*    $stmt->store_result();*/
/**/
/*    if ($stmt->num_rows === 1) {*/
/*        $stmt->bind_result($dtbs_hshd_pswd);*/
/*        $stmt->fetch();*/
/*        $stmt->close();*/
/*        return hash_equals($dtbs_hshd_pswd, $clnt_hshd_pswd);*/
/*    }*/
/**/
/*    $stmt->close();*/
/*    return false;*/
/*}*/

?>
