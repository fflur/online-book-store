<?php

declare(strict_types = 1);
require_once __DIR__ . '/../entities/Book.php';
require_once __DIR__ . '/BookType.php';

function GetAllBooks(
    mysqli $msql_dtbs,
    int $limit = 10,
    int $offset = 0
): void {
    if ($limit < 0 || $offset < 0) {
        http_response_code(400);
        echo json_encode(['error' => 'Limit and offset must be non-negative.']);
        return;
    }

    $query = "SELECT * FROM BOOKS LIMIT ? OFFSET ?";
    $stmt = $msql_dtbs->prepare($query);

    if ($stmt === false) {
        http_response_code(500);
        echo json_encode([
            'error' => 'Database query preparation failed: ' .
            $msql_dtbs->error
        ]);
        return;
    }

    $stmt->bind_param("ii", $limit, $offset);

    if (!$stmt->execute()) {
        http_response_code(500);
        echo json_encode([
            'error' => 'Database query execution failed: ' . $stmt->error
        ]);
        $stmt->close();
        return;
    }

    $rslt = $stmt->get_result();
    $books = $rslt->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    echo json_encode($books);
}

function GetBooksById(mysqli $msql_dtbs, int $idfr): void {
    $query = "SELECT * FROM books WHERE id = ?";
    $stmt = $msql_dtbs->prepare($query);

    if ($stmt === false) {
        http_response_code(500);
        echo json_encode([
            'error' => 'Database query preparation failed: ' . $msql_dtbs->error
        ]);
        return;
    }

    $stmt->bind_param("i", $idfr);

    if (!$stmt->execute()) {
        http_response_code(500);
        echo json_encode([
            'error' => 'Database query execution failed: ' . $stmt->error
        ]);
        $stmt->close();
        return;
    }

    $rslt = $stmt->get_result();
    $book = $rslt->fetch_assoc();
    $stmt->close();

    if ($book === null) {
        http_response_code(404);
        echo json_encode(['error' => 'Book not found.']);
        return;
    }

    echo json_encode($book);
}

function GetBooksByGenre(
    mysqli $msql_dtbs,
    array $genres,
    int $limit = 10,
    int $offset = 0
): void {
    if (empty($genres)) {
        http_response_code(400);
        echo json_encode(['error' => 'No genres provided.']);
        return;
    }

    if ($limit < 0 || $offset < 0) {
        http_response_code(400);
        echo json_encode(['error' => 'Limit and offset must be non-negative.']);
        return;
    }

    foreach ($genres as $genre) {
        if (!BookType::IsCategory($genre)) {
            http_response_code(400);
            echo json_encode(['error' => "Invalid genre: " . $genre]);
            return;
        }
    }

    $placeholders = implode(',', array_fill(0, count($genres), '?'));
    $query = "SELECT * FROM books WHERE genre IN ($placeholders) LIMIT ? OFFSET ?";

    $stmt = $msql_dtbs->prepare($query);

    if ($stmt === false) {
        http_response_code(500);
        echo json_encode(['error' => 'Database query preparation failed: ' . $msql_dtbs->error]);
        return;
    }

    $types = str_repeat("s", count($genres)) . "ii";

    // Create an array of references
    $bind_params = [];
    $bind_params[] = &$types; // First parameter must be the type string by reference
    foreach ($genres as &$genre) { // Bind genres by reference
        $bind_params[] = &$genre;
    }
    $bind_params[] = &$limit; // Bind limit by reference
    $bind_params[] = &$offset; // Bind offset by reference

    call_user_func_array([$stmt, 'bind_param'], $bind_params);

    if (!$stmt->execute()) {
        http_response_code(500);
        echo json_encode(['error' => 'Database query execution failed: ' . $stmt->error]);
        $stmt->close();
        return;
    }

    $result = $stmt->get_result();
    $books = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    echo json_encode($books);
}

function GetBookDetail(mysqli $msql_dtbs, int $book_id): ?array {
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

    return $book_data;
}

function GetBooksBy(
    mysqli $msql_dtbs,
    array $filters,
    int $limit = 10,
    int $offset = 0
): ?array {
    if (empty($filters)) {
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

    $where_clauses = [];
    $params = [];
    $types = "";

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
    $types .= "ii";
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    $result = $stmt->get_result();
    $books = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    return $books;
}

?>
