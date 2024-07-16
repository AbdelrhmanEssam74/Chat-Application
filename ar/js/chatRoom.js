$(document).ready(function () {
  // Add message data
  var messages = [
    {
      sender: "Me",
      content: "Lorem ipsum dolor sit amet.",
      date: "2024-10-7 07:00",
    },
    {
      sender: "John Doe",
      content: "Lorem ipsum dolor sit amet.",
      date: "2024-10-7 07:05",
    },
    // Add more messages here...
  ];

  // Function to render messages
  function renderMessages() {
    var messageList = $("<ul>").addClass("message-list");

    messages.forEach(function (message) {
      var senderClass = message.sender === "Me" ? "msg-from" : "msg-to";
      var messageItem = $("<li>").addClass(senderClass);

      var content = $("<p>")
        .addClass("msg-content")
        .text(message.sender + ": ");
      var span = $("<span>").text(message.content);
      content.append(span);

      var date = $("<p>").addClass("msg-date").text(message.date);

      messageItem.append(content);
      messageItem.append(date);
      messageList.append(messageItem);
    });

    // Add the message list to the chat body
    var chatBody = $(".chatBody");
    chatBody.empty();
    chatBody.append(messageList);
  }
  var chatTitle = $("<h4>");
  var statue = $("<p>");
  var chatHeader = $(".chatHeader");
  // Event handler for user item click
  $(".user-item").on("click", function () {
    var element = $(this);
    var username = element.attr("data-user");
    var user_id = element.attr("data-uid");
    var status = element.attr("data-status");

    // Update the message list based on user item data
    chatHeader.empty();
    statue.text(status);
    chatTitle.text(username);
    chatHeader.append(chatTitle);
    chatHeader.append(statue);
  });
  // Update user status
  function updateUserStatus(userElement, user_id) {
    // Make an AJAX request to get the updated user status
    $.ajax({
      url: "ar/function/getUserStatus.php",
      method: "POST",
      data: { user_id: user_id },
      success: function (data) {
        var user_login_status = data;
        // Update the data-status attribute of the user element
        userElement.attr("data-status", user_login_status);
        // Update the status icon based on the user login status
        var statusIcon = userElement.find(".status svg");
        if (user_login_status === "Login") {
          statusIcon.removeClass("offline-dot").addClass("online-dot");
        } else {
          statusIcon.removeClass("online-dot").addClass("offline-dot");
        }
      },
      error: function (err) {
        console.log(err);
      },
    });
  }
  // Update all user statuses
  $(".user-item").each(function () {
    var userElement = $(this);
    var user_id = userElement.attr("data-uid");
    setInterval(() => {
      updateUserStatus(userElement, user_id);
    }, 1000);
  });

 // Create a new WebSocket object and connect it to the server
 const conn = new WebSocket("ws://localhost:8080");
 // Event handler when the WebSocket connection is successfully established
 // get the message from ,input field and messages list
 // var form = $("#message_form"),
   // messageInput = form.find("#message_input"),
   // messagesList = $(".message_list"),
   // usernameForm = $(".username-setter"),
   // usernameInput = $(".username-input");
 // form.on("submit", function (e) {
 //   e.preventDefault();
 //
 //   //  * make an object containing
 //   //  * message text
 //   //  * sender
 //   //  * type
 //
 //   var message = {
 //     text: messageInput.val(),
 //     sender: $.cookie("chat_name"),
 //     type: "message",
 //   };
 //   // Send a message to the server
 //   conn.send(JSON.stringify(message));
 //   messagesList.prepend(
 //     "<li class='my-message'>" +
 //       $.cookie("chat_name") +
 //       ": " +
 //       message.text +
 //       "</li>"
 //   );
 // });
 // Event handler for submitting the username form
 // usernameForm.on("submit", function (e) {
 //   e.preventDefault();
 //   var ChatName = usernameInput.val();
 //   if (ChatName.length > 0) {
 //     // Store the username in a cookie
 //     $.cookie("chat_name", ChatName);
 //     // Update the username display
 //     $(".username").text(ChatName);
 //   }
 // });
 // Event handler when the WebSocket connection is successfully established
 conn.onopen = function (e) {
   console.log("WebSocket connection established")
   // Load message history from the server using AJAX
   // $.ajax({
   //   url: "/history_load.php",
   //   dataType: "json",
   //   success: function (data) {
   //     // Iterate over the retrieved messages and append them to the message list
   //     $.each(data, function () {
   //       var li = $("<li>")
   //         .addClass("other-message")
   //         .text(this.sender + " : " + this.text);
   //       messagesList.append(li);
   //     });
   //   },
   // });
   // Retrieve the stored username from a cookie and update the username display
   // var ChatName = $.cookie("chat_name");
   // if (!ChatName) {
   //   var timeStamp = new Date().getTime();
   //   $.cookie("chat_name", "anonymous" + timeStamp);
   // }
   // $(".username").text(ChatName);
 };
 // Event handler when a message is received from the server
 conn.onmessage = function (e) {
   console.log("Message: " + e.data);
   // messagesList.prepend(
   //   "<li class='other-message'>" + "Other Client: " + e.data + "</li>"
   // );
 };


});
