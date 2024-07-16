<nav>
    <input type="checkbox" id="check">
    <label for="check" class="checkbtn">
        <i class="fas fa-bars"></i>
    </label>
    <label class="logo">Chat App</label>
    <ul>
        <li><a  href="<?php echo $ChatRoom ?>">Home</a></li>
        <!-- <li><a href="#">About</a></li>
      <li><a href="#">Services</a></li>
      <li><a href="#">Contact</a></li>-->
        <li><a id="profile" href="<?php echo $profile ?>">Profile</a></li>
        <li><a id="logout" href="<?php echo $authentication ?>logout.php">Logout</a></li>
    </ul>
</nav>
<div id="loadingIcon" style="display: none;">
    <div class="loader"></div>
</div>