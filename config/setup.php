<?php

include ('database.php');

//CREATE DATABASE
try {
    $pdo = new PDO("mysql:host=$host;charset=$charset", $DB_USER, $DB_PASSWORD, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
    $pdo->query("CREATE DATABASE IF NOT EXISTS `$db`");

//CREATE TABLE USER
try {
    $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
    try {
        $sql = "CREATE TABLE IF NOT EXISTS `users` (
            `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `login` VARCHAR(50) NOT NULL,
            `password` VARCHAR(255) NOT NULL,
            `mail` VARCHAR(100) NOT NULL,
            `verified` VARCHAR(1) NOT NULL DEFAULT 'N'
          )";
        $pdo->exec($sql);
        print("Created $table Table.\n");
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

//CREATE TABLE comments
try {
    $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
    try {
        $sql = "CREATE TABLE IF NOT EXISTS `comments` (
            `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `id_photo` INT NOT NULL,
            `comments` VARCHAR(250) NOT NULL,
            `login` VARCHAR(50) NOT NULL
          )";
        $pdo->exec($sql);
        print("Created `comments` Table.\n");
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    
//CREATE TABLE photos
try {
    $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
    try {
        $sql = "CREATE TABLE IF NOT EXISTS `photos` (
            `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `photo` VARBINARY(25000) NOT NULL,
            `login` VARCHAR(250) NOT NULL,
            `date` DATE NOT NULL
          )";
        $pdo->exec($sql);
        print("Created `photos` Table.\n");
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $pdo = null;
