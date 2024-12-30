<?php

// So ... what functions it contains?
// Here is the list:
// AddManager
// RemoveManager
// FetchManagers

declare(strict_types = 1);
require_once __DIR__ . '/../entities/Manager.php';
require_once __DIR__ . '/api_database.php';

function AddManager(Manager $manager): bool {
    $msql_dtbs = GetDatabaseInstance();

    if (IsUsername($msql_dtbs, $manager->GetUsername(), 'MANAGERS')) {
        error_log('Manager already exists.');
        return false;
    }

    $hashed_password = password_hash($manager->GetPassword(), PASSWORD_DEFAULT);

    $stmt = $msql_dtbs->prepare(
        'INSERT INTO MANAGERS (
            USER_NAME,
            PASSWORD,
            FIRST_NAME,
            MIDDLE_NAME,
            LAST_NAME,
            EMAIL_ADDRESS,
            PHONE_NUMBER,
            STATE,
            DISTRICT,
            STREET,
            HOME_NUMBER,
            DESCRIPTION
        )
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'
    );

    if ($stmt === false) {
        error_log("Database query preparation failed: " . $msql_dtbs->error);
        return false;
    }

    $username = $manager->GetUsername();
    $password = $manager->GetPassword();
    $first_name = $manager->GetFirstName();
    $middle_name = $manager->GetMiddleName();
    $last_name = $manager->GetLastName();
    $email_address = $manager->GetMailAddr();
    $phone_number = $manager->GetPhoneNumber();
    $state = $manager->GetState();
    $district = $manager->GetDistrict();
    $street = $manager->GetStreet();
    $house_number = $manager->GetHomeNumber();
    $description = $manager->GetDescription();

    $stmt->bind_param('ssssssssssss',
        $username,
        $password,
        $first_name,
        $middle_name,
        $last_name,
        $email_address,
        $phone_number,
        $state,
        $district,
        $street,
        $house_number,
        $description,
    );

    $success = $stmt->execute();
    if (!$success) error_log("Manager creation failed: " . $stmt->error);
    $stmt->close();
    $msql_dtbs->close();
    return $success;
}

function RemoveManager(string $manager_username): bool {
    $msql_dtbs = GetDatabaseInstance();
    if (!IsUsername($msql_dtbs, $manager_username, 'MANAGERS')) return false;
    $stmt = $msql_dtbs->prepare('DELETE FROM MANAGERS WHERE USER_NAME = ?');

    if ($stmt === false) {
        error_log('Database query preparation failed: ' . $msql_dtbs->error);
        return false;
    }

    $stmt->bind_param('s', $manager_username);
    $success = $stmt->execute();
    if (!$success) error_log('Manager deletion failed: ' . $stmt->error);
    $stmt->close();
    $msql_dtbs->close();
    return $success;
}


function FetchManagers(int $limit, int $offset): array|false {
    $sql_query =
        'SELECT
            USER_NAME,
            EMAIL_ADDRESS,
            FIRST_NAME,
            MIDDLE_NAME,
            LAST_NAME,
            PHONE_NUMBER,
            HOME_NUMBER,
            DISTRICT,
            STATE,
            DESCRIPTION
        FROM
            MANAGERS
        LIMIT ?
        OFFSET ?'
    ;

    $msql_dtbs = GetDatabaseInstance();
    $stmt = $msql_dtbs->prepare($sql_query);

    if ($stmt === false) {
        error_log("Database query preparation failed: " . $msql_dtbs->error);
        return false;
    }

    $stmt->bind_param('ii', $limit, $offset);
    $stmt->execute();
    $result = $stmt->get_result();
    $managers = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    $new_managers = [];
    foreach ($managers as $manager) {
        $new_manager = array_change_key_case($manager, CASE_LOWER);
        $new_managers[] = $new_manager;
    }
    $msql_dtbs->close();
    return $new_managers;
}

