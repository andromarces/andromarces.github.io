$(function () {
    "use strict"

    function ddbtnclose(event, element, menu) {
        if (!$(event.target).closest(element).length) {
            if ($(menu).css("display") == "block") {
                $(menu).fadeOut(350);
            }
        }
    }

    $("#navbarDropdownMenuLink").click(function () {
        $(".ddmenu").fadeToggle(350);
    });

    $("#navbarDropdownMenuLink").mouseenter(function () {
        if ($(".ddmenu").css("display") !== "block" && $("span.d-none").css("display") !== "none") {
            $("#navbarDropdownMenuLink").click();
        }
    });

    $(".ddmenu").mouseleave(function () {
        if ($(".ddmenu").css("display") == "block" && $("span.d-none").css("display") !== "none") {
            $(".ddmenu").fadeOut(350);
        }
    });

    $("nav").mouseleave(function () {
        if ($(".ddmenu").css("display") == "block" && $("span.d-none").css("display") !== "none") {
            $(".ddmenu").fadeOut(350);
        }
    });

    $("#dropdownMenuButton1").click(function () {
        $(".ddsu1").fadeToggle(350);
    });

    $("#dropdownMenuButton2").click(function () {
        $(".ddsu2").fadeToggle(350);
    });

    $(document).click(function () {
        ddbtnclose(event, document.getElementById("ddp"), document.getElementsByClassName("ddmenu"));
    });

    $(document).click(function () {
        ddbtnclose(event, document.getElementById("ddsu1"), document.getElementsByClassName("ddsu1"));
    });

    $(document).click(function () {
        ddbtnclose(event, document.getElementById("ddsu2"), document.getElementsByClassName("ddsu2"));
    });

    $("button.navbar-toggler").click(function () {
        if ($("div.navbar-collapse").css("left") == "-100px") {
            $("div.navbar-collapse").animate({
                left: 5
            }, 350, function () {
                $("button.navbar-toggler").attr("aria-expanded", "true");
            });
        } else {
            $("div.navbar-collapse").animate({
                left: -100
            }, 350, function () {
                $("button.navbar-toggler").attr("aria-expanded", "false");
            });
        }
    });

    $(document).click(function () {
        if (!$(event.target).closest($('#navbarNavDropdown')).length) {
            if ($("div.navbar-collapse").css("left") == "5px") {
                $("div.navbar-collapse").animate({
                    left: -100
                }, 350, function () {
                    $("button.navbar-toggler").attr("aria-expanded", "false");
                });
            }
        }
    });
});