<?php
require 'connect.php';
$user_id = $_POST['user_id'];
$query = "SELECT `user_login_status` FROM `chat_user_table` Where `user_id` = '$user_id'";
$stm = $conn->prepare($query);
$stm->execute();
$data = $stm->fetchColumn();
echo $data;
