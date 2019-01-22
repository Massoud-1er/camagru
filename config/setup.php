<?php

include ('database.php');


$table = "users";

//CREATE DATABASE
try {
    $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
    $pdo->query("CREATE DATABASE IF NOT EXISTS `$db`");

//CREATE TABLE USER
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=$charset", $DB_USER, $DB_PASSWORD, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
    try {
        $sql = "CREATE TABLE `users` (
            `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `username` VARCHAR(50) NOT NULL,
            `mail` VARCHAR(100) NOT NULL,
            `password` VARCHAR(255) NOT NULL,
            `verified` VARCHAR(1) NOT NULL DEFAULT 'N'
          )";
        $pdo->exec($sql);
        print("Created $table Table.\n");
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
   $pdo = null;
