'use strict'

// typewriter effect
var i = 0;
var txt = "I am a freelance full-stack web developer from the Philippines, based in Davao City. Passionate about expanding my knowledge of web development and creating amazing websites. Feel free to take a look at my projects! ";
var speed = 50;

function typeWriter() {
    if (i < txt.length) {
        document.getElementById("landingTxt").innerHTML += txt.charAt(i);
        i++;
        setTimeout(typeWriter, speed);
    }
}


$(function () {

    // start page
    var page = 0;

    // contentHeight to fill viewport
    var contentHeight = (window.innerHeight - ($(".landing").outerHeight(true) - $(".landing").innerHeight()));

    // fadeout page loader and load page depending on hash
    setTimeout(() => {
        $(".loader").fadeOut(function () {
            // fadein page
            $(".navbar").fadeIn(400);
            $(".sr-only").remove();
            $(".nav-item").removeClass("active");
            if (window.location.href.toLowerCase().indexOf("#portfolio") >= 0) {
                page = 2;
                $(".portfolioLink").append("<span class='sr-only'>(current)</span>");
                $(".portfolioLink").parent().addClass("active");
            } else if (window.location.href.toLowerCase().indexOf("#contact") >= 0) {
                page = 3;
                $(".contactLink").append("<span class='sr-only'>(current)</span>");
                $(".contactLink").parent().addClass("active");
            } else {
                page = 1;
                window.history.replaceState("", "Web Developer Portfolio - Andro Marces", "index.html#landing");
                $(".landingLink").append("<span class='sr-only'>(current)</span>");
                $(".landingLink").parent().addClass("active");
            }
            if (page == 3) {
                contentHeight = (window.innerHeight - ($("footer").outerHeight(true) + ($(".contact").outerHeight(true) - $(".contact").innerHeight())));
            }
            $(".page" + page).css("min-height", contentHeight + "px");
            $(".page" + page).fadeIn(400, function () {
                if (page == 1) {
                    setTimeout(() => {
                        typeWriter();
                    }, 300);
                    $(".landingCard > .pages").css("min-height", contentHeight + "px");
                }
                if (page == 3) {
                    $("footer").slideDown();
                }
                if (page == 1 || 2) {
                    $(".page" + page).find(".leadingLine").show();
                }
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
        });
    }, 1000);

    // on resize, fill whole viewport height
    $(window).resize(function () {
        if (page == 3) {
            contentHeight = (window.innerHeight - ($("footer").outerHeight(true) + ($(".contact").outerHeight(true) - $(".contact").innerHeight())));
        } else {
            contentHeight = (window.innerHeight - ($(".landing").outerHeight(true) - $(".landing").innerHeight()));
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

    // nav-link function


    var bottom = 0;
    var top = 0;
    // detect if user has scrolled to the bottom or top
    $(window).bind("mousewheel DOMMouseScroll", function (event) {
        var origY = $(window).scrollTop();
        if (event.originalEvent.wheelDelta > 0 || event.originalEvent.detail < 0) {
            bottom = 0;
            setTimeout(() => {
                var newY = $(window).scrollTop();
                if (newY == origY) {
                    top = 1;
                } else {
                    top = 0;
                }
            }, 50);
        } else {
            top = 0;
            setTimeout(() => {
                var newY = $(window).scrollTop();
                if (newY == origY) {
                    bottom = 1;
                } else {
                    bottom = 0;
                }
            }, 50);
        }
    });

    // detect mousescroll and change page
    var scrollDetect = 0;
    $(window).bind("mousewheel DOMMouseScroll", function (event) {
        if (scrollDetect == 0 && page > 0) {
            if (event.originalEvent.wheelDelta > 0 || event.originalEvent.detail < 0) {
                if (page > 1 && top == 1) {
                    scrollDetect = 1;
                    $(".sr-only").remove();
                    $(".nav-item").removeClass("active");
                    if (page == 3) {
                        $("footer").slideUp();
                    }
                    if (page == 1 || 2) {
                        $(".page" + page).find(".leadingLine").hide();
                    }
                    $(".page" + page).css("min-height", "0px");
                    $(".page" + page).slideUp(400, "linear");
                    page--;
                    if (page == 1) {
                        window.history.pushState("", "Web Developer Portfolio - Andro Marces", "index.html#landing");
                        $(".landingLink").append("<span class='sr-only'>(current)</span>");
                        $(".landingLink").parent().addClass("active");
                    } else if (page == 2) {
                        window.history.pushState("", "Web Developer Portfolio - Andro Marces", "index.html#portfolio");
                        $(".portfolioLink").append("<span class='sr-only'>(current)</span>");
                        $(".portfolioLink").parent().addClass("active");
                    }
                    $(".page" + page).css({
                        height: 0,
                        minHeight: 0,
                        position: "absolute",
                        bottom: 0,
                        overflow: "hidden",
                        display: "block"
                    });
                    contentHeight = (window.innerHeight - ($(".landing").outerHeight(true) - $(".landing").innerHeight()));
                    $(".page" + page).animate({
                        height: contentHeight + "px"
                    }, 400, "linear", function () {
                        if (page == 1) {
                            i = 0;
                            typeWriter();
                            $(".landingCard > .pages").css("min-height", contentHeight + "px");
                        }
                        if (page == 1 || 2) {
                            $(".page" + page).find(".leadingLine").show();
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
                    $(".sr-only").remove();
                    $(".nav-item").removeClass("active");
                    if (page == 1 || 2) {
                        $(".page" + page).find(".leadingLine").hide();
                    }
                    $(".page" + page).css("min-height", "0px");
                    $(".page" + page).slideUp(400, "linear", function () {
                        if (page == 2) {
                            i = 9999;
                            $("#landingTxt").empty();
                        }
                    });
                    page++;
                    if (page == 2) {
                        window.history.pushState("", "Web Developer Portfolio - Andro Marces", "index.html#portfolio");
                        $(".portfolioLink").append("<span class='sr-only'>(current)</span>");
                        $(".portfolioLink").parent().addClass("active");
                    } else if (page == 3) {
                        window.history.pushState("", "Web Developer Portfolio - Andro Marces", "index.html#contact");
                        $(".contactLink").append("<span class='sr-only'>(current)</span>");
                        $(".contactLink").parent().addClass("active");
                    }
                    $(".page" + page).css({
                        height: 0,
                        minHeight: 0,
                        position: "absolute",
                        bottom: 0,
                        overflow: "hidden",
                        display: "block"
                    });
                    if (page == 3) {
                        contentHeight = (window.innerHeight - ($("footer").outerHeight(true) + ($(".contact").outerHeight(true) - $(".contact").innerHeight())));
                    }
                    $(".page" + page).animate({
                        marginTop: 0,
                        height: contentHeight + "px"
                    }, 400, "linear", function () {
                        if (page == 3) {
                            $("footer").slideDown();
                        }
                        if (page == 1 || 2) {
                            $(".page" + page).find(".leadingLine").show();
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

    // change page when back button is pressed
    window.onhashchange = function () {
        $(".sr-only").remove();
        $(".nav-item").removeClass("active");
        if (page == 3) {
            $("footer").slideUp();
        }
        if (page == 1 || 2) {
            $(".page" + page).find(".leadingLine").hide();
        }
        $(".page" + page).css("min-height", "0px");
        $(".page" + page).slideUp(400, "linear", function () {
            if (page == 2) {
                i = 9999;
                $("#landingTxt").empty();
            }
        });
        if (window.location.href.toLowerCase().indexOf("#portfolio") >= 0) {
            page = 2;
            $(".portfolioLink").append("<span class='sr-only'>(current)</span>");
            $(".portfolioLink").parent().addClass("active");
        } else if (window.location.href.toLowerCase().indexOf("#contact") >= 0) {
            page = 3;
            $(".contactLink").append("<span class='sr-only'>(current)</span>");
            $(".contactLink").parent().addClass("active");
        } else {
            page = 1;
            $(".landingLink").append("<span class='sr-only'>(current)</span>");
            $(".landingLink").parent().addClass("active");
            window.history.replaceState("", "Web Developer Portfolio - Andro Marces", "index.html#landing");
        }
        $(".page" + page).css({
            height: 0,
            minHeight: 0,
            position: "absolute",
            bottom: 0,
            overflow: "hidden",
            display: "block"
        });
        if (page == 3) {
            contentHeight = (window.innerHeight - ($("footer").outerHeight(true) + ($(".contact").outerHeight(true) - $(".contact").innerHeight())));
        } else {
            contentHeight = (window.innerHeight - ($(".landing").outerHeight(true) - $(".landing").innerHeight()));
        }
        $(".page" + page).animate({
            height: contentHeight + "px"
        }, 400, "linear", function () {
            if (page == 1) {
                i = 0;
                typeWriter();
                $(".landingCard > .pages").css("min-height", contentHeight + "px");
            }
            if (page == 3) {
                $("footer").slideDown();
            }
            if (page == 1 || 2) {
                $(".page" + page).find(".leadingLine").show();
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

});