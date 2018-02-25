'use strict'

$(function () {

    var page = 0;

    // fadeout page loader
    $(".loader").fadeOut(function () {
        // fadein landing page
        $(".navbar").fadeIn();
        $(".landing").fadeIn();
        page = 1;
    });

    // fix .pages height on load
    function calcVH() {
        $(".pages").innerHeight( $(this).innerHeight() );
    }
    calcVH();
    $(window).on("resize orientationchange", function() {
        calcVH();
    });
    // stick footer to the bottom of viewport when content is too short
    // var contentHeight = (window.innerHeight - ($(".landing").outerHeight(true) - $(".landing").innerHeight() + 1));
    // // $(".landing").css("min-height", contentHeight + "px");
    // $(".landing").css("min-height", contentHeight + "px");
    // $(".portfolio1").css("min-height", contentHeight + "px");

    // on resize, stick footer to the bottom of viewport when content is too short
    // $(window).resize(function () {
    //     contentHeight = (window.innerHeight - ($(".landing").outerHeight(true) - $(".landing").innerHeight() + 1));
    //     // $(".landing").css("min-height", contentHeight + "px");
    //     $(".landing").css("min-height", contentHeight + "px");
    //     $(".portfolio1").css("min-height", contentHeight + "px");
    // });

    // animated hamburger icon
    $(".animated-icon1").click(function () {
        $(this).toggleClass("open");
        if ($(".navbar").css("width") !== "45px") {
            $(this).css("left", "-1px");
            $(".navbar-toggler").css("margin-left", "-8px");
            $(".navbar").animate({
                "width": "45px",
                "border-radius": "50%"
            }, 400);
        } else {
            $(this).css("left", "5px");
            $(".navbar-toggler").css("margin-left", "40px");
            $(".navbar").animate({
                "width": "105px",
                "border-radius": "0.25rem"
            }, 400);
        }
    });

    // close hamburger menu when clicking outside of it
    $(document).click(function () {
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
    });

    var bottom = 0;
    // detect if user is at the bottom of page on page load
    if ($(window).scrollTop() + $(window).height() == $(document).height()) {
        bottom = 1;
    }

    // detect if user has scrolled to the bottom
    $(window).scroll(function () {
        if ($(window).scrollTop() + $(window).height() == $(document).height()) {
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
                    if (page == 2) {
                        $("footer").slideUp();
                    }
                    $(".page" + page).css("min-height", "0px");
                    $(".page" + page).slideUp(function () {
                        page--;
                        $(".page" + page).css("min-height", "0px");
                        $(".page" + page).slideDown(function () {
                            scrollDetect = 0;
                            bottom = 0;
                            top = 0;
                            if ($(window).scrollTop() == 0) {
                                top = 1;
                            }
                            // contentHeight = (window.innerHeight - ($("footer").outerHeight(true) + ($(".landing").outerHeight(true) - $(".landing").innerHeight() + 1)));
                            // $(".landing").css("min-height", contentHeight + "px");
                            // $(".portfolio1").css("min-height", contentHeight + "px");
                            setTimeout(() => {
                                if ($(window).scrollTop() + $(window).height() == $(document).height()) {
                                    bottom = 1;
                                }
                            }, 500);
                        });
                    });
                }
            } else {
                if (page < 3 && bottom == 1) {
                    scrollDetect = 1;
                    $(".page" + page).css("min-height", "0px");
                    $(".page" + page).slideUp(function () {
                        page++;
                        if (page == 3) {
                            $("footer").slideDown();
                        }
                        $(".page" + page).css("min-height", "0px");
                        $(".page" + page).slideDown(function () {
                            scrollDetect = 0;
                            bottom = 0;
                            top = 0;
                            if ($(window).scrollTop() == 0) {
                                top = 1;
                            }
                            // contentHeight = (window.innerHeight - ($("footer").outerHeight(true) + ($(".landing").outerHeight(true) - $(".landing").innerHeight() + 1)));
                            // $(".landing").css("min-height", contentHeight + "px");
                            // $(".portfolio1").css("min-height", contentHeight + "px");
                            if ($(window).scrollTop() + $(window).height() == $(document).height()) {
                                bottom = 1;
                            }
                        });
                    });
                }
            }
        }
    });

});