$(document).ready(function () {
    $("#updateForm").on("submit", function (e) {
        e.preventDefault();
        var form = $(this);
        var formData = {
            inputUsername: $("#inputUsername").val(),
            inputEmailAddress: $("#inputEmailAddress").val(),
        };

        var isValid = true;

        $.each(formData, function (index, value) {
            if (value === "") {
                $("#" + index).css("border-color", "red");
                $("#" + index).addClass("invalid")
                isValid = false;
            } else {
                $("#" + index).css("border-color", "green");
                $("#" + index).removeClass("invalid");
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
                    if (data.success === true) {
                        createToast(
                            data.response_type,
                            "fa-solid fa-circle-check",
                            "Success",
                            data.message
                        );
                    } else if (data.error === true) {
                        createToast(
                            data.response_type,
                            "fa-solid fa-circle-exclamation",
                            "Failed",
                            data.message
                        );
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
    })
})