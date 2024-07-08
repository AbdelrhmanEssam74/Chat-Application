<?php

require 'database_connection.php';

class ChatUser extends database_connection
{
  private $userId;
  private $username;
  private $userEmail;
  private $userPassword;
  private $userProfile;
  private $userStatus;
  private $userCreatedOn;
  private $userVerificationCode;
  private $userLoginStatus;
  private $connect;

  public function __construct()
  {
    $database_obj = new database_connection;
    $this->connect = $database_obj->connect();
  }

  public function setUserId($userId)
  {
    $this->userId = $userId;
  }

  public function getUserId()
  {
    return $this->userId;
  }

  public function setUsername($username)
  {
    $this->username = $username;
  }

  public function getUsername()
  {
    return $this->username;
  }

  public function setUserEmail($userEmail)
  {
    $this->userEmail = $userEmail;
  }

  public function getUserEmail()
  {
    return $this->userEmail;
  }

  public function setUserPassword($userPassword)
  {
    $this->userPassword = $userPassword;
  }

  public function getUserPassword()
  {
    return $this->userPassword;
  }

  public function setUserProfile($userProfile)
  {
    $this->userProfile = $userProfile;
  }

  public function getUserProfile()
  {
    return $this->userProfile;
  }

  public function setUserStatus($userStatus)
  {
    $this->userStatus = $userStatus;
  }

  public function getUserStatus()
  {
    return $this->userStatus;
  }

  public function setUserCreatedOn($userCreatedOn)
  {
    $this->userCreatedOn = $userCreatedOn;
  }

  public function getUserCreatedOn()
  {
    return $this->userCreatedOn;
  }

  public function setUserVerificationCode($userVerificationCode)
  {
    $this->userVerificationCode = $userVerificationCode;
  }

  public function getUserVerificationCode()
  {
    return $this->userVerificationCode;
  }

  public function setUserLoginStatus($userLoginStatus)
  {
    $this->userLoginStatus = $userLoginStatus;
  }

  public function getUserLoginStatus()
  {
    return $this->userLoginStatus;
  }
}
