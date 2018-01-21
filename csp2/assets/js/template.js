$(function () { /* document ready function */
    "use strict" /* strict mode enabled */

    // function to close menus when user clicks outside of them
    function ddbtnclose(event, element, menu) {
        if (!$(event.target).closest(element).length) {
            if ($(menu).css("display") == "block") {
                $(menu).fadeOut(350);
            }
        }
    }

    // toggle to close or open .ddmenu
    $("#navbarDropdownMenuLink").click(function () {
        $(".ddmenu").fadeToggle(350);
    });

    // simulate clicking on #navbarDropdownMenuLink to open .ddmenu when mouse hovers on #navbarDropdownMenuLink
    $("#navbarDropdownMenuLink").mouseenter(function () {
        if ($(".ddmenu").css("display") !== "block" && $("span.d-none").css("display") !== "none") {
            $("#navbarDropdownMenuLink").click();
        }
    });

    // close .ddmenu when mouse leaves top navbar
    $("nav").mouseleave(function () {
        if ($(".ddmenu").css("display") == "block" && $("span.d-none").css("display") !== "none") {
            $(".ddmenu").fadeOut(350);
        }
    });

    // toggle to close or open .ddsu1
    $("#dropdownMenuButton1").click(function () {
        $(".ddsu1").fadeToggle(350);
    });

    // toggle to close or open .ddsu2
    $("#dropdownMenuButton2").click(function () {
        $(".ddsu2").fadeToggle(350);
    });

    // call ddbtnclose to close .ddmenu when user clicks outside of #ddp
    $(document).click(function () {
        ddbtnclose(event, document.getElementById("ddp"), document.getElementsByClassName("ddmenu"));
    });

    // call ddbtnclose to close .ddsu1 when user clicks outside of #ddsu1
    $(document).click(function () {
        ddbtnclose(event, document.getElementById("ddsu1"), document.getElementsByClassName("ddsu1"));
    });

    // call ddbtnclose to close .ddsu2 when user clicks outside of #ddsu2
    $(document).click(function () {
        ddbtnclose(event, document.getElementById("ddsu2"), document.getElementsByClassName("ddsu2"));
    });

    // toggle to close or open div.navbar-collapse
    $("button.navbar-toggler").click(function () {
        if ($("div.navbar-collapse").css("left") == "-210px") {
            $("div.navbar-collapse").animate({
                left: 1
            }, 350, function () {
                $("button.navbar-toggler").attr("aria-expanded", "true");
            });
        } else {
            $("div.navbar-collapse").animate({
                left: -210
            }, 350, function () {
                $("button.navbar-toggler").attr("aria-expanded", "false");
            });
        }
    });

    // close div.navbar-collapse when clicking outside #navbarNavDropdown
    $(document).click(function () {
        if (!$(event.target).closest($('#navbarNavDropdown')).length) {
            if ($("div.navbar-collapse").css("left") == "1px") {
                $("div.navbar-collapse").animate({
                    left: -210
                }, 350, function () {
                    $("button.navbar-toggler").attr("aria-expanded", "false");
                });
            }
        }
    });
});