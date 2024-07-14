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
  // create model to allow user edit her data
});
