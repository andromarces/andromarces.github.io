$(function () {
    'use strict'

    $('#navbarDropdownMenuLink').click(function () {
        if ($('.ddmenu').css('display') == 'block') {
            $('.ddmenu').addClass("hide");
            setTimeout(() => {
                $('.ddmenu').css('display', 'none');
            }, 360);
        } else {
            $('.ddmenu').removeClass("hide");
            $('.ddmenu').css('display', 'block');
        }
    });

    $(document).click(function (event) {
        if (!$(event.target).closest('#ddp').length) {
            if ($('.ddmenu').css('display') == 'block') {
                console.log("1");
                $('.ddmenu').addClass("hide");
                setTimeout(() => {
                    $('.ddmenu').css('display', 'none');
                }, 360);
            }
        }
    });

    $('#dropdownMenuButton').click(function () {
        if ($('.dropdown-menu-right').css('display') == 'block') {
            $('.dropdown-menu-right').addClass("hide");
            setTimeout(() => {
                $('.dropdown-menu-right').css('display', 'none');
            }, 360);
        } else {
            $('.dropdown-menu-right').removeClass("hide");
            $('.dropdown-menu-right').css('display', 'block');
        }
    });

    $(document).click(function (event) {
        if (!$(event.target).closest('#ddsu').length) {
            if ($('.dropdown-menu-right').css('display') == 'block') {
                $('.dropdown-menu-right').addClass("hide");
                setTimeout(() => {
                    $('.dropdown-menu-right').css('display', 'none');
                }, 360);
                console.log("2");
            }
        }
    });
});