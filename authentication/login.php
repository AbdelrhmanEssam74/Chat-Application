<?php
global $database, $vendor;
require '../init.php';
require "../" . $database . 'chat_user.php';
require "../" . $vendor . 'autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $response  = array();

  // Get email and password from the POST data
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Create a new instance of the ChatUser class
  $user_object = new ChatUser;

  // Set the user's email
  $user_object->setUserEmail($email);

  // Get user data by email
  $user_data = $user_object->get_user_data_by_email();
  // print_r($user_data);

  if (is_array($user_data) && count($user_data) > 0) {
    // Check if the user's status is "Enable"
    if ($user_data['user_status'] != "Enable") {
      $response = array(
        'response_type' => 'warning',
        'warning' => true,
        'message' => 'Please Verify Your Email.'
      );
    } else {
      // Verify the password
      if (!password_verify($password, $user_data['user_password'])) {
        $response = array(
          'response_type' => 'error',
          'error' => true,
          'message' => 'Your Password Is Wrong!'
        );
      } else {
        // Update user login data and set session variables
        $user_object->setUserId($user_data['user_id']);
        $user_object->setUserLoginStatus("Login");
        if ($user_object->update_user_login_data()) {
          // Set session variables
          $_SESSION['user'] = array(
            'user_id' => $user_data['user_id'],
            'user_name' => $user_data['username'],
            'user_email' => $user_data['user_email'],
            'user_status' => $user_data['user_status'],
            'profile'  => $user_data['user_profile'],
            'login' => true
          );
          // Set Cookies Variables
          setcookie('UID', password_hash($user_data['user_id'], PASSWORD_DEFAULT), strtotime("+1 year"), '/');
          setcookie('UL', true, strtotime("+1 year"), '/');
          $response = array(
            'response_type' => 'success',
            'success' => true,
            'message' => 'Login Successfully!',
            'URL'     => 'Chat Room.php'
          );
        }
      }
    }
  } else {
    $response = array(
      'response_type' => 'error',
      'error' => true,
      'message' => 'Your Email Not Found!'
    );
  }

  // Return response as JSON
  echo json_encode($response);
}
