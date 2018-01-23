$(function () { /* document ready function */
    "use strict" /* strict mode enabled */

    // show or hide .searchForm after page load depending on visibility of #searchtgl
    if ($("#searchtgl").css("display") == "inline-block") {
        $(".searchForm").css("display", "none");
    } else {
        $(".searchForm").css("display", "flex");
    }

    // show or hide .searchForm on browser resize depending on visibility of #searchtgl
    $(window).resize(function () {
        if ($("#searchtgl").css("display") == "inline-block") {
            $(".searchForm").css("display", "none");
        } else {
            $(".searchForm").css("display", "flex");
        }
    });

    // function to close menus when user clicks outside of their container element
    function ddbtnclose(event, element, menu, btn) {
        if (!$(event.target).closest(element).length) {
            if ($(menu).css("display") !== "none") {
                $(menu).fadeOut(350, function () {
                    $(btn).attr("aria-expanded", "false");
                    $(element).removeClass("show");
                });
            }
        }
    }

    function toggleFade(element, menu, btn) {
        if ($(menu).css("display") !== "none") {
            $(menu).fadeOut(350, function () {
                $(btn).attr("aria-expanded", "false");
                $(element).removeClass("show");
            });
        } else {
            $(menu).fadeIn(350, function () {
                $(btn).attr("aria-expanded", "true");
                $(element).addClass("show");
            });
        }
    }

    // open .ddmenu when mouse hovers on #navbarDropdownMenuLink
    $("#navbarDropdownMenuLink").mouseenter(function () {
        if ($(".ddmenu").css("display") !== "block" && $("span.d-none").css("display") !== "none") {
            $(".ddmenu").fadeIn(350, function () {
                $("#navbarDropdownMenuLink").attr("aria-expanded", "true");
                $("#ddp").addClass("show");
            });
        }
    });

    // open .ddsu2 when mouse hovers on #dropdownMenuButton2
    $("#dropdownMenuButton2").mouseenter(function () {
        if ($(".ddsu2").css("display") !== "block" && $("span.d-none").css("display") !== "none") {
            $(".ddsu2").fadeIn(350, function () {
                $("#dropdownMenuButton2").attr("aria-expanded", "true");
                $("#ddsu2").addClass("show");
            });
        }
    });

    // close .ddmenu and/or .ddsu2 when mouse leaves #navBar
    $("#navBar").mouseleave(function () {
        if ($(".ddmenu").css("display") == "block" && $("span.d-none").css("display") !== "none") {
            $(".ddmenu").fadeOut(350, function () {
                $("#navbarDropdownMenuLink").attr("aria-expanded", "false");
                $("#ddp").removeClass("show");
            });
        }
        if ($(".ddsu2").css("display") == "block" && $("span.d-none").css("display") !== "none") {
            $(".ddsu2").fadeOut(350, function () {
                $("#dropdownMenuButton2").attr("aria-expanded", "false");
                $("#ddsu2").removeClass("show");
            });
        }
    });

    // toggle to close or open .ddmenu
    $("#navbarDropdownMenuLink").click(function () {
        toggleFade(document.getElementById("ddp"), document.getElementsByClassName("ddmenu"), document.getElementById("navbarDropdownMenuLink"));
    });

    // toggle to close or open .ddsu2
    $("#dropdownMenuButton2").click(function () {
        toggleFade(document.getElementById("ddsu2"), document.getElementsByClassName("ddsu2"), document.getElementById("dropdownMenuButton2"));
    });

    // toggle to close or open .ddsu1 and close other menus if they are open
    $("#dropdownMenuButton1").click(function () {
        toggleFade(document.getElementById("ddsu1"), document.getElementsByClassName("ddsu1"), document.getElementById("dropdownMenuButton1"));
        if ($("div.navbar-collapse").css("left") == "1px") {
            $("div.navbar-collapse").animate({
                left: -210
            }, 350, function () {
                $("button.navbar-toggler").attr("aria-expanded", "false");
            });
        }
        if ($(".searchForm").css("display") == "flex" && $("#searchtgl").css("display") == "inline-block") {
            $(".searchForm").fadeOut(350);
        }
        if ($(".ddmenu").css("display") == "block") {
            $(".ddmenu").fadeOut(350, function () {
                $("#navbarDropdownMenuLink").attr("aria-expanded", "false");
                $("#ddp").removeClass("show");
            });
        }
        if ($(".ddsu2").css("display") == "block") {
            $(".ddsu2").fadeOut(350, function () {
                $("#dropdownMenuButton2").attr("aria-expanded", "false");
                $("#ddsu2").removeClass("show");
            });
        }
    });

    // toggle to close or open .searchForm
    $("#searchtgl").click(function () {
        $(".searchForm").fadeToggle(350);
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

    // close .searchForm when user clicks outside of .searchWrapper
    $(document).click(function () {
        if (!$(event.target).closest(".searchWrapper").length) {
            if ($(".searchForm").css("display") !== "none" && $("#searchtgl").css("display") == "inline-block") {
                $(".searchForm").fadeOut(350);
            }
        }
    });

    // close div.navbar-collapse when clicking outside #navbarNavDropdown
    $(document).click(function () {
        if (!$(event.target).closest($("#navbarNavDropdown")).length) {
            if ($("div.navbar-collapse").css("left") == "1px") {
                $("div.navbar-collapse").animate({
                    left: -210
                }, 350, function () {
                    $("button.navbar-toggler").attr("aria-expanded", "false");
                });
            }
        }
    });

    // call ddbtnclose to close menus when user clicks outside of their container element
    $(document).click(function () {
        ddbtnclose(event, document.getElementById("ddp"), document.getElementsByClassName("ddmenu"), document.getElementById("navbarDropdownMenuLink"));
        ddbtnclose(event, document.getElementById("ddsu1"), document.getElementsByClassName("ddsu1"), document.getElementById("dropdownMenuButton1"));
        ddbtnclose(event, document.getElementById("ddsu2"), document.getElementsByClassName("ddsu2"), document.getElementById("dropdownMenuButton2"));
    });
});