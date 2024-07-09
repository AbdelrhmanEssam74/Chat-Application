<?php
require '../init.php';
require "../" . $database . 'chat_user.php';
require "../" . $vender . 'autoload.php';
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $response  = array();
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $user_object = new ChatUser;
  $user_object->setUserId();
  $user_object->setUserName($_POST['username']);
  $user_object->setUserEmail($_POST['email']);
  $user_object->setUserPassword($_POST['password']);
  // $user_object->setUserProfile($user_object->make_avatar(strtoupper($_POST['username'][0])));
  $user_object->setUserStatus('Disabled');
  $user_object->setUserCreatedOn(date('Y-m-d h:i:s'));
  $user_object->setUserVerificationCode(md5(uniqid()));
  $user_data = $user_object->get_user_data_by_email();
  if (is_array($user_data) && count($user_data) > 0) {
    $response = array('response_type' => 'warning', 'warning' => false, 'message' => 'This Email Already Register');
  } else {
    if ($user_object->save_data()) {
      $mail = new PHPMailer(true);
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username   = 'abdelrhmanroshdy8@gmail.com';                     // SMTP username
      $mail->Password   = 'bntctrueuvhahzvc';
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
      $mail->Port = 587;
      $mail->setFrom('abdelrhmanroshdy8@gmail.com', 'Chat Application');
      $mail->addAddress($user_object->getUserEmail());
      $mail->CharSet = 'UTF-8'; // Set the character encoding to UTF-8
      $mail->setLanguage('ar', 'path/to/PHPMailer/language/'); // Set the language to Arabic
      $mail->isHTML(true);
      $mail->Subject = 'Registration Verification for Chat Application Demo';
      $mail->Body = '
            <p>Thank you for registering for Chat Application Demo.</p>
                <p>This is a verification email, please click the link to verify your email address.</p>
                <p><a href="http://localhost:3000/verify.php?code=' . $user_object->getUserVerificationCode() . '">Click to Verify</a></p>
                <p>Thank you...</p>
            ';
      $mail->send();
      $sending_mail_message = 'Verification Email sent to ' . $user_object->getUserEmail() . ', so before login first verify your email';
      $response = array('response_type' => 'success', 'success' => true, 'message' => "Successful Registration", 'sending_mail_message' => $sending_mail_message, 'sendMail' => true);
      // set session values
      $_SESSION['email'] = $user_object->getUserEmail();
    } else {
      $response = array('response_type' => 'error', 'error' => false, 'message' => 'Failed Registration Try Again!');
    }
  }

  // Return response
  echo json_encode($response);
}
