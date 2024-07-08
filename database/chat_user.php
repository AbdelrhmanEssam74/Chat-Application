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

  public function setUserId()
  {
    $this->userId = uniqid();
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
    $this->userPassword = password_hash($userPassword, PASSWORD_DEFAULT);
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
  // method to make a specific avatar for the user
  // function make_avatar($character)
  // {
  //   $path = "images/" . time() . ".png";
  //   $image = imagecreate(200, 200);
  //   $red = rand(0, 255);
  //   $green = rand(0, 255);
  //   $blue = rand(0, 255);
  //   imagecolorallocate($image, $red, $green, $blue);
  //   $textcolor = imagecolorallocate($image, 255, 255, 255);

  //   $font = dirname(__FILE__) . '/font/arial.ttf';

  //   imagettftext($image, 100, 0, 55, 150, $textcolor, $font, $character);
  //   imagepng($image, $path);
  //   imagedestroy($image);
  //   return $path;
  // }
  function get_user_data_by_email()
  {
    $query = "
		SELECT * FROM chat_user_table 
		WHERE user_email = :user_email
		";

    $statement = $this->connect->prepare($query);

    $statement->bindParam(':user_email', $this->userEmail);

    if ($statement->execute()) {
      $user_data = $statement->fetch(PDO::FETCH_ASSOC);
    }
    return $user_data;
  }
  function save_data()
  {
    $query = "
		INSERT INTO chat_user_table (user_id , username, user_email, user_password, user_profile, user_status, user_created_on, user_verification_code) 
		VALUES ( :id , :user_name, :user_email, :user_password, :user_profile, :user_status, :user_created_on, :user_verification_code)
		";
    $statement = $this->connect->prepare($query);

    $statement->bindParam(':id', $this->userId);
    $statement->bindParam(':user_name', $this->username);
    $statement->bindParam(':user_email', $this->userEmail);
    $statement->bindParam(':user_password', $this->userPassword);
    $statement->bindParam(':user_profile', $this->userProfile);
    $statement->bindParam(':user_status', $this->userStatus);
    $statement->bindParam(':user_created_on', $this->userCreatedOn);
    $statement->bindParam(':user_verification_code', $this->userVerificationCode);
    return $statement->execute();
  }
}
