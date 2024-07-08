$(document).ready(function () {
  /*
   * Registration
   * Get All register form inputs value, validate them and send them to the server
   */
  $("#register-form").submit(function (e) {
    e.preventDefault();
    var form = $(this);
    var formData = {
      username: $("#username").val(),
      password: $("#password").val(),
      email: $("#email").val(),
    };

    var isValid = true;

    $.each(formData, function (index, value) {
      if (value === "") {
        $("#" + index).css("border-color", "red");
        $("#" + index).addClass("invalid");
        let parent = $("#" + index).parent();
        parent.append(
          "<span class='invalidFeedback'>* This field is required</span>"
        );
        isValid = false;
      } else {
        $("#" + index).css("border-color", "green");
        $("#" + index).removeClass("invalid");
        $("#" + index)
          .parent()
          .find(".invalidFeedback")
          .remove();
      }
    });

    if (isValid) {
      var formURL = form.attr("action");
      $.ajax({
        url: formURL,
        type: "POST",
        data: formData,
        success: function (data) {
          console.log(data);
          if (data == "success") {
          } else {
          }
        },
      });
    }
  });

  /*
  // Create a new WebSocket object and connect it to the server
  const conn = new WebSocket("ws://localhost:8080");
  // Event handler when the WebSocket connection is successfully established
  // get the message from ,input field and messages list
  var form = $("#message_form"),
    messageInput = form.find("#message_input"),
    messagesList = $(".message_list"),
    usernameForm = $(".username-setter"),
    usernameInput = $(".username-input");
  form.on("submit", function (e) {
    e.preventDefault();
    
    //  * make an object containing
    //  * message text
    //  * sender
    //  * type
    
    var message = {
      text: messageInput.val(),
      sender: $.cookie("chat_name"),
      type: "message",
    };
    // Send a message to the server
    conn.send(JSON.stringify(message));
    messagesList.prepend(
      "<li class='my-message'>" +
        $.cookie("chat_name") +
        ": " +
        message.text +
        "</li>"
    );
  });
  // Event handler for submitting the username form
  usernameForm.on("submit", function (e) {
    e.preventDefault();
    var ChatName = usernameInput.val();
    if (ChatName.length > 0) {
      // Store the username in a cookie
      $.cookie("chat_name", ChatName);
      // Update the username display
      $(".username").text(ChatName);
    }
  });
  // Event handler when the WebSocket connection is successfully established
  conn.onopen = function (e) {
    console.log(e);
    // Load message history from the server using AJAX
    $.ajax({
      url: "/history_load.php",
      dataType: "json",
      success: function (data) {
        // Iterate over the retrieved messages and append them to the message list
        $.each(data, function () {
          var li = $("<li>")
            .addClass("other-message")
            .text(this.sender + " : " + this.text);
          messagesList.append(li);
        });
      },
    });
    // Retrieve the stored username from a cookie and update the username display
    var ChatName = $.cookie("chat_name");
    if (!ChatName) {
      var timeStamp = new Date().getTime();
      $.cookie("chat_name", "anonymous" + timeStamp);
    }
    $(".username").text(ChatName);
  };
  // Event handler when a message is received from the server
  conn.onmessage = function (e) {
    console.log("Message: " + e.data);
    messagesList.prepend(
      "<li class='other-message'>" + "Other Client: " + e.data + "</li>"
    );
  };
  */
});
