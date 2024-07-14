<?php global $templates, $img;
include 'init.php';
$page = 'chatRoom';
require $database . 'chat_user.php';
// Create a new instance of the ChatUser class
$user_object = new ChatUser;
$profile_img_path = str_replace("../", "", $_SESSION['user']["profile"]); // ar/images/img_name_with_userid.png
$Name = $_SESSION['user']["user_name"];
$user_id = $_SESSION['user']["user_id"];

?>
<?php include $templates . 'header.php' ?>
<div class="container">
  <div class="notifications"></div>
  <div class="chatWindow">
    <div class="right">
      <div class="userInfo">
        <div class="img">
          <img src="<?php echo $profile_img_path ?>" alt="">
        </div>
        <div class="info">
          <h3><?php echo  $Name ?></h3>

        </div>
      </div>
      <div class="users">
        <div class="usersHeader">
          <p>Users List</p>
        </div>
        <div class="usersBody">
          <ul>
            <?php
            $user_data = $user_object->get_user_all_data();
            foreach ($user_data as $user) :
              if ($user['user_id'] !== $user_id) :
                $user_img = str_replace("../", "", $user['user_profile']);
            ?>
                <li data-user="<?php echo $user['username'] ?>" data-uid="<?php echo $user['user_id'] ?>" data-status="<?php echo $user['user_login_status'] ?>" class="user-item">
                  <div class="contact-data">
                    <p class="user_name"><?php echo $user['username'] ?></p>
                    <img src="<?php echo $user_img ?>" alt="">
                  </div>
                  <div class="status">
                    <?php
                    if ($user['user_login_status'] == "Login") :
                      echo '<i class="fas fa-circle online-dot"></i>';
                    elseif ($user['user_login_status'] == "Disable") :
                      echo '<i class="fas fa-circle offline-dot"></i>';
                    endif;
                    ?>
                  </div>
                </li>
            <?php
              endif;
            endforeach;
            ?>
          </ul>
        </div>
      </div>
    </div>
    <div class="left">
      <div class="chatRoom">
        <div class="chatBox">
          <div class="chatHeader">
            <h4>Chat Room :</h4>
            <p>No Status</p>
          </div>
          <div class="chatBody">
          </div>
          <div class="chatFooter">
            <form action="" method="post" id="message-form">
              <input type="text" name="msg" placeholder="Type a message...">
              <button type="submit" name="send"><i class="fas fa-paper-plane"></i></button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include $templates . 'footer.php' ?>