'use strict' /* strict mode enabled */

// 
// 
// global variables
// 
// 
// typewriter function variables
let i = 0; /* initial value of "i" for typewriter effect loop */
const txt = "I'm a full-stack web developer "; /* text for typewriter effect */
const txt1 = "from the Philippines, based in Davao City. Passionate about expanding my knowledge of web development and creating amazing websites. Feel free to take a look at my "; /* text for typewriter effect */
const txt2 = "portfolio! "; /* text for typewriter effect */
const speed = 15; /* typewriter speed, lower is faster */
const element = document.getElementById("landingTxt"); /* element for typewriter effect */
const element1 = document.getElementById("landingTxt1"); /* element for typewriter effect */
const element2 = document.getElementById("landingTxtPort"); /* element for typewriter effect */
// initial page number for page functions
let page = 0; /* 0 = page loader animation, 1 = landing page, 2 = portfolio page, 3 = contact page, 4 onwards = portfolio pages */
// contentHeight to fill viewport
let contentHeight = 0; /* minimum height to fill viewport 100% */
// scroll variables
let bottom = 0; /* 1 = viewport is at page bottom, 0 = not at bottom */
let pageTop = 0; /* 1 = viewport is at page top, 0 = not at top */
let scrollDetect = 0; /* 1 = mousewheel scroll is detected, 0 = not scrolling with mousewheel */


// 
// 
// global functions
// 
// 
// typewriter effect function
function typeWriter(txt, element, callback) {
    if (i < txt.length) {
        element.innerHTML += txt.charAt(i);
        i++;
        if (i == txt.length) {
            if (callback) callback();
            return;
        }
        setTimeout(function () {
            typeWriter(txt, element, callback)
        }, speed);
    }
}
// page down function
function pageDown() {
    if (page > 1 && pageTop == 1) {
        scrollDetect = 1;
        $(".sr-only").remove();
        $(".nav-item").removeClass("active");
        if (page == 3) {
            $("footer").fadeOut();
        }
        if (page == 1 || page == 2) {
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
                typeWriter(txt, element, function () {
                    i = 0;
                    typeWriter(txt1, element1, function () {
                        i = 0;
                        typeWriter(txt2, element2);
                    });
                });
                $(".landingCard > .pages").css("min-height", contentHeight + "px");
            }
            if ($(".breakpointDivLg").css("display") == "block") {
                if (page == 1 || page == 2) {
                    $(".page" + page).find(".leadingLine").show();
                }
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
            pageTop = 0;
            if ($(window).scrollTop() == 0) {
                pageTop = 1;
            }
            setTimeout(() => {
                if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
                    bottom = 1;
                }
            }, 500);
        });
    }
}
// page up function
function pageUp() {
    if (page < 3 && bottom == 1) {
        scrollDetect = 1;
        $(".sr-only").remove();
        $(".nav-item").removeClass("active");
        if (page == 1 || page == 2) {
            $(".page" + page).find(".leadingLine").hide();
        }
        $(".page" + page).css("min-height", "0px");
        $(".page" + page).slideUp(400, "linear", function () {
            if (page == 2) {
                i = 9999;
                $("#landingTxt").empty();
                $("#landingTxt1").empty();
                $("#landingTxtPort").empty();
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
                $("footer").fadeIn();
            }
            if ($(".breakpointDivLg").css("display") == "block") {
                if (page == 1 || page == 2) {
                    $(".page" + page).find(".leadingLine").show();
                }
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
            pageTop = 0;
            if ($(window).scrollTop() == 0) {
                pageTop = 1;
            }
            if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
                bottom = 1;
            }
        });
    }
}

