<?php include 'init.php';
session_start();
$success_message = isset($_SESSION['success_message']) ? $_SESSION['success_message'] : '';
?>
<?php include $templates . 'header.php' ?>

<body>
  <div class="container">
    <div class="form">
      <form id="login-form" action="" method="post">
        <div class="alert alert-primary" role="alert">
          <p class="mb-0">
            <?php
            if (isset($success_message)) {
              echo $success_message;
            }
            ?>
          </p>
        </div>

        <h3>Chat Application</h3>
        <h4>Sign In</h4>
        <fieldset>
          <input placeholder="Your Email Address" type="email" value="<?php
                                                                      if (isset($_SESSION['email'])) {
                                                                        echo $_SESSION['email'];
                                                                      }
                                                                      ?>" name="email" tabindex="2" required>
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