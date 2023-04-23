<?php
session_start();

// connect database with pdo
$dsn = "mysql:host=localhost;dbname=blog;charset=utf8";
$db = new PDO($dsn, "user1", "kljoydn2SzK5XYFbnD");

?>
