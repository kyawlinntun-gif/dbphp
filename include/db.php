<?php

$dsn = 'mysql:host=localhost;dbname=db_php';
$username = 'root';
$password = '';

$connectDb = new PDO($dsn, $username, $password);

// try {
//     $connectDb = new PDO($dsn, $username, $password);
//     echo "<p>Succeed!</p>";
// } catch (PDOException $e) {
//     echo "<p>Failed : " . $e->getMessage()."</p>";
//     exit();
// }