function GetBooksBy(
    array $filters,
    int $limit = 10,
    int $offset = 0
): ?array {
    $msql_dtbs = GetDatabaseInstance();

    if (empty($filters)) {
        $stmt = $msql_dtbs->prepare('SELECT * FROM BOOKS LIMIT ? OFFSET ?');

        if ($stmt === false) {
            error_log("Database query preparation failed: " . $msql_dtbs->error);
            return null;
        }

        $stmt->bind_param('ii', $limit, $offset);
        $stmt->execute();
        $result = $stmt->get_result();
        $books = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $books;
    }

    $where_clauses = [];
    $params = [];
    $types = '';

    foreach ($filters as $by => $value) {
        $by = strtoupper($by); // Convert filter name to uppercase for database columns
        switch ($by) {
            case 'PUBLISHING_YEAR':
            case 'REVIEW_SCORE':
                if (is_numeric($value)) {
                    $where_clauses[] = "$by = ?";
                    $params[] = (int)$value;
                    $types .= "i";
                } else {
                    return null; // Invalid filter value, return null to indicate error
                }
                break;
            case 'GENRE':
            case 'LANGUAGE':
                $where_clauses[] = "$by = ?";
                $params[] = $value;
                $types .= "s";
                break;
            default:
                return null; // Invalid filter name, return null to indicate error.
        }
    }

    $where_clause = "WHERE " . implode(" AND ", $where_clauses);
    $query = "SELECT * FROM books " . $where_clause . " LIMIT ? OFFSET ?";
    $stmt = $msql_dtbs->prepare($query);

    if ($stmt === false) {
        error_log("Database query preparation failed: " . $msql_dtbs->error);
        return null;
    }

    $params[] = $limit;
    $params[] = $offset;
    $types .= 'ii';
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    $result = $stmt->get_result();
    $books = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    $new_books = [];
    foreach ($books as $book) {
        $new_book= array_change_key_case($book, CASE_LOWER);
        $new_books[] = $new_book;
    }
    $msql_dtbs->close();
    return $new_books;
}

function GetBooksByGenre(
    array $genres,
    int $limit = 10,
    int $offset = 0
): ?array {
    $msql_dtbs = GetDatabaseInstance();

    if (empty($genres)) {
        $stmt = $msql_dtbs->prepare("SELECT * FROM BOOKS LIMIT ? OFFSET ?");
        if ($stmt === false) {
            error_log("Database query preparation failed: " . $msql_dtbs->error);
            return null;
        }
        $stmt->bind_param("ii", $limit, $offset);
        $stmt->execute();
        $result = $stmt->get_result();
        $books = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $books;
    }

    $placeholders = implode(',', array_fill(0, count($genres), '?'));
    $query = "SELECT * FROM BOOKS WHERE GENRE IN ($placeholders) LIMIT ? OFFSET ?";
    $stmt = $msql_dtbs->prepare($query);

    if ($stmt === false) {
        error_log("Database query preparation failed: " . $msql_dtbs->error);
        return null;
    }

    $types = str_repeat('s', count($genres)) . 'ii';
    $params = array_merge($genres, [$limit, $offset]);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    $result = $stmt->get_result();
    $books = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    $new_books = [];
    foreach ($books as $book) {
        $new_book= array_change_key_case($book, CASE_LOWER);
        $new_books[] = $new_book;
    }
    $msql_dtbs->close();
    return $new_books;
}

function GetBookDetail(int $book_id): ?array {
    $msql_dtbs = GetDatabaseInstance();
    $stmt = $msql_dtbs->prepare('SELECT * FROM BOOKS WHERE ID = ?');

    if ($stmt === false) {
        error_log("Database query preparation failed: " . $msql_dtbs->error);
        return null;
    }

    $stmt->bind_param('i', $book_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $book_data = $result->fetch_assoc();
    $stmt->close();
    $msql_dtbs->close();
    return $book_data;
}

?>
