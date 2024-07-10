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
            <li class="user-item">
              <div class="contact-data">
                <p class="user_name">John Doe</p>
                <img src="<?php echo $img ?>profile.png" alt="">
              </div>
              <div class="status">
                <i class="fas fa-circle offline-dot"></i>
              </div>
            </li>
            <li class="user-item">
              <div class="contact-data">
                <p class="user_name">John Doe</p>
                <img src="<?php echo $img ?>profile.png" alt="">
              </div>
              <div class="status">
                <i class="fas fa-circle online-dot"></i>
              </div>
            </li>
            <li class="user-item">
              <div class="contact-data">
                <p class="user_name">John Doe</p>
                <img src="<?php echo $img ?>profile.png" alt="">
              </div>
              <div class="status">
                <i class="fas fa-circle offline-dot"></i>
              </div>
            </li>
            <li class="user-item">
              <div class="contact-data">
                <p class="user_name">John Doe</p>
                <img src="<?php echo $img ?>profile.png" alt="">
              </div>
              <div class="status">
                <i class="fas fa-circle online-dot"></i>
              </div>
            </li>
            <li class="user-item">
              <div class="contact-data">
                <p class="user_name">John Doe</p>
                <img src="<?php echo $img ?>profile.png" alt="">
              </div>
              <div class="status">
                <i class="fas fa-circle offline-dot"></i>
              </div>
            </li>
            <li class="user-item">
              <div class="contact-data">
                <p class="user_name">John Doe</p>
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
            <h4>Chat Room : John Doe</h4>
            <p>Active Now</p>
          </div>
          <div class="chatBody">
            <div>
              <ul>
                <li class="msg-from">
                  <p class="msg-content">Me: <span>Lorem ipsum dolor sit amet.</span></p>
                  <p class="msg-date">2024-10-7 07:00</p>
                </li>
                <li class="msg-to">
                  <p class="msg-content">John Doe: <span>Lorem ipsum dolor sit amet.</span></p>
                  <p class="msg-date">2024-10-7 07:05</p>
                </li>
                <li class="msg-from">
                  <p class="msg-content">Me: <span>Lorem ipsum dolor sit amet.</span></p>
                  <p class="msg-date">2024-10-7 07:00</p>
                </li>
                <li class="msg-to">
                  <p class="msg-content">John Doe: <span>Lorem ipsum dolor sit amet.</span></p>
                  <p class="msg-date">2024-10-7 07:05</p>
                </li>
                <li class="msg-from">
                  <p class="msg-content">Me: <span>Lorem ipsum dolor sit amet.</span></p>
                  <p class="msg-date">2024-10-7 07:00</p>
                </li>
                <li class="msg-to">
                  <p class="msg-content">John Doe: <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum accusantium voluptatem possimus alias impedit cumque debitis natus laudantium velit aperiam?</span></p>
                  <p class="msg-date">2024-10-7 07:05</p>
                </li>
                <li class="msg-from">
                  <p class="msg-content">Me: <span>Lorem ipsum dolor sit amet.</span></p>
                  <p class="msg-date">2024-10-7 07:00</p>
                </li>
                <li class="msg-to">
                  <p class="msg-content">John Doe: <span>Lorem ipsum dolor sit amet.</span></p>
                  <p class="msg-date">2024-10-7 07:05</p>
                </li>
              </ul>
            </div>
          </div>
          <div class="chatFooter">
            <form action="" method="post">
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