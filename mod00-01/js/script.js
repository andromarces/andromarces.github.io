'use strict'

// typewriter effect
var i = 0;
var txt = "I am a full-stack web developer from the Philippines, based in Davao City. Passionate about expanding my knowledge of web development and creating amazing websites. Feel free to take a look at my projects! "; /* The text */
var speed = 50; /* The speed/duration of the effect in milliseconds */

function typeWriter() {
    if (i < txt.length) {
        document.getElementById("landingTxt").innerHTML += txt.charAt(i);
        i++;
        setTimeout(typeWriter, speed);
    }
}

$(function () {

    var page = 0;

    // fadeout page loader
    setTimeout(() => {
        $(".loader").fadeOut(function () {
            // fadein landing page
            $(".navbar").fadeIn();
            $(".landing").fadeIn(function () {
                setTimeout(() => {
                    typeWriter();
                }, 300);
            });
            page = 1;
        });
    }, 2000);

    // fill whole viewport height
    var contentHeight = (window.innerHeight - ($(".landing").outerHeight(true) - $(".landing").innerHeight() + 1));
    $(".pages").css("min-height", contentHeight + "px");

    // on resize, fill whole viewport height
    $(window).resize(function () {
        if (page == 3) {
            contentHeight = (window.innerHeight - ($("footer").outerHeight(true) + ($(".landing").outerHeight(true) - $(".landing").innerHeight() + 1)));
        } else {
            contentHeight = (window.innerHeight - ($(".landing").outerHeight(true) - $(".landing").innerHeight() + 1));
        }
        $(".pages").css("min-height", contentHeight + "px");
    });

    // animated hamburger icon
    var hamburgerBusy = 0;
    $(".animated-icon1").click(function () {
        hamburgerBusy = 1;
        $(".navbar").css("pointer-events", "none");
        $(this).toggleClass("open");
        if ($(".navbar").css("width") !== "45px") {
            $(this).css("left", "-1px");
            $(".navbar-toggler").css("margin-left", "-8px");
            $(".navbar").animate({
                "width": "45px",
                "border-radius": "50%"
            }, 400, function () {
                hamburgerBusy = 0;
                $(".navbar").css("pointer-events", "");
            });
        } else {
            $(this).css("left", "5px");
            $(".navbar-toggler").css("margin-left", "40px");
            $(".navbar").animate({
                "width": "105px",
                "border-radius": "0.25rem"
            }, 400, function () {
                hamburgerBusy = 0;
                $(".navbar").css("pointer-events", "");
            });
        }
    });

    // close hamburger menu when clicking outside of it
    $(document).click(function () {
        if (hamburgerBusy == 0) {
            if (!$(event.target).closest($(".navbar")).length) {
                if ($(".navbar").css("width") !== "45px") {
                    $(".animated-icon1").toggleClass("open");
                    $(".animated-icon1").css("left", "-1px");
                    $(".navbar-toggler").css("margin-left", "-8px");
                    $(".navbar-toggler").addClass("collapsed");
                    $(".navbar-toggler").attr("aria-expanded", false);
                    $(".navbar-collapse").removeClass("show");
                    $(".navbar").animate({
                        "width": "45px",
                        "border-radius": "50%"
                    }, 400);
                }
            }
        }
    });

    var bottom = 0;
    // detect if user is at the bottom of page on page load
    if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
        bottom = 1;
    }

    // detect if user has scrolled to the bottom
    $(window).scroll(function () {
        if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
            bottom = 1;
        }
    });

    var top = 0;
    // detect if user is at the top of page on page load
    if ($(window).scrollTop() == 0) {
        top = 1;
    }

    // detect if user has scrolled to the top
    $(window).scroll(function () {
        if ($(window).scrollTop() == 0) {
            top = 1;
        }
    });

    // detect mousescroll
    var scrollDetect = 0;
    $(window).bind("mousewheel DOMMouseScroll", function (event) {
        if (scrollDetect == 0 && page > 0) {
            if (event.originalEvent.wheelDelta > 0 || event.originalEvent.detail < 0) {
                if (page > 1 && top == 1) {
                    scrollDetect = 1;
                    if (page == 3) {
                        $("footer").slideUp();
                    }
                    $(".page" + page).css("min-height", "0px");
                    $(".page" + page).slideUp(400, "linear");
                    page--;
                    $(".page" + page).css({
                        height: 0,
                        minHeight: 0,
                        position: "absolute",
                        bottom: 0,
                        overflow: "hidden",
                        display: "block"
                    });
                    if (page == 2) {
                        contentHeight = (window.innerHeight - ($(".landing").outerHeight(true) - $(".landing").innerHeight() + 1));
                    }
                    $(".page" + page).animate({
                        height: contentHeight + "px"
                    }, 400, "linear", function () {
                        if (page == 1) {
                            i = 0;
                            typeWriter();
                        }
                        $(this).css({
                            height: "",
                            minHeight: contentHeight + "px",
                            position: "",
                            bottom: "",
                            marginTop: "",
                            overflow: "",
                        });
                        scrollDetect = 0;
                        bottom = 0;
                        top = 0;
                        if ($(window).scrollTop() == 0) {
                            top = 1;
                        }
                        setTimeout(() => {
                            if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
                                bottom = 1;
                            }
                        }, 500);
                    });
                }
            } else {
                if (page < 3 && bottom == 1) {
                    scrollDetect = 1;
                    $(".page" + page).css("min-height", "0px");
                    $(".page" + page).slideUp(400, "linear", function () {
                        if (page == 2) {
                            $("#landingTxt").empty();
                        }
                    });
                    page++;
                    $(".page" + page).css({
                        height: 0,
                        minHeight: 0,
                        position: "absolute",
                        bottom: 0,
                        overflow: "hidden",
                        display: "block"
                    });
                    if (page == 3) {
                        contentHeight = (window.innerHeight - ($("footer").outerHeight(true) + ($(".landing").outerHeight(true) - $(".landing").innerHeight() + 1)));
                    }
                    $(".page" + page).animate({
                        marginTop: 0,
                        height: contentHeight + "px"
                    }, 400, "linear", function () {
                        if (page == 3) {
                            $("footer").slideDown();
                        }
                        $(this).css({
                            height: "",
                            minHeight: contentHeight + "px",
                            position: "",
                            bottom: "",
                            marginTop: "",
                            overflow: ""
                        });
                        scrollDetect = 0;
                        bottom = 0;
                        top = 0;
                        if ($(window).scrollTop() == 0) {
                            top = 1;
                        }
                        if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
                            bottom = 1;
                        }
                    });
                }
            }
        }
    });

});