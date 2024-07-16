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
          console.log(data);
          if (data.success == true) {
            $(".loader").addClass("signup");
            $("#loadingIcon").css("display", "flex");
            setInterval(() => {
              $("#loadingIcon").css("display", "none");
            }, 2000);
            if (data.sendMail == true) {
              setInterval(() => {
                $("#register-form")
                  .prepend()
                  .addClass("alert alert-primary verification_alert")
                  .text(data.sending_mail_message);
              }, 2000);
              createToast(
                data.response_type,
                "fa-solid fa-circle-check",
                "Success",
                data.message
              );
            }
          } else {
            createToast(
              data.response_type,
              "fa-solid fa-circle-exclamation",
              "Failed",
              data.message
            );
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
            $(".loader").addClass("login");
            $("#loadingIcon").css("display", "flex");
            createToast(
              data.response_type,
              "fa-solid fa-circle-check",
              "Success",
              data.message
            );
            setInterval(() => {
              location.href = data.URL;
            }, 2000);
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
  // manage logout
  $("#logout").on("click", function (e) {
    e.preventDefault();
    let url = $(this).attr("href");
    $.ajax({
      url: url,
      type: "POST",
      success: function (data) {
        if (data == 1) {
          $("#loadingIcon").css("display", "flex");
          setInterval(() => {
            location.href = "index.php";
          }, 2000);
        } else {
          createToast(
            "error",
            "fa-solid fa-circle-check",
            "error",
            "Something Is Wrong, Try Later!"
          );
        }
      },
    });
  });
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
  newToast.timeOut = setTimeout(() => newToast.remove(), 2000);
}
$("#action_menu_btn").click(function () {
  $(".action_menu").toggle();
}); 
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