// 
// 
// fadeout page loader and load page depending on hash
// 
// 
$(window).on("load", function () {
    setTimeout(() => {
        $("#loaderPage").fadeOut(function () {
            $(".navbar").fadeIn(400);
            $(".page" + page).fadeIn(400, function () {
                if (page == 1) {
                    setTimeout(() => {
                        typeWriter(txt, element, function () {
                            i = 0;
                            typeWriter(txt1, element1, function () {
                                i = 0;
                                typeWriter(txt2, element2);
                            });
                        });
                    }, 300);
                }
                if (page == 3) {
                    $("footer").fadeIn();
                }
                if ($(".breakpointDivLg").css("display") == "block") {
                    if (page == 1 || page == 2) {
                        $(".page" + page).find(".leadingLine").show();
                    }
                }
                scrollDetect = 0;
                bottom = 0;
                pageTop = 0;
                if ($(window).scrollTop() == 0) {
                    pageTop = 1;
                }
                setTimeout(() => {
                    if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
                        bottom = 1;
                    }
                }, 500);
                $(".sr-only").remove();
                $(".nav-item").removeClass("active");
            });
        });
    }, 1000);
});

// 
// 
// document ready function
// 
// 
$(function () {

    // set page number depending on href
    if (window.location.href.toLowerCase().indexOf("#portfolio") >= 0) {
        page = 2;
        window.history.replaceState("", "Web Developer Portfolio - Andro Marces", "index.html#portfolio");
        $(".portfolioLink").append("<span class='sr-only'>(current)</span>");
        $(".portfolioLink").parent().addClass("active");
    } else if (window.location.href.toLowerCase().indexOf("#contact") >= 0) {
        page = 3;
        window.history.replaceState("", "Web Developer Portfolio - Andro Marces", "index.html#contact");
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
    } else {
        contentHeight = (window.innerHeight - ($(".landing").outerHeight(true) - $(".landing").innerHeight()));
    }
    $(".page" + page).css("min-height", contentHeight + "px");
    if (page == 1) {
        $(".landingCard > .pages").css("min-height", contentHeight + "px");
    }

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
    let hamburgerBusy = 0;
    $(".animated-icon1").click(function () {
        hamburgerBusy = 1;
        $(".navbar").css("pointer-events", "none");
        $(this).toggleClass("open");
        if ($(".navbar").css("width") !== "45px") {
            $(".navbar-toggler").animate({
                "left": "50%",
                "top": "49%"
            }, 400, "linear");
            setTimeout(() => {
                $(".navbar").css("mix-blend-mode", "difference");
            }, 200);
            $(".navbar").animate({
                "width": "45px",
                "border-radius": "50%",
                "height": "42.4px"
            }, 400, function () {
                hamburgerBusy = 0;
                $(".navbar").css("pointer-events", "");
            });
        } else {
            $(".navbar-toggler").css("left", "80%");
            $(".navbar-toggler").css("top", "12%");
            $(".navbar").css("mix-blend-mode", "normal");
            $(".navbar").animate({
                "width": "105px",
                "border-radius": "0.25rem",
                "height": "170px"
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
                    hamburgerBusy = 1;
                    $(".navbar").css("pointer-events", "none");
                    $(".animated-icon1").toggleClass("open");
                    $(".navbar-toggler").animate({
                        "left": "50%",
                        "top": "49%"
                    }, 400, "linear");
                    $(".navbar-toggler").addClass("collapsed");
                    $(".navbar-toggler").attr("aria-expanded", false);
                    $(".navbar-collapse").removeClass("show");
                    setTimeout(() => {
                        $(".navbar").css("mix-blend-mode", "difference");
                    }, 200);
                    $(".navbar").animate({
                        "width": "45px",
                        "border-radius": "50%",
                        "height": "42.4px"
                    }, 400, function () {
                        hamburgerBusy = 0;
                        $(".navbar").css("pointer-events", "");
                    });
                }
            }
        }
    });

    // close hamburger menu after clicking on nav-link
    $(".nav-link").click(function () {
        hamburgerBusy = 1;
        $(".navbar").css("pointer-events", "none");
        $(".animated-icon1").toggleClass("open");
        $(".navbar-toggler").animate({
            "left": "50%",
            "top": "49%"
        }, 400, "linear");
        $(".navbar-toggler").addClass("collapsed");
        $(".navbar-toggler").attr("aria-expanded", false);
        $(".navbar-collapse").removeClass("show");
        setTimeout(() => {
            $(".navbar").css("mix-blend-mode", "difference");
        }, 200);
        $(".navbar").animate({
            "width": "45px",
            "border-radius": "50%",
            "height": "42.4px"
        }, 400, function () {
            hamburgerBusy = 0;
            $(".navbar").css("pointer-events", "");
        });
    });

    // detect if user has scrolled to the bottom or top
    $(window).bind("mousewheel DOMMouseScroll", function (event) {
        let origY = $(window).scrollTop();
        if (event.originalEvent.wheelDelta > 0 || event.originalEvent.detail < 0) {
            bottom = 0;
            setTimeout(() => {
                let newY = $(window).scrollTop();
                if (newY == origY) {
                    pageTop = 1;
                } else {
                    pageTop = 0;
                }
            }, 50);
        } else {
            pageTop = 0;
            setTimeout(() => {
                let newY = $(window).scrollTop();
                if (newY == origY) {
                    bottom = 1;
                } else {
                    bottom = 0;
                }
            }, 50);
        }
    });

    // detect mousescroll and change page
    $(window).bind("mousewheel DOMMouseScroll", function (event) {
        if (scrollDetect == 0 && page > 0 && page < 4) {
            if (event.originalEvent.wheelDelta > 0 || event.originalEvent.detail < 0) {
                pageDown();
            } else {
                pageUp();
            }
        }
    });

    // change page on hash change
    window.onhashchange = function () {
        $(".sr-only").remove();
        $(".nav-item").removeClass("active");
        if (page == 3) {
            $("footer").fadeOut();
        }
        if (page == 1 || 2) {
            $(".page" + page).find(".leadingLine").hide();
        }
        $(".page" + page).css("min-height", "0px");
        $(".page" + page).slideUp(400, "linear", function () {
            if (page !== 1) {
                i = 9999;
                $("#landingTxt").empty();
                $("#landingTxt1").empty();
                $("#landingTxtPort").empty();
            }
        });
        if (window.location.href.toLowerCase().indexOf("#portfolio") >= 0) {
            page = 2;
            $(".portfolioLink").append("<span class='sr-only'>(current)</span>");
            $(".portfolioLink").parent().addClass("active");
            if (window.location.href.toLowerCase().indexOf("#portfolio-purrfectcafe") >= 0) {
                page = 4;
                $(".sr-only").remove();
                $(".nav-item").removeClass("active");
                $(".portfolio1").slideDown();
                return;
            } else if (window.location.href.toLowerCase().indexOf("#portfolio-pinoyware") >= 0) {
                page = 5;
                $(".sr-only").remove();
                $(".nav-item").removeClass("active");
                $(".portfolio2").slideDown();
                return;
            } else if (window.location.href.toLowerCase().indexOf("#portfolio-ganap") >= 0) {
                page = 6;
                $(".sr-only").remove();
                $(".nav-item").removeClass("active");
                $(".portfolio3").slideDown();
                return;
            }
        } else if (window.location.href.toLowerCase().indexOf("#contact") >= 0) {
            page = 3;
            $(".contactLink").append("<span class='sr-only'>(current)</span>");
            $(".contactLink").parent().addClass("active");
            window.history.replaceState("", "Web Developer Portfolio - Andro Marces", "index.html#contact");
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
                typeWriter(txt, element, function () {
                    i = 0;
                    typeWriter(txt1, element1, function () {
                        i = 0;
                        typeWriter(txt2, element2);
                    });
                });
                $(".landingCard > .pages").css("min-height", contentHeight + "px");
            }
            if (page == 3) {
                $("footer").fadeIn();
            }
            if ($(".breakpointDivLg").css("display") == "block") {
                if (page == 1 || page == 2) {
                    $(".page" + page).find(".leadingLine").show();
                }
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
            pageTop = 0;
            if ($(window).scrollTop() == 0) {
                pageTop = 1;
            }
            setTimeout(() => {
                if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
                    bottom = 1;
                }
            }, 500);
        });
    }

    // scroll to top on clicking any link inside the portfolio page
    $(".portfolio").on("click", "a", function () {
        $("html").animate({
            scrollTop: 0
        }, 1000);
    });

});