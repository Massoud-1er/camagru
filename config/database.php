<?php
$db   = 'db_camagru';
$host = '127.0.0.1:3306';
$charset = 'utf8mb4';
$DB_DSN = "mysql:host=$host;dbname=$db;charset=$charset";
$DB_USER = 'root';
$DB_PASSWORD = 'rootme';
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
?>