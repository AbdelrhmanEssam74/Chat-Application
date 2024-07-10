$(document).ready(function () {
  /*
   * Registration
   * Get All register form inputs value, validate them and send them to the server
   */

  // validate password value
  var passwordInput = $("#password");
  var passwordRules = $("#password-rules");
  var show_password = $(".show-password");
  var ruleLength = $("#rule-length");
  var ruleLowercase = $("#rule-lowercase");
  var ruleUppercase = $("#rule-uppercase");
  var ruleNumber = $("#rule-number");
  show_password.hover(
    function () {
      passwordInput.attr("type", "text");
    },
    function () {
      passwordInput.attr("type", "password");
    }
  );

  passwordInput.on("input", function () {
    var password = passwordInput.val();

    var hasValidLength = password.length >= 8;
    var hasLowercase = /[a-z]/.test(password);
    var hasUppercase = /[A-Z]/.test(password);
    var hasNumber = /[0-9]/.test(password);

    ruleLength.toggleClass("invalid", !hasValidLength);
    ruleLowercase.toggleClass("invalid", !hasLowercase);
    ruleUppercase.toggleClass("invalid", !hasUppercase);
    ruleNumber.toggleClass("invalid", !hasNumber);
    if (hasValidLength && hasLowercase && hasUppercase && hasNumber) {
      passwordRules.hide();
    } else {
      passwordRules.show();
    }
  });
  // send registration data to the server
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
          data = JSON.parse(data);
          if (data.success == true) {
            createToast(
              data.response_type,
              "fa-solid fa-circle-check",
              "Success",
              data.message
            );
            setInterval(() => {
              console.log("end");
            }, 5000);
          } else {
            createToast(
              data.response_type,
              "fa-solid fa-circle-exclamation",
              "Failed",
              data.message
            );
          }
          if (data.sendMail == true) {
            $("#register-form")
              .prepend()
              .addClass("alert alert-primary verification_alert")
              .text(data.sending_mail_message);
          }
          if (data.response_type == "warning") {
            $("#register-form");
            let p = $("<p>")
              .text(data.message)
              .addClass("alert alert-warning ");
            $("#register-form").prepend(p);
          }
        },
        error: function () {
          createToast(
            "error",
            "fa-solid fa-circle-exclamation",
            "Failed",
            "Something went wrong, please try again later."
          );
        },
      });
    }
  });

  // send login data to the server
  $("#login-form").submit(function (e) {
    e.preventDefault();
    var form = $(this);
    var formData = {
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
          data = JSON.parse(data);
          if (data.response_type == "success" && data.success == true) {
            createToast(
              data.response_type,
              "fa-solid fa-circle-check",
              "Success",
              data.message
            );
            setInterval(() => {
              location.href = data.URL;
            }, 3000);
          }
          if (data.response_type == "error") {
            $("#login-form");
            let p = $("<p>").text(data.message).addClass("alert alert-danger ");
            $("#login-form").prepend(p);
          }
          if (data.response_type == "warning") {
            $("#login-form");
            let p = $("<p>")
              .text(data.message)
              .addClass("alert alert-warning ");
            $("#login-form").prepend(p);
          }
        },
      });
    }
  });
  //SECTION - Navbar
  $("nav a").click(function () {
    // Remove "active" class from all links
    $("nav a").removeClass("active");
    // Add "active" class to the clicked link
    $(this).addClass("active");
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

let notifications = document.querySelector(".notifications");

function createToast(type, icon, title, text) {
  let newToast = document.createElement("div");
  newToast.innerHTML = `
            <div class="Toast ${type}">
                <i class="${icon}"></i>
                <div class="content">
                    <div class="title">${title}</div>
                    <span>${text}</span>
                </div>
                <i class="fa-solid fa-xmark" onclick="(this.parentElement).remove()"></i>
            </div>`;
  notifications.appendChild(newToast);
  newToast.timeOut = setTimeout(() => newToast.remove(), 5000);
}
// success.onclick = function () {
//   let type = "success";
//   let icon = "fa-solid fa-circle-check";
//   let title = "Success";
//   let text = "This is a success toast.";
//   createToast(type, icon, title, text);
// };
// error.onclick = function () {
//   let type = "error";
//   let icon = "fa-solid fa-circle-exclamation";
//   let title = "Error";
//   let text = "This is a error toast.";
//   createToast(type, icon, title, text);
// };
// warning.onclick = function () {
//   let type = "warning";
//   let icon = "fa-solid fa-triangle-exclamation";
//   let title = "Warning";
//   let text = "This is a warning toast.";
//   createToast(type, icon, title, text);
// };
// info.onclick = function () {
//   let type = "info";
//   let icon = "fa-solid fa-circle-info";
//   let title = "Info";
//   let text = "This is a info toast.";
//   createToast(type, icon, title, text);
// };
