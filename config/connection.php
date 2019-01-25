<?php
    include('database.php');
    try {
        $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, $options);
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
?>