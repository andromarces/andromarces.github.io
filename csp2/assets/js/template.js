$(function () { /* document ready function */
    "use strict" /* strict mode enabled */

    // show or hide .searchForm after page load depending on visibility of #searchtgl
    if ($('#searchtgl').css("display") == "inline-block") {
        $('.searchForm').css("display", "none");
    } else {
        $('.searchForm').css("display", "flex");
    }

    // show or hide .searchForm on browser resize depending on visibility of #searchtgl
    $(window).resize(function () {
        if ($('#searchtgl').css("display") == "inline-block") {
            $('.searchForm').css("display", "none");
        } else {
            $('.searchForm').css("display", "flex");
        }
    });

    // function to close menus when user clicks outside of them
    function ddbtnclose(event, element, menu) {
        if (!$(event.target).closest(element).length) {
            if ($(menu).css("display") !== "none") {
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

    // toggle to close or open .ddsu1 or close div.navbar-collapse if it is open
    $("#dropdownMenuButton1").click(function () {
        $(".ddsu1").fadeToggle(350);
        if ($("div.navbar-collapse").css("left") == "1px") {
            $("div.navbar-collapse").animate({
                left: -210
            }, 350, function () {
                $("button.navbar-toggler").attr("aria-expanded", "false");
            });
        }
    });

    // toggle to close or open .ddsu2
    $("#dropdownMenuButton2").click(function () {
        $(".ddsu2").fadeToggle(350);
    });

    // toggle to close or open .searchForm
    $('#searchtgl').click(function () {
        $('.searchForm').fadeToggle(350);
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

    // call ddbtnclose to close .searchForm when user clicks outside of .searchWrapper
    $(document).click(function () {
        ddbtnclose(event, document.getElementsByClassName("searchWrapper"), document.getElementsByClassName("searchForm"));
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