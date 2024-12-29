<?php

declare(strict_types=1);
require_once __DIR__ . '/../../vendor/autoload.php';

$file_path = 'C:\Users\pc\codes\web_development\online_book_store\docs';
$dotenv = Dotenv\Dotenv::createImmutable($file_path);
$dotenv->load();

function GetDatabaseInstance(): mysqli {
    return new mysqli($_ENV['DOMAIN'], $_ENV['USERNAME'], $_ENV['PASSWORD'], $_ENV['DATABASE_NAME']);
}

?>
