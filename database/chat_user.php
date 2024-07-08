<?php
//NOTE - Chat User
require 'database_connection.php';
class chat_user extends database_connection
{
  private $user_id;
  private $username;
  private $user_email;
  private $user_password;
  private $user_profile;
  private $user_status;
  private $user_created_on;
  private $user_verification_code;
  private $user_login_status;
  private $connect;
  public function __construct()
  {
    $database_obj = new database_connection;
    $this->connect = $database_obj->connect();
  }
}
