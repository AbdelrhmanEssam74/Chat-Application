<?php include 'init.php';
$page = 'chatRoom';
?>
<?php include $templates . 'header.php' ?>
<div class="container">
  <div class="notifications"></div>
  <div class="chatWindow">
    <div class="right">
      <div class="userInfo">
        <div class="img">
          <img src="<?php echo $img ?>profile.png" alt="">
        </div>
        <div class="info">
          <h3>John Doe</h3>
        </div>
      </div>
      <div class="users">
        <div class="usersHeader">
          <p>Users List</p>
        </div>
        <div class="usersBody">
          <ul>
            <li data-user="John Doe" data-uid="11613516465" data-status="offline" class="user-item">
              <div class="contact-data">
                <p class="user_name">John Doe</p>
                <img src="<?php echo $img ?>profile.png" alt="">
              </div>
              <div class="status">
                <i class="fas fa-circle offline-dot"></i>
              </div>
            </li>
            <li data-user="Radwa" data-uid="11613516465" data-status="online" class="user-item">
              <div class="contact-data">
                <p class="user_name">Radwa</p>
                <img src="<?php echo $img ?>profile.png" alt="">
              </div>
              <div class="status">
                <i class="fas fa-circle online-dot"></i>
              </div>
            </li>
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