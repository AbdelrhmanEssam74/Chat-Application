<?php include 'init.php';
$page = 'login';  
$success_message = isset($_SESSION['success_message']) ? $_SESSION['success_message'] : '';
?>
<?php include $templates . 'header.php' ?>


  <div class="container">
    <div class="notifications"></div>
    <div class="form">
      <form id="login-form" action="<?php echo $authentication ?>login.php" method="post">
        <?php
        if (!empty($success_message)) {
        ?>
          <div class="alert alert-primary" role="alert">
            <p class="mb-0">
              <?php
              echo $success_message;
              ?>
            </p>
          </div>
        <?php
        }
        ?>
        <h3>Chat Application</h3>
        <h4>Sign In</h4>
        <fieldset>
          <input placeholder="Your Email Address" type="email" value="<?php
                                                                      if (isset($_SESSION['email'])) {
                                                                        echo $_SESSION['email'];
                                                                      }
                                                                      ?>" name="email" id="email">
        </fieldset>
        <fieldset>
          <input placeholder="Your Password" type="password" name="password" id="password">
          <i class="fas fa-eye show-password"></i>
        </fieldset>
        <fieldset>
          <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Sign In</button>
        </fieldset>
        <p class="copyright">Create New Account ? <a href="register.php">Register</a></p>
      </form>
    </div>
  </div>


  <?php include $templates . 'footer.php' ?>