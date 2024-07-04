<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- bootstrap css link -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!-- font-awesome css link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Chat Application </title>
</head>

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
  <script>
    // Create a new WebSocket object and connect it to the server
    const conn = new WebSocket("ws://localhost:8080")
    // Event handler when the WebSocket connection is successfully established  
    conn.onopen = function(e) {
      console.log("Connection established !");
      // Send a message to the server
      conn.send("message send from browser client");
    }
    // Event handler when a message is received from the server
    conn.onmessage = function(e) {
      console.log("Message: " + e.data);
      let ul_list = document.querySelector(".message-list")
      let li = document.createElement("li");
      li.innerHTML = e.data;
      ul_list.appendChild(li);
    }
  </script>
</body>

<!-- jquery js link -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- bootstrap js link -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<!-- font-awesome js link -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js" integrity="sha512-GWzVrcGlo0TxTRvz9ttioyYJ+Wwk9Ck0G81D+eO63BaqHaJ3YZX9wuqjwgfcV/MrB2PhaVX9DkYVhbFpStnqpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</html>