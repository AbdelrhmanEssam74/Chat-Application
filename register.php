<?php include 'init.php';
$page = 'register';
?>
<?php include $templates . 'header.php' ?>
  <div class="container">
    <div class="notifications"></div>
    <div class="form">
      <form id="register-form" action="<?php echo $authentication ?>register.php" method="post">
        <h3>Chat Application</h3>
        <h4>Create Now Account</h4>
        <fieldset>
          <input placeholder="Your name" type="text" name="username" id="username">
        </fieldset>
        <fieldset>
          <input placeholder="Your Email Address" type="email" name="email" id="email">
        </fieldset>
        <fieldset>
          <input placeholder="Your Password" type="password" name="password" id="password">
          <i class="fas fa-eye show-password"></i>
          <div id="password-rules" class="password-rules">
            <ul>
              <li id="rule-length">Password must contain at least 8 characters</li>
              <li id="rule-lowercase">Password must contain at least one lowercase letter</li>
              <li id="rule-uppercase">Password must contain at least one uppercase letter</li>
              <li id="rule-number">Password must contain at least one number</li>
            </ul>
          </div>
        </fieldset>
        <fieldset>
          <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Submit</button>
        </fieldset>
        <p class="copyright">Have an account ? <a href="index.php">Login</a></p>
      </form>
    </div>
  </div>
  <?php include $templates . 'footer.php' ?>