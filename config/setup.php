<?php

//CREATE DATABASE
function create_db(){
include ('database.php');
    try {
        $pdo = new PDO("mysql:host=$host;charset=$charset", $DB_USER, $DB_PASSWORD, $options);
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
    try {
        $sql = "CREATE DATABASE IF NOT EXISTS `$db`";
        $pdo->exec($sql);
        print("Created db.\n");
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $pdo = null;
}

//CREATE TABLE USER
function table_user(){
include ('connection.php');
    try {
        $sql = "CREATE TABLE IF NOT EXISTS `users` (
            `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `login` VARCHAR(50) NOT NULL,
            `password` VARCHAR(255) NOT NULL,
            `mail` VARCHAR(100) NOT NULL,
            `notif` VARCHAR(1) NOT NULL DEFAULT 'Y',
            `hash` VARCHAR(32) NOT NULL,
            `verified` VARCHAR(1) NOT NULL DEFAULT 'N'
          )";
        $pdo->exec($sql);
        print("Created user Table.\n");
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $pdo = null;
}
//CREATE TABLE comments
function table_comments(){
    include('connection.php');
    try {
        $sql = "CREATE TABLE IF NOT EXISTS `comments` (
            `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `id_photo` INT NOT NULL,
            `comments` VARCHAR(4000) NOT NULL,
            `login` VARCHAR(50) NOT NULL
          )";
        $pdo->exec($sql);
        print("Created `comments` Table.\n");
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $pdo = null;
}

function table_likes(){
    include('connection.php');
    try {
        $sql = "CREATE TABLE IF NOT EXISTS `likes` (
            `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `id_photo` INT NOT NULL,
            `login` VARCHAR(250) NOT NULL,
            `like` BIT NOT NULL
          )";
        $pdo->exec($sql);
        print("Created `like` Table.\n");
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $pdo = null;
}

function table_photos(){
    include('connection.php');
    try {
        $sql = "CREATE TABLE IF NOT EXISTS `photos` (
            `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `photo` VARCHAR(250) NOT NULL,
            `login` VARCHAR(250) NOT NULL,
            `date` DATE NOT NULL,
            `like` INT NOT NULL DEFAULT 0
          )";
        $pdo->exec($sql);
        print("Created `photos` Table.\n");
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $pdo = null;
}

function table_reset_pw()
{
    include('connection.php');
    try {
        $sql = "CREATE TABLE IF NOT EXISTS `password_reset` (
            `mail` varchar(250) NOT NULL,
            `key` varchar(250) NOT NULL,
            `expDate` datetime NOT NULL
          )";
        $pdo->exec($sql);
        print("Created `password_reset` Table.\n");
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $pdo = null;
}

function fill_photos()
{
    include('connection.php');
    date_default_timezone_set(UTC);
    try {
        $sql = "INSERT INTO `photos` 
                (`photo`, `login`, `date`)
                VALUES
                ('photo_test/1.jpg', 'admin', NOW()),
                ('photo_test/2.jpg', 'admin', NOW()),
                ('photo_test/3.jpg', 'admin', NOW()),
                ('photo_test/4.jpg', 'admin', NOW()),
                ('photo_test/5.jpg', 'admin', NOW()),
                ('photo_test/6.jpg', 'admin', NOW()),
                ('photo_test/7.jpg', 'admin', NOW()),
                ('photo_test/8.jpg', 'admin', NOW()),
                ('photo_test/9.png', 'admin', NOW())";
        $pdo->exec($sql);
        print("Filled photos Table.\n");
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $pdo = null;
}

function fill_users()
{
    include('connection.php');
    try {
        $sql = "INSERT INTO `users` 
                (`login`, `password`, `mail`, `hash`, `verified`)
                VALUES
                ('admin', PASSWORD('admin123'), 'jdesclercs@gmail.com', '0', 'Y')";
        $pdo->exec($sql);
        print("Filled users Table.\n");
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $pdo = null;
}

create_db();
table_user();
table_comments();
table_likes();
table_photos();
table_reset_pw();
fill_photos();
fill_users();
?>