<?php include 'include/header.php' ?>

<body>
  <div class="container">
    <div class="row">
      <div class="col-lg-6  col-mid-12">
        <h2>Chat Application</h2>
        <div class="row">
          <h5>message for:
            <span class="username bg-primary p-1 text-white rounded-2"></span>
          </h5>
          <form action="" class="username-setter" method="post">
            <div class="form-group">
              <label for="">Set Username</label>
              <input type="text" name="name" value="" class="form-control username-input">
            </div>
            <button class="btn btn-primary mt-2" type="submit">Set</button>
          </form>
        </div>
        <h3>Messages</h3>
        <ul class="message_list">
        </ul>
        <form action="" id="message_form">
          <div class="form-group">
            <label for="message">Message</label>
            <textarea type="button" name="message" class="form-control" id="message_input"></textarea>
          </div>
          <div>
            <button type="submit" name="button" class="btn btn-primary mt-2"> <i class="fa-solid fa-paper-plane"></i></button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

<?php include 'include/footer.php' ?>