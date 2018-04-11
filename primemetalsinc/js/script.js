"use strict"

$(function () { /* document ready function */

    // carousel init
    $(".carousel.carousel-slider").carousel({
        fullWidth: true
    });

    // sidenav init
    $(".sidenav").sidenav();

    // on resize, show navbar on large and up
    $(window).resize(function () {
        $(".sidenav").sidenav("close");
        setTimeout(() => {
            if ($(".sidenav-trigger").css("display") == "none") {
                $("nav").css("transform", "");
            }
        }, 251);
    });

    // on scroll, show back to top button on med and down
    $(window).scroll(function () {
        if ($(".sidenav-trigger").css("display") !== "none" && (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200)) {
            $("#topBtn").css("display", "inline-block");
        } else {
            $("#topBtn").css("display", "none");
        }
    });

});