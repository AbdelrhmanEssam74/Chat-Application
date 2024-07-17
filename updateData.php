<?php
global $database, $vendor;
require 'init.php';
require $database . 'chat_user.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST'):
    $response = array();
    $user_object = new ChatUser();
    $user_id = $_SESSION['user']['user_id'];
    $username = $_POST['inputUsername'];
    $email = $_POST['inputEmailAddress'];
    $result = $user_object->update_user_data(
        $user_id, $username, $email);
    if ($result):
        $_SESSION['user']['user_name'] = $username;
        $_SESSION['user']['user_email'] = $email;
        $response = array(
            'response_type' => 'success',
            'success' => true,
            'message' => 'Data Updated Successfully',
        );
    elseif ($result === 0 && $_SESSION['user']['user_name'] !== $username):
        $response = array(
            'response_type' => 'error',
            'error' => true,
            'message' => 'Something went wrong, Please try again later '
        );
    endif;
    // Return response as JSON
    echo json_encode($response);
endif;