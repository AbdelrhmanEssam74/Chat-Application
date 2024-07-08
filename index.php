<?php include 'init.php' ?>
<?php include $templates . 'header.php' ?>

<body>
  <div class="container">
    <div class="form">
      <form id="login-form" action="" method="post">
        <h3>Chat Application</h3>
        <h4>Sign In</h4>
        <fieldset>
          <input placeholder="Your Email Address" type="email" name="email" tabindex="2" required>
        </fieldset>
        <fieldset>
          <input placeholder="Your Password" type="password" name="password" id="">
        </fieldset>
        <fieldset>
          <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Sign In</button>
        </fieldset>
        <p class="copyright">Create New Account ? <a href="register.php">Register</a></p>
      </form>
    </div>
  </div>


  <?php include $templates . 'footer.php' ?>