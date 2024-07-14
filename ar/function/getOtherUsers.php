<?php
require 'connect.php';
$user_id = $_SESSION['user']['user_id'];
$query = "SELECT * FROM `chat_user_table` Where `user_id` != '$user_id'";
$stm = $conn->prepare($query);
$stm->execute();
$data = $stm->fetchAll(PDO::FETCH_ASSOC);
print_r(json_encode($data));
