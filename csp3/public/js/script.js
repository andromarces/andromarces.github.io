"use strict"

$(function () {
    // document ready variables
    var passwords = 0; /* 0 = passwords invalid, 1 = passwords OK */
    var username = 0; /* 0 = username invalid, 1 = username valid */
    var email = 0; /* 0 = email invalid, 1 email valid */

    // ajax csrf setup
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // register user
    $("#modalRegisterForm").submit(function (e) {
        e.preventDefault();
        var name = $("#orangeForm-name").val();
        var emailreg = $("#orangeForm-email").val();
        var password = $("#orangeForm-pass").val();
        var password2 = $("#orangeForm-pass2").val();
        $("#modalRegisterForm").modal("hide");
        $("#orangeForm-name").val("");
        $("#orangeForm-email").val("");
        $("#orangeForm-pass").val("");
        $("#orangeForm-pass2").val("");
        $.ajax({
            method: "post",
            url: "register",
            data: {
                username: name,
                email: emailreg,
                password: password,
                password_confirmation: password2
            },
            success: function (data) {
                $("#modalRegisterForm").find("input").val("");
                $("#hiddenDiv1").load(" .navbar-nav", function () {
                    $("#navbarSupportedContent-4").fadeOut(function () {
                        $("#navbarSupportedContent-4").empty();
                        $("#navbarSupportedContent-4").html($('#hiddenDiv1').html());
                        $("#navbarSupportedContent-4").fadeIn();
                        $("#hiddenDiv1").empty();
                    });
                });
            },
            error: function (data) {
                console.log(data.responseText);
            }
        });
    });

    // logout user
    $("#navbarSupportedContent-4").on("click", ".logOut", function (e) {
        e.preventDefault();
        var token = $(this).data("token");
        $.ajax({
            method: "post",
            url: "logout",
            data: {
                _token: token
            },
            success: function (data) {
                $("#hiddenDiv1").load(" .navbar-nav", function () {
                    $("#navbarSupportedContent-4").fadeOut(function () {
                        $("#navbarSupportedContent-4").empty();
                        $("#navbarSupportedContent-4").html($('#hiddenDiv1').html());
                        $("#navbarSupportedContent-4").fadeIn();
                        $("#hiddenDiv1").empty();
                    });
                });
            },
            error: function (data) {
                console.log(data.responseText);
            }
        });
    });

    // login user
    $("#navbarSupportedContent-4").on("submit", "#loginForm", function (e) {
        e.preventDefault();
        var token = $(this).data("token");
        var name = $("#DropdownFormUsername").val();
        var password = $("#DropdownFormPassword").val();
        $.ajax({
            method: "post",
            url: "login",
            data: {
                _token: token,
                username: name,
                password: password
            },
            success: function (data) {
                $("#hiddenDiv1").load(" .navbar-nav", function () {
                    $("#navbarSupportedContent-4").fadeOut(function () {
                        $("#navbarSupportedContent-4").empty();
                        $("#navbarSupportedContent-4").html($('#hiddenDiv1').html());
                        $("#navbarSupportedContent-4").fadeIn();
                        $("#hiddenDiv1").empty();
                    });
                });
            },
            error: function (data) {
                console.log(data.responseText);
            }
        });
    });

    // check email if available
    $("#orangeForm-email").on("input", function () {
        var emailreg = $(this).val();
        $.ajax({
            method: "post",
            url: "checkEmail",
            data: {
                email: emailreg
            },
            success: function (data) {
                if (emailreg == "") {
                    $("#emailValidation").empty();
                    email = 0;
                } else if (data == 1) {
                    $("#emailValidation").css("color", "red");
                    $("#emailValidation").html("Email not available.");
                    email = 0;
                } else {
                    $("#emailValidation").css("color", "green");
                    $("#emailValidation").html("Email available.");
                    email = 1;
                    if (passwords == 1 && username == 1 && email == 1) {
                        $("#registerBtn").prop("disabled", false);
                    }
                }
            },
            error: function (data) {
                console.log(data.responseText);
            }
        });
    });

    // check username if available
    $("#orangeForm-name").on("input", function () {
        var usernameCheck = $(this).val();
        $.ajax({
            method: "post",
            url: "checkUsername",
            data: {
                username: usernameCheck
            },
            success: function (data) {
                if (usernameCheck == "") {
                    $("#usernameValidation").empty();
                    username = 0;
                } else if (data == 1) {
                    $("#usernameValidation").css("color", "red");
                    $("#usernameValidation").html("Username not available.");
                    username = 0;
                } else {
                    $("#usernameValidation").css("color", "green");
                    $("#usernameValidation").html("Username available.");
                    username = 1;
                    if (passwords == 1 && username == 1 && email == 1) {
                        $("#registerBtn").prop("disabled", false);
                    }
                }
            },
            error: function (data) {
                console.log(data.responseText);
            }
        });
    });

    // check passwords if matching
    $("#orangeForm-pass").on("input", function () {
        if ($("#orangeForm-pass").val() == "" || $("#orangeForm-pass2").val() == "") {
            $("#passwordValidation").empty();
            passwords = 0;
        } else if ($("#orangeForm-pass").val().length < 6 || $("#orangeForm-pass2").val().length < 6) {
            passwords = 0;
            $("#passwordValidation").css("color", "red");
            $("#passwordValidation").html("Both passwords must be more than 6 characters.");
        } else if ($("#orangeForm-pass").val() == $("#orangeForm-pass2").val()) {
            passwords = 1;
            $("#passwordValidation").css("color", "green");
            $("#passwordValidation").html("Passwords matching.");
            if (passwords == 1 && username == 1 && email == 1) {
                $("#registerBtn").prop("disabled", false);
            }
        } else if ($("#orangeForm-pass").val().length > 6 && $("#orangeForm-pass2").val().length > 6) {
            passwords = 0;
            $("#passwordValidation").css("color", "red");
            $("#passwordValidation").html("Both passwords must match.");
        }
    });

    $("#orangeForm-pass2").on("input", function () {
        if ($("#orangeForm-pass").val() == "" || $("#orangeForm-pass2").val() == "") {
            $("#passwordValidation").empty();
            passwords = 0;
        } else if ($("#orangeForm-pass").val().length < 6 || $("#orangeForm-pass2").val().length < 6) {
            passwords = 0;
            $("#passwordValidation").css("color", "red");
            $("#passwordValidation").html("Both passwords must be more than 6 characters.");
        } else if ($("#orangeForm-pass").val() == $("#orangeForm-pass2").val()) {
            passwords = 1;
            $("#passwordValidation").css("color", "green");
            $("#passwordValidation").html("Passwords matching.");
            if (passwords == 1 && username == 1 && email == 1) {
                $("#registerBtn").prop("disabled", false);
            }
        } else if ($("#orangeForm-pass").val().length > 6 && $("#orangeForm-pass2").val().length > 6) {
            passwords = 0;
            $("#passwordValidation").css("color", "red");
            $("#passwordValidation").html("Both passwords must match.");
        }
    });

});