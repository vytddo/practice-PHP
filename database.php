<?php
    $dsn = 'mysql:host=localhost;dbname=Lab3';
    $username = 'jdoe';
    $password = 'dc123';

    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('database_error.php');
        exit();
    }
?>