$(document).ready(function () {
    // Add message data
    let messages = [
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
        let messageList = $("<ul>").addClass("message-list");

        messages.forEach(function (message) {
            let senderClass = message.sender === "Me" ? "msg-from" : "msg-to";
            let messageItem = $("<li>").addClass(senderClass);

            let content = $("<p>")
                .addClass("msg-content")
                .text(message.sender + ": ");
            let span = $("<span>").text(message.content);
            content.append(span);

            let date = $("<p>").addClass("msg-date").text(message.date);

            messageItem.append(content);
            messageItem.append(date);
            messageList.append(messageItem);
        });

        // Add the message list to the chat body
        let chatBody = $(".chatBody");
        chatBody.empty();
        chatBody.append(messageList);
    }

    let chatTitle = $("<h4>");
    let statue = $("<p>");
    let chatHeader = $(".chatHeader");
    // Event handler for user item click
    $(".user-item").on("click", function () {
        let element = $(this);
        let username = element.attr("data-user");
        var receiver_id = element.attr("data-uid");
        let status = element.attr("data-status");
        // Update the message list based on user item data
        chatHeader.empty();
        statue.text(status);
        chatHeader.attr("data-receiver", receiver_id);
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
            data: {user_id: user_id},
            success: function (data) {
                let user_login_status = data;
                // Update the data-status attribute of the user element
                userElement.attr("data-status", (user_login_status === "Login") ? "Action Now" : "Offline");
                // Update the status icon based on the user login status
                let statusIcon = userElement.find(".status svg");
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
        let userElement = $(this);
        let user_id = userElement.attr("data-uid");
        setInterval(() => {
            updateUserStatus(userElement, user_id);
        }, 1000);
    });
    // Create a new WebSocket object and connect it to the server
    var conn = new WebSocket("ws://localhost:8080");
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
    };
    console.log("123")
    // Event handler when a message is received from the server
    conn.onmessage = function (e) {
        let data = JSON.parse(e.data);
        console.log(data);
        let row_class = "";
        let background_class = "";

        if (data.from === 'Me') {
            row_class = "row d-flex justify-content-start";
            background_class = "text-dark alert-light";
        } else {
            row_class = "row d-flex justify-content-end";
            background_class = "alert-success";
        }

        let html_data = generateChatMessageHTML(data.from, data.message, data.date, row_class, background_class);
        $(".chatBody").append(html_data);
        $("#chat-message").val('').attr("placeholder", "Type a message...");
    };

    function generateChatMessageHTML(from, message, date, rowClass, backgroundClass) {
        return `
    <div class="${rowClass}">
      <div class="col-sm-10">
        <div class="shadow-sm alert ${backgroundClass}">
          <b>${from}: </b>${message}<br>
          <div class="text-end"><small><i>${date}</i></small></div>
        </div>
      </div>
    </div>
  `;
    }

    // Disable button and change its color and cursor initially
    $("#send-button").prop("disabled", true).addClass("disabled");
    // Enable or disable button based on textarea value
    $("#chat-message").on("input", function () {
        var inputValue = $(this).val().trim();

        if (inputValue !== "") {
            $("#send-button").prop("disabled", false).removeClass("disabled");
        } else {
            $("#send-button").prop("disabled", true).addClass("disabled");
        }
    });
    // Event handler when the WebSocket connection is successfully established
    // get the message from ,input field and messages list
// Function to handle form submission
    let form = $("#message-form");
    form.on("submit", function (e) {
        e.preventDefault();

        // Get the message and user ID from the form inputs
        let message = $("#chat-message").val();
        let user_id = $("#send-button").attr("data-uid");
        // Create the form data object with the message, user ID, receiver, and date
        let formData = {
            type: "message",
            user_id: user_id,
            msg: message,
            receiver: chatHeader.attr("data-receiver"),
            date: getCurrentDate()
        };

        // Send the form data via WebSocket if the receiver is specified
        if (formData.receiver.length > 0) {
            conn.send(JSON.stringify(formData));
        }
    });

// Function to get the current date in a 12-hour format with AM/PM
    function getCurrentDate() {
        let date = new Date();
        let year = date.getFullYear()
        let hours = date.getHours() % 12 || 12; // Convert to 12-hour format
        let minutes = date.getMinutes();
        let ampm = hours >= 12 ? "AM" : "PM";
        let formattedDate = `${hours}:${padZero(minutes)} ${ampm}`;

        return formattedDate;
    }

// Function to pad a value with leading zeros if necessary
    function padZero(value) {
        return value.toString().padStart(2, "0");
    }

});
