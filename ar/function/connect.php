<?php
session_start();
$dsn = "mysql:host=localhost;dbname=chat_app";
$user = "Admin1";
$pass = "a123";

$option = array(
  PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
);
try {
  $conn = new PDO($dsn, $user, $pass, $option);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
}
