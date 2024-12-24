<?php

declare(strict_types = 1);
require_once __DIR__ . '/../utils/BookType.php';

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

function GetBooksByFilter(mysqli $msql_dtbs, array $filters): void {
    if (empty($filters)) {
        http_response_code(400);
        echo json_encode(['error' => 'No filters provided.']);
        return;
    }

    $whre_clses = []; // Where clauses.
    $params = [];
    $types = "";

    foreach ($filters as $filter => $value) {
        if ($filter === 'category') {
            if (!BookType::IsCategory($value)) {
                http_response_code(400);
                echo json_encode(['error' => "Invalid category: " . $value]);
                return;
            }
        }
        $whre_clses[] = "$filter = ?";
        $params[] = $value;
        $types .= "s"; // Assuming all values are strings for now.
    }

    $whre_clse = implode(" AND ", $whre_clses);
    $query = "SELECT * FROM books WHERE $whre_clse";

    $stmt = $msql_dtbs->prepare($query);

    if ($stmt === false) {
        http_response_code(500);
        echo json_encode([
            'error' => 'Database query preparation failed: ' . $msql_dtbs->error
        ]);
        return;
    }

    $stmt->bind_param($types, ...$params);

    if (!$stmt->execute()) {
        http_response_code(500);
        echo json_encode([
            'error' => 'Database query execution failed: ' . $stmt->error
        ]);
        $stmt->close();
        return;
    }

    $result = $stmt->get_result();
    $books = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    echo json_encode($books);
}

?>
