<?php

declare(strict_types = 1);
require_once __DIR__ . '/../entities/Book.php';
require_once __DIR__ . '/BookType.php';

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

?>
