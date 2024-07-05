$(document).ready(function () {
  // Create a new WebSocket object and connect it to the server
  const conn = new WebSocket("ws://localhost:8080");
  // Event handler when the WebSocket connection is successfully established
  // get the message from ,input field and messages list
  var form = $("#message_form"),
    messageInput = form.find("#message_input"),
    messagesList = $(".message_list");
  form.on("submit", function (e) {
    e.preventDefault();
    var message = messageInput.val();
    // Send a message to the server
    conn.send(message);
    messagesList.prepend(
      "<li class='my-message'>" + "You: " + message + "</li>"
    );
  });
  conn.onopen = function (e) {
    console.log("Connection established !");
    $.ajax({
      url: "/history_load.php",
      dataType: "json",
      success: function (data) {
        console.log(data);
        $.each(data, function () {
          var li = $("<li>").addClass("other-message").text(this.text);
          messagesList.append(li)
        });
      },
    });
  };
  // Event handler when a message is received from the server
  conn.onmessage = function (e) {
    console.log("Message: " + e.data);
    messagesList.prepend(
      "<li class='other-message'>" + "Other Client: " + e.data + "</li>"
    );
  };
});
