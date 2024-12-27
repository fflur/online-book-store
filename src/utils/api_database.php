<?php

declare(strict_types=1);
require_once __DIR__ . '/../../vendor/autoload.php';

$file_path = 'C:\Users\pc\codes\web_development\online_book_store\docs';
$dotenv = Dotenv\Dotenv::createImmutable($file_path);
$dotenv->load();
$dtbs_name = $_ENV['DATABASE_NAME'];
$user_name = $_ENV['USERNAME'];
$domn = $_ENV['DOMAIN'];
$pswd = $_ENV['PASSWORD'];
$msql_dtbs = new mysqli($domn, $user_name, $pswd, $dtbs_name);

?>
