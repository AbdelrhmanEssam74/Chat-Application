<?php
global $database;

/**
 * Logout page
 * unset and destroy the session
 * update the user_login_status column in DB 
 */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  require '../init.php';
  require "../" . $database . 'chat_user.php';
  $email = $_SESSION['user']['user_email'];
  $user_id = $_SESSION['user']['user_id'];
  $user_object = new ChatUser;
  $user_object->setUserId($user_id);
  $user_object->setUserLoginStatus("Disable");
  if ($user_object->update_user_login_data()) {
    // Remove 'user id' cookie
    setcookie('UID', '', time() - 3600, '/');
    // Remove 'user login' cookie
    setcookie('UL', '', time() - 3600, '/');
    session_unset();
    session_destroy();
    echo 1;
  } else {
    echo 0;
  }
}
