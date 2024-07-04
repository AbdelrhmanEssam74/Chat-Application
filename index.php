<?php include 'include/header.php' ?>

<body>
  <div class="container">
    <div class="row">
      <div class="col-mid-push-2 col-mid-8">
        <h2>Chat Application</h2>
        <h3>Messages</h3>
        <ul class="message-list">

        </ul>
        <form action="">
          <div class="form-group">
            <label for="message">Message</label>
            <textarea type="button" name="message" class="form-control" id="message_input"></textarea>
          </div>
          <div>
            <button type="submit" name="button" class="btn btn-primary mt-2">Send</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

<?php include 'include/footer.php' ?>