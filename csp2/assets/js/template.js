"use strict" /* strict mode enabled */

// function to close menus when user clicks outside of their container element
function ddbtnclose(event, element, menu, btn) {
    if (!$(event.target).closest(element).length) {
        if ($(menu).css("display") !== "none" && $(menu).has("svg.fa-cog").length == 0) {
            $(menu).fadeOut(350, function () {
                $(btn).attr("aria-expanded", "false");
                $(menu).removeClass("show");
                $(element).removeClass("show");
            });
        }
    }
}

// toggleFade function
function toggleFade(element, menu, btn) {
    if ($(menu).css("display") !== "none" && $(menu).has("svg.fa-cog").length == 0) {
        $(menu).fadeOut(350, function () {
            $(btn).attr("aria-expanded", "false");
            $(menu).removeClass("show");
            $(element).removeClass("show");
        });
    } else {
        $(menu).fadeIn(350, function () {
            $(btn).attr("aria-expanded", "true");
            $(menu).addClass("show");
            $(element).addClass("show");
        });
    }
}

$(function () { /* document ready function */
    
    // enable popovers
    $('[data-toggle="popover"]').popover();
    
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

    // open .ddmenu when mouse hovers on #navbarDropdownMenuLink
    $("#navbarDropdownMenuLink").mouseenter(function () {
        if ($(".ddmenu").css("display") !== "block" && $(".breakpointDiv").css("display") !== "none") {
            $(".ddmenu").fadeIn(350, function () {
                $("#navbarDropdownMenuLink").attr("aria-expanded", "true");
                $(".ddmenu").addClass("show");
                $("#ddp").addClass("show");
            });
        }
    });

    // close .ddmenu when mouse leaves #navBar
    $("#navBar").mouseleave(function () {
        if ($(".ddmenu").css("display") == "block" && $(".breakpointDiv").css("display") !== "none") {
            $(".ddmenu").fadeOut(350, function () {
                $("#navbarDropdownMenuLink").attr("aria-expanded", "false");
                $(".ddmenu").removeClass("show");
                $("#ddp").removeClass("show");
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
                $(".ddmenu").removeClass("show");
                $("#ddp").removeClass("show");
            });
        }
        if ($(".ddsu2").css("display") == "block") {
            $(".ddsu2").fadeOut(350, function () {
                $("#dropdownMenuButton2").attr("aria-expanded", "false");
                $(".ddsu2").removeClass("show");
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

    // login form 2
    $(".ddsu2").on("submit", ".login2", function (e) {
        e.preventDefault();
        var username = $("#DropdownFormUsername2").val();
        var password = $("#DropdownFormPassword2").val();
        $(".ddsu2").fadeOut(350, function () {
            $(".ddsu2").addClass("text-center");
            $(".ddsu2").html("<i class='fas fa-cog fa-spin fa-5x'></i><br><span class='font-weight-bold'>Please wait while you are signed-in.</span>");
            $(".ddsu2").fadeIn(350);
        });
        $.ajax({
            method: "post",
            url: "login_logout_endpoint.php",
            data: {
                username: username,
                password: password,
                login: true
            },
            success: function (data) {
                if (data == 1) {
                    if (window.location.pathname.toLowerCase().indexOf("/products.php") >= 0) {
                        window.location.reload();
                    } else {
                        window.location.href = "products.php?";
                    }
                } else {
                    $(".modal-content").html("<i class='far fa-frown align-self-center fa-5x'></i><span class='modal-text font-weight-bold'>Oh no! Login failed.</span><br><button type='button' class='btn btn-warning align-self-center col-4' data-dismiss='modal'>Dismiss</button>");
                    $(".register-modal-lg").modal("show");
                    $(".ddsu2").fadeOut(350, function () {
                        $(".ddsu2").removeClass("text-center");
                        $(".ddsu2").html("<form class='px-4 py-3 login2'><div class='form-group'><label for='DropdownFormUsername2'>Username</label><input type='text' class='form-control' id='DropdownFormUsername2' placeholder='Username' autocomplete='username'></div><div class='form-group'><label for='DropdownFormPassword2'>Password</label><input type='password' class='form-control' id='DropdownFormPassword2' placeholder='Password' autocomplete='current-password'></div><button type='submit' class='btn btn-success'>Login</button></form><div class='dropdown-divider'></div><a class='dropdown-item loginfooter' href='register.php'>New around here? Sign up</a><a class='dropdown-item loginfooter' href='#'>Forgot password?</a>");
                        $(".ddsu2").fadeIn(350);
                    });
                    if (data.length > 0) {
                        $(".modal-content").fadeOut(350, function () {
                            $(".modal-content").html("<i class='far fa-frown align-self-center fa-5x'></i><span class='modal-text font-weight-bold'>Oh no! An error occurred! Please send us a message or try again.</span><br><button type='button' class='btn btn-warning align-self-center col-4' data-dismiss='modal'>Dismiss</button>");
                            $(".modal-content").fadeIn(350);
                        });
                        $.ajax({
                            method: "post",
                            url: "login_logout_endpoint.php",
                            data: {
                                error: true,
                                data: ".login2, submit:" + data
                            }
                        });
                    }
                }
            },
            error: function (XHR, textStatus, errorThrown) {
                $.ajax({
                    method: "post",
                    url: "login_logout_endpoint.php",
                    data: {
                        error: true,
                        data: ".login2, submit:\r\n" + XHR + "\r\n" + textStatus + "\r\n" + errorThrown
                    }
                });
                $(".modal-content").html("<i class='far fa-frown align-self-center fa-5x'></i><span class='modal-text font-weight-bold'>Oh no! An error occurred! Please send us a message or try again.</span><br><button type='button' class='btn btn-warning align-self-center col-4' data-dismiss='modal'>Dismiss</button>");
                $(".register-modal-lg").modal("show");
            }
        });
    });

    // login form 1
    $(".ddsu1").on("submit", ".login1", function (e) {
        e.preventDefault();
        var username = $("#DropdownFormUsername1").val();
        var password = $("#DropdownFormPassword1").val();
        $(".ddsu1").fadeOut(350, function () {
            $(".ddsu1").addClass("text-center");
            $(".ddsu1").html("<i class='fas fa-cog fa-spin fa-5x'></i><br><span class='font-weight-bold'>Please wait while you are signed-in.</span>");
            $(".ddsu1").fadeIn(350);
        });
        $.ajax({
            method: "post",
            url: "login_logout_endpoint.php",
            data: {
                username: username,
                password: password,
                login: true
            },
            success: function (data) {
                if (data == 1) {
                    if (window.location.pathname.toLowerCase().indexOf("/products.php") >= 0) {
                        window.location.reload();
                    } else {
                        window.location.href = "products.php?";
                    }
                } else {
                    $(".modal-content").html("<i class='far fa-frown align-self-center fa-5x'></i><span class='modal-text font-weight-bold'>Oh no! Login failed.</span><br><button type='button' class='btn btn-warning align-self-center col-4' data-dismiss='modal'>Dismiss</button>");
                    $(".register-modal-lg").modal("show");
                    $(".ddsu1").fadeOut(350, function () {
                        $(".ddsu1").removeClass("text-center");
                        $(".ddsu1").html("<form class='px-4 py-3 login1'><div class='form-group'><label for='DropdownFormUsername1'>Username</label><input type='text' class='form-control' id='DropdownFormUsername1' placeholder='Username' autocomplete='username'></div><div class='form-group'><label for='DropdownFormPassword1'>Password</label><input type='password' class='form-control' id='DropdownFormPassword1' placeholder='Password' autocomplete='current-password'></div><button type='submit' class='btn btn-success'>Login</button></form><div class='dropdown-divider'></div><a class='dropdown-item loginfooter' href='register.php'>New around here? Sign up</a><a class='dropdown-item loginfooter' href='#'>Forgot password?</a>");
                        $(".ddsu1").fadeIn(350);
                    });
                    if (data.length > 0) {
                        $(".modal-content").fadeOut(350, function () {
                            $(".modal-content").html("<i class='far fa-frown align-self-center fa-5x'></i><span class='modal-text font-weight-bold'>Oh no! An error occurred! Please send us a message or try again.</span><br><button type='button' class='btn btn-warning align-self-center col-4' data-dismiss='modal'>Dismiss</button>");
                            $(".modal-content").fadeIn(350);
                        });
                        $.ajax({
                            method: "post",
                            url: "login_logout_endpoint.php",
                            data: {
                                error: true,
                                data: ".login1, submit:" + data
                            }
                        });
                    }
                }
            },
            error: function (XHR, textStatus, errorThrown) {
                $.ajax({
                    method: "post",
                    url: "login_logout_endpoint.php",
                    data: {
                        error: true,
                        data: ".login1, submit:\r\n" + XHR + "\r\n" + textStatus + "\r\n" + errorThrown
                    }
                });
                $(".modal-content").html("<i class='far fa-frown align-self-center fa-5x'></i><span class='modal-text font-weight-bold'>Oh no! An error occurred! Please send us a message or try again.</span><br><button type='button' class='btn btn-warning align-self-center col-4' data-dismiss='modal'>Dismiss</button>");
                $(".register-modal-lg").modal("show");
            }
        });
    });

    // logout
    $(".logOut").click(function () {
        $.ajax({
            method: "get",
            url: "login_logout_endpoint.php",
            data: {
                logout: true
            },
            success: function (data) {
                if (window.location.pathname.toLowerCase().indexOf("/products.php") >= 0) {
                    window.location.reload();
                } else {
                    window.location.href = "products.php?sort=0&cat=0&brand=&minp=0&maxp=&search=&page=1";
                }
            }
        });
    });

    // enter key dismisses small modals
    $(document).keypress(function (e) {
        if (e.which == 13 && $("button[data-dismiss=modal]").text() == "Dismiss") {
            $(".register-modal-lg").modal("hide");
            $(".modal").modal("hide");
        }
    });

    // search function
    $(".searchForm").on("submit", function (e) {
        e.preventDefault();
        search = $(".searchForm input").val();
        if (window.location.pathname.toLowerCase().indexOf("/products.php") >= 0) {
            $("#productParent").fadeOut(350, function () {
                $("#productParent").addClass("text-center");
                $("#productParent").html("<i class='fas fa-cog fa-spin fa-10x m-5'></i>");
            });
            $("#productParent").fadeIn(350);
            $("#brandForm").fadeOut(350, function () {
                $("#brandForm").addClass("text-center");
                $("#brandForm").html("<i class='fas fa-cog fa-spin fa-10x'></i>");
            });
            $("#brandForm").fadeIn(350);
            $("#maxpinput").val("");
            $("#minpinput").attr("max", "");
            $("#minpinput").val("");
            $("#maxpinput").attr("min", 1);
            sort = 0;
            cat = "";
            minp = "";
            maxp = "";
            page = 1;
            brand = "";
            window.history.pushState("", "Pinoyware - Products", "products.php?sort=0&cat=0&brand=&minp=0&maxp=&search=" + search + "&page=1");
            $("#filterParent").find("*").prop("disabled", true);
            $.ajax({
                method: "get",
                url: "products_endpoint.php",
                data: {
                    sort: sort,
                    cat: cat,
                    brand: brand,
                    minp: minp,
                    maxp: maxp,
                    search: search,
                    page: 1,
                    items: true
                },
                success: function (data) {
                    $("#productParent").fadeOut(350, function () {
                        $("#productParent").removeClass("text-center");
                        $("#productParent").html(data);
                    });
                    $("#productParent").fadeIn(350, function () {
                        $("#productParent").closest(".searchTerm").fadeIn(350);
                    });
                }
            });
            $.ajax({
                method: "get",
                url: "products_endpoint.php",
                data: {
                    cat: cat,
                    brand: brand,
                    minp: minp,
                    maxp: maxp,
                    search: search,
                    brands: true
                },
                success: function (data) {
                    $("#brandForm").fadeOut(350, function () {
                        $("#brandForm").removeClass("text-center");
                        $("#brandForm").html(data);
                    });
                    $("#brandForm").fadeIn(350, function () {
                        var filterHeight = $("#filterParent").outerHeight(true);
                        $(".filter").parent().css("min-height", filterHeight + "px");
                    });
                    $("#filterParent").find("*").prop("disabled", false);
                    $("#catForm input").prop("checked", false);
                    $("#catCheck0").prop("checked", true);
                }
            });
        } else {
            window.location.href = "products.php?sort=0&cat=0&brand=&minp=0&maxp=&search=" + search + "&page=1";
        }
    });

    // show or hide .cartMenu
    $("#cartBtn").click(function () {
        $(".cartMenu").slideToggle(350);
    });

    // hide .cartMenu on clicking outside of it
    $(document).click(function () {
        if (!$(event.target).closest(".cartMenu").length && !$(event.target).closest("#cartBtn").length && !$(event.target).closest(".modal").length && !$(event.target).closest(".popover").length) {
            if ($(".cartMenu").css("display") == "block") {
                $(".cartMenu").slideUp(350);
            }
        }
    });

    // display cart item info
    $(".cart-item-info").click(function () {
        var index = $(this).data("index");
        var name = $(this).data("name");
        var price = $(this).data("price");
        var img = $(this).data("img");
        var proc = $(this).data("proc");
        if (proc == "") {} else {
            proc = "<span class='d-inline-block mr-3'><span class='font-weight-bold'>Processor:</span> " + proc + ",</span>";
        }
        var screen = $(this).data("screen");
        if (screen == "") {} else {
            screen = "<span class='d-inline-block mr-3'><span class='font-weight-bold'>Screen:</span> " + screen + ",</span>";
        }
        var ram = $(this).data("ram");
        if (ram == "") {} else {
            ram = "<span class='d-inline-block mr-3'><span class='font-weight-bold'>RAM:</span> " + ram + ",</span>";
        }
        var hdd = $(this).data("hdd");
        if (hdd == "") {} else {
            hdd = "<br><span class='d-inline-block mr-3'><span class='font-weight-bold'>Storage:</span> " + hdd + ",</span>";
        }
        var gpu = $(this).data("gpu");
        if (gpu == "") {} else {
            gpu = "<span class='d-inline-block mr-3'><span class='font-weight-bold'>GPU:</span> " + gpu + ",</span><br>";
        }
        var descript = $(this).siblings(".prodDescript").html();
        descript = "<br><span class='d-inline-block mr-3'><span class='font-weight-bold'>Description:</span><br>" + descript + ",</span>";
        $(".modal-content").html("<div class='card'><img class='card-img-top align-self-center' src='" + img + "' alt='Card image cap'><button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button><div class='card-body'><h5 class='card-title prodTitle'>" + name + "</h5><h5 class='card-title prodPrice'>₱ " + price + "</h5><div class='card-text'>" + proc + screen + ram + hdd + gpu + descript + "</div><br><button type='button' class='btn btn-warning' data-dismiss='modal'>Dismiss</button></div></div>");
        $(".modal").modal("show");
    });

    // cart plus button
    $(".cartMenu").on("click", ".cartAdd", function () {
        var qty = ($(this).parent().siblings(".cartQtyForm").find(".cartQty").data("qty") + 1);
        var index = $(this).data("index");
        $(".cartMenu").find("*").prop("disabled", true);
        $.ajax({
            method: "post",
            url: "products_endpoint.php",
            data: {
                cartid: cartId,
                index: index,
                qty: qty,
                updatecart: true
            },
            success: function (data) {
                $.ajax({
                    method: "get",
                    url: "products_endpoint.php",
                    data: {
                        cartid: cartId,
                        counter: true
                    },
                    success: function (data) {
                        if (data == "") {
                            $(".counterWrapper").empty();
                        } else {
                            $(".counterWrapper").html(data);
                        }
                    }
                });
                $.ajax({
                    method: "get",
                    url: "products_endpoint.php",
                    data: {
                        cartid: cartId,
                        cartmenu: true
                    },
                    success: function (data) {
                        $(".cartMenu").html(data);
                    }
                });
            }
        });
    });

    // cart minus button
    $(".cartMenu").on("click", ".cartMinus", function () {
        var qty = ($(this).parent().siblings(".cartQtyForm").find(".cartQty").data("qty") - 1);
        var index = $(this).data("index");
        $(".cartMenu").find("*").prop("disabled", true);
        $.ajax({
            method: "post",
            url: "products_endpoint.php",
            data: {
                cartid: cartId,
                index: index,
                qty: qty,
                updatecart: true
            },
            success: function (data) {
                $.ajax({
                    method: "get",
                    url: "products_endpoint.php",
                    data: {
                        cartid: cartId,
                        counter: true
                    },
                    success: function (data) {
                        if (data == "") {
                            $(".counterWrapper").empty();
                        } else {
                            $(".counterWrapper").html(data);
                        }
                    }
                });
                $.ajax({
                    method: "get",
                    url: "products_endpoint.php",
                    data: {
                        cartid: cartId,
                        cartmenu: true
                    },
                    success: function (data) {
                        $(".cartMenu").html(data);
                    }
                });
            }
        });
    });

    // cart delete button
    $(".cartMenu").on("click", ".cartDel", function () {
        $(this).popover("show");
    });

    // confirm delete from cart
    $("body").on("click", ".confDel", function () {
        var index = $(this).data("index");
        $(".cartMenu").find("*").prop("disabled", true);
        $.ajax({
            method: "post",
            url: "products_endpoint.php",
            data: {
                cartid: cartId,
                index: index,
                cartdel: true
            },
            success: function (data) {
                console.log(data);
                $.ajax({
                    method: "get",
                    url: "products_endpoint.php",
                    data: {
                        cartid: cartId,
                        counter: true
                    },
                    success: function (data) {
                        if (data == "") {
                            $(".counterWrapper").empty();
                        } else {
                            $(".counterWrapper").html(data);
                        }
                    }
                });
                $.ajax({
                    method: "get",
                    url: "products_endpoint.php",
                    data: {
                        cartid: cartId,
                        cartmenu: true
                    },
                    success: function (data) {
                        $(".cartMenu").html(data);
                    }
                });
            }
        });
    });

    // cart input update form
    $(".cartMenu").on("submit", ".cartQtyForm", function (e) {
        e.preventDefault();
    });

    // cart input update
    $(".cartMenu").on("input", ".cartQty", function () {
        var index = $(this).data("index");
        $(".cartQty").parent().popover("show");
        if ($(this).val() > 100 || $(this).val() < 0) {
            $("body").find(".popover-body").html("<span class='font-weight-bold text-danger'><i class='fas fa-exclamation-triangle'></i>Number must be between 0 - 100.</span>");
        } else if ($(this).val() == 0 || $(this).val() == "") {
            $("body").find(".popover-body").html("<span class='font-weight-bold text-danger pl-2'><i class='fas fa-exclamation-triangle'></i>Delete?</span><br><button data-index='" + index + "' class='btn-danger confDel'>Yes</button><button class='btn-success'>No</button>");
        } else {
            $("body").find(".popover-body").html("<span class='font-weight-bold text-dark'><i class='fas fa-exclamation-triangle'></i>Update?</span><br><button data-index='" + index + "' class='btn-success confUp'>Yes</button><button class='btn-warning'>No</button>");
        }
    });
    
    // cart input focusout
    $(".cartMenu").on("focusout", ".cartQty", function () {
        setTimeout(() => {
            $(this).val($(this).data("qty"));
        }, 500);
    });
    
    // cart qty update
    $("body").on("click", ".confUp", function () {
        var index = $(this).data("index");
        var qty = $("#cartQtyInput" + index).val();
        $(".cartMenu").find("*").prop("disabled", true);
        $.ajax({
            method: "post",
            url: "products_endpoint.php",
            data: {
                cartid: cartId,
                index: index,
                qty: qty,
                updatecart: true
            },
            success: function (data) {
                $.ajax({
                    method: "get",
                    url: "products_endpoint.php",
                    data: {
                        cartid: cartId,
                        counter: true
                    },
                    success: function (data) {
                        if (data == "") {
                            $(".counterWrapper").empty();
                        } else {
                            $(".counterWrapper").html(data);
                        }
                    }
                });
                $.ajax({
                    method: "get",
                    url: "products_endpoint.php",
                    data: {
                        cartid: cartId,
                        cartmenu: true
                    },
                    success: function (data) {
                        $(".cartMenu").html(data);
                    }
                });
            }
        });
    });

    // checkout button
    $(".cartMenu").on("click", "#chkOut", function () {
        window.location.href = "checkout.php";
    });
});