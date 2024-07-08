<?php include 'init.php' ?>
<?php include $templates . 'header.php' ?>

<body>
  <div class="container">
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
        </fieldset>
        <fieldset>
          <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Submit</button>
        </fieldset>
        <p class="copyright">Have an account ? <a href="index.php">Login</a></p>
      </form>
    </div>
  </div>
</body>

<?php include $templates . 'footer.php' ?>