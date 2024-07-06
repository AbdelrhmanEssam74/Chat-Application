<?php include 'include/header.php' ?>

<body>
  <div class="container">
    <form id="contact" action="" method="post">
      <h3>Chat Application</h3>
      <h4>Create Now Account</h4>
      <fieldset>
        <input placeholder="Your name" type="text" name="username" tabindex="1" required>
      </fieldset>
      <fieldset>
        <input placeholder="Your Email Address" type="email" name="email" tabindex="2" required>
      </fieldset>
      <fieldset>
        <input placeholder="Your Password" type="password" name="password" id="">
      </fieldset>
      <fieldset>
        <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Submit</button>
      </fieldset>
      <p class="copyright">Have an account ? <a href="index.php">Login</a></p>
    </form>
  </div>
</body>

<?php include 'include/footer.php' ?>