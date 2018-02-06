<?php session_start();
require "connection.php";?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        <?php display_title();?>
    </title>

    <!-- imports Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Audiowide|Open+Sans" rel="stylesheet">

    <!-- ****** faviconit.com favicons ****** -->
    <link rel="shortcut icon" href="assets/img/favicon/Pinoyware.ico">
    <link rel="icon" sizes="16x16 32x32 64x64" href="assets/img/favicon/Pinoyware.ico">
    <link rel="icon" type="image/png" sizes="196x196" href="assets/img/favicon/Pinoyware-192.png">
    <link rel="icon" type="image/png" sizes="160x160" href="assets/img/favicon/Pinoyware-160.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon/Pinoyware-96.png">
    <link rel="icon" type="image/png" sizes="64x64" href="assets/img/favicon/Pinoyware-64.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon/Pinoyware-32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon/Pinoyware-16.png">
    <link rel="apple-touch-icon" href="assets/img/favicon/Pinoyware-57.png">
    <link rel="apple-touch-icon" sizes="114x114" href="assets/img/favicon/Pinoyware-114.png">
    <link rel="apple-touch-icon" sizes="72x72" href="assets/img/favicon/Pinoyware-72.png">
    <link rel="apple-touch-icon" sizes="144x144" href="assets/img/favicon/Pinoyware-144.png">
    <link rel="apple-touch-icon" sizes="60x60" href="assets/img/favicon/Pinoyware-60.png">
    <link rel="apple-touch-icon" sizes="120x120" href="assets/img/favicon/Pinoyware-120.png">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/favicon/Pinoyware-76.png">
    <link rel="apple-touch-icon" sizes="152x152" href="assets/img/favicon/Pinoyware-152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicon/Pinoyware-180.png">
    <meta name="msapplication-TileColor" content="#FFFFFF">
    <meta name="msapplication-TileImage" content="assets/img/favicon/Pinoyware-144.png">
    <meta name="msapplication-config" content="assets/img/favicon/browserconfig.xml">
    <!-- ****** faviconit.com favicons ****** -->

    <!-- imports Bootstrap 4.0.0 css -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- imports FontAwesome 5.0.6 js -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>

    <!-- imports template.css -->
    <link rel="stylesheet" href="assets/css/template.css">

    <!-- imports page css -->
    <?php display_css();?>
</head>

<body>
    <!-- #navBar / top navbar -->
    <nav class="navbar navbar-expand-md navbar-light bg-white pt-1 pb-0 px-1 px-md-3" id="navBar">
        <!-- .navbar-toggler dropdown button when top navbar collapses -->
        <button class="navbar-toggler" id="navbarTgl" type="button" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- .navbar-brand -->
        <a class="navbar-brand font-weight-bold mr-0" href="#">
            <img src="assets/img/1.png" width="30" height="30" class="d-inline-block imgbrand align-top" alt="">
            <span>Pinoyware</span>
        </a>

        <!-- #ddsu1 / dropdown for login/sign-up 1 (ddsu1) -->
        <div class="dropdown d-md-none" id="ddsu1">
            <?php if (isset($_SESSION["username"]) && isset($_SESSION["role"])) {
    if ($_SESSION["role"] == "staff") {?>
            <!-- #logOut1 -->
            <button class="btn btn-outline-dark logOut" type="button" id="logOut1">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
            <?php } else {?>
            <!-- #dropdownMenuButton1 / user menu .ddsu1 -->
            <button class="btn btn-outline-dark p-0 border-0" type="button" id="dropdownMenuButton1">
                <i class="far fa-user-circle fa-2x"></i>
            </button>
            <!-- .ddsu1 / dropdown user menu 1 -->
            <div class="dropdown-menu dropdown-menu-right text-center ddsu1">
                <span class="d-block d-md-none">Hello
                    <?php echo $_SESSION["username"]; ?>!</span>
                <div class="d-block d-md-none dropdown-divider"></div>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-wrench"></i> Edit Profile</a>
                <div class="dropdown-divider"></div>
                <button class="btn btn-outline-dark logOut" type="button" id="logOut1">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </div>
            <!-- /.ddsu1 -->
            <?php }} else {?>
            <!-- #dropdownMenuButton1 / dropdown button for login1 .ddsu1 -->
            <button class="btn btn-outline-dark px-1" type="button" id="dropdownMenuButton1" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-sign-in-alt"></i> Login
            </button>
            <!-- .ddsu1 / dropdown menu login/sign-up 1 -->
            <div class="dropdown-menu dropdown-menu-right ddsu1">
                <form class="px-4 py-3 login1">
                    <div class="form-group">
                        <label for="DropdownFormUsername1">Username</label>
                        <input type="text" class="form-control" id="DropdownFormUsername1" placeholder="Username" autocomplete="username">
                    </div>
                    <div class="form-group">
                        <label for="DropdownFormPassword1">Password</label>
                        <input type="password" class="form-control" id="DropdownFormPassword1" placeholder="Password" autocomplete="current-password">
                    </div>
                    <button type="submit" class="btn btn-success">Login</button>
                </form>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item loginfooter" href="register.php">New around here? Sign up</a>
            </div>
            <!-- /.ddsu1 -->
            <?php }?>
        </div>
        <!-- /#ddsu1 -->

        <!-- #navbarNavDropdown / dropdown menu when top navbar collapses -->
        <div class="collapse navbar-collapse px-2 px-md-0" id="navbarNavDropdown">
            <!-- .navbar-nav / contains links for Home, Products, About, Contact Us -->
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="home.php">Home
                    </a>
                </li>
                <!-- #ddp / dropdown for Products -->
                <li class="nav-item active dropdown" id="ddp">
                    <!-- #navbarDropdownMenuLink / dropdown button for .ddmenu -->
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" aria-haspopup="true" aria-expanded="false">
                        Products
                    </a>
                    <!-- .ddmenu / dropdown menu for Products -->
                    <div class="dropdown-menu ddmenu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="products.php?cat=2">Desktops</a>
                        <a class="dropdown-item" href="products.php?cat=1">Laptops</a>
                        <a class="dropdown-item" href="products.php?cat=4">Monitors</a>
                        <a class="dropdown-item" href="products.php?cat=3">Headphones</a>
                        <a class="dropdown-item" href="products.php?">All Products</a>
                    </div>
                    <!-- /.ddmenu -->
                </li>
                <?php if (!isset($_SESSION["username"])) {?>
                <li class="nav-item active">
                    <a class="nav-link" href="register.php">Register</a>
                </li>
                <?php }
                if (isset($_SESSION["username"])) {
                    if ($_SESSION["role"] == "staff") {?>
                <li class="nav-item active">
                    <a class="nav-link" href="admin.php">Admin</a>
                </li>
                    <?php }} ?>
            </ul>
            <!-- /.navbar-nav -->

            <div class="dropdown-divider"></div>

            <!-- #ddsu2 / dropdown login/sign-up 2 (ddsu2) -->
            <div class="dropdown ml-md-auto mb-1 mb-md-0" id="ddsu2">
                <?php if (isset($_SESSION["username"]) && isset($_SESSION["role"])) {
    if ($_SESSION["role"] == "staff") {?>
                <!-- #logOut2 -->
                <button class="btn btn-outline-dark logOut" type="button" id="logOut2">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
                <?php } else {?>
                <!-- #.dropdownMenuButton2 / dropdown button for user menu 2 .ddsu2 -->
                <button class="btn btn-outline-dark border-0 px-1 px-md-1 mr-2 d-none d-md-inline-flex align-items-center" type="button"
                    id="dropdownMenuButton2" aria-haspopup="true" aria-expanded="false">
                    <span class="">Hello
                        <?php echo $_SESSION["username"]; ?>! </span>
                    <i class="ml-1 far fa-user-circle"></i>
                </button>
                <!-- .ddsu2 / dropdown user menu 2 -->
                <div class="dropdown-menu dropdown-menu-left ddsu2">
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-wrench"></i> Edit Profile</a>
                </div>
                <!-- /.ddsu2 -->
                <!-- #logOut2 -->
                <button class="btn btn-outline-dark logOut" type="button" id="logOut2">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
                <?php }} else {?>
                <!-- #.dropdownMenuButton2 / dropdown button for login2 .ddsu2 -->
                <button class="btn btn-outline-dark px-1 px-md-3" type="button" id="dropdownMenuButton2" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
                <!-- .ddsu2 / dropdown menu login/sign-up 2 -->
                <div class="dropdown-menu dropdown-menu-right ddsu2">
                    <form class="px-4 py-3 login2">
                        <div class="form-group">
                            <label for="DropdownFormUsername2">Username</label>
                            <input type="text" class="form-control" id="DropdownFormUsername2" placeholder="Username" autocomplete="username">
                        </div>
                        <div class="form-group">
                            <label for="DropdownFormPassword2">Password</label>
                            <input type="password" class="form-control" id="DropdownFormPassword2" placeholder="Password" autocomplete="current-password">
                        </div>
                        <button type="submit" class="btn btn-success">Login</button>
                    </form>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item loginfooter" href="register.php">New around here? Sign up</a>
                </div>
                <!-- /.ddsu2 -->
                <?php }?>
            </div>
            <!-- /#ddsu2 -->
        </div>
        <!-- /#navbarNavDropdown -->
    </nav>
    <!-- /#navBar // top navbar -->

    <!-- .nav / bottom nav -->
    <nav class="nav mt-1 mb-2 mb-md-1 justify-content-end px-1 px-md-3">
        <!-- bottom nav content -->
        <?php display_bottom_nav();
if (isset($_SESSION["username"]) && isset($_SESSION["role"])) {
    if ($_SESSION["role"] == "user" && strpos($_SERVER["PHP_SELF"], "checkout.php") == false) {?>
        <!-- cart button -->
        <div class="cartParent d-flex col col-md-6 col-lg-5 col-xl-3 justify-content-end px-0">
            <button type="button" class="nav-item btn btn-outline-dark px-3 px-md-auto mr-0" id="cartBtn">
                <span class="fa-layers fa-fw">
                    <i class="fas fa-shopping-cart fa-lg" data-fa-transform="grow-4 left-2"></i>
                    <div class="counterWrapper">
                        <?php $cart_id = $_SESSION["cart_id"];
        $sql = "SELECT p.product_id 'product_id', p.name 'name', p.price 'price', p.image 'image', p.processor 'processor', p.screen_size 'screen_size', p.ram 'ram', p.hdd 'hdd', p.gpu 'gpu', p.item_description 'item_description', ci.quantity 'quantity', ci.creation_date 'creation_date' FROM products p, cart_items ci, cart c WHERE p.product_id = ci.item_id AND ci.cart_id = '$cart_id' AND c.cart_status_id = 3 GROUP BY product_id ORDER BY creation_date";
        $result = mysqli_query($conn, $sql);
        $totalq = 0;
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                extract($row);
                $totalq += $quantity;
            }?>
                        <span class="fa-layers-counter">
                            <?php echo $totalq; ?>
                        </span>
                        <?php }?>
                    </div>
                </span>
                <span class="pl-2 d-none d-md-inline-block"> Cart</span>
            </button>
            <div class="cartMenu p-0 col-11 col-md-12 mr-1 mr-md-0 border border-dark rounded text-center">
                <?php mysqli_data_seek($result, 0);
        $grandtotal = 0;
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                extract($row);
                $str = nl2br($item_description);
                $hdd = str_replace("00", "", $hdd);
                $grandtotal += ($price * $quantity)?>
                <div class="media rounded border-dark m-1 media-cart">
                    <img class="align-self-center mr-2 scale-img-cart" src="<?php echo $image; ?>" alt="<?php echo $name; ?>">
                    <div class="media-body text-left">
                        <h6 class="mt-0 font-weight-bold pb-0 mb-0 cartTitle">
                            <?php echo $name; ?>
                        </h6>
                        <span class="pb-0 mb-0 d-inline-block mr-auto">
                            <small class="font-weight-bold itemPriceCart">
                                ₱ <?php echo number_format($price, 2, ".", ","); ?>
                            </small>
                        </span>
                        <button class="cart-item-info" data-index="<?php echo $product_id; ?>" data-name="<?php echo $name; ?>" data-price="<?php echo number_format($price, 2, ".", ","); ?>" data-img="<?php echo $image; ?>" data-proc="<?php echo $processor; ?>" data-screen="<?php if ($screen_size == "
                            ") {} else {echo $screen_size . " in. ";}?>" data-ram="<?php if ($ram == " ") {} else {echo $ram . "GB ";}?>" data-hdd="<?php echo $hdd; ?>"
                            data-gpu="<?php echo $gpu; ?>">
                            <i class="fas fa-info-circle"></i>
                        </button>
                        <p class="d-none prodDescript" id="descript<?php echo $product_id; ?>">
                            <?php echo $str; ?>
                        </p>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text px-1 font-weight-bold">Qty</span>
                                <button class="btn btn-danger cartMinus" data-index="<?php echo $product_id; ?>" type="button" <?php if ($quantity == 1) {echo "disabled"; } ?>>
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <form class="p-0 m-0 border-0 cartQtyForm">
                            <a tabindex="0" class="m-0 p-0 border-0" role="button" data-trigger="focus" data-animation="true" data-html="true" data-placement="top" data-content="<span class='font-weight-bold text-dark'><i class='fas fa-exclamation-triangle'></i>Update?</span><br><button data-index='<?php echo $product_id; ?>' class='btn-success confUp'>Yes</button><button class='btn-warning'>No</button>">
                                <input type="number" class="cartQty" data-index="<?php echo $product_id; ?>" min=0 aria-label="Quantity" value=<?php echo $quantity; ?> data-qty=
                                <?php echo $quantity; ?> max=100 id="cartQtyInput<?php echo $product_id; ?>">
                            </a>
                            </form>
                            <div class="input-group-append">
                                <button class="btn btn-success cartAdd" data-index="<?php echo $product_id; ?>" type="button">
                                    <i class="fas fa-plus"></i>
                                </button>
                                <a tabindex="0" class="btn btn-danger rounded-right cartDel" role="button" data-toggle="popover" data-animation="true" data-html="true" data-trigger="focus" data-placement="top" data-content="<span class='font-weight-bold text-danger pl-2'><i class='fas fa-exclamation-triangle'></i>Delete?</span><br><button data-index='<?php echo $product_id; ?>' class='btn-danger confDel'>Yes</button><button class='btn-success'>No</button>"><i class="far fa-times-circle" data-fa-transform="grow-4"></i></a>
                            </div>
                            <div class="ml-auto row pr-4">
                                <p class="font-weight-bold mr-1 mb-0">Subtotal:</p>
                                <p class="font-weight-bold subtotalTxt ml-auto mb-0">₱ <?php echo number_format(($price * $quantity), 2, ".", ","); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php }?>
                <div class="font-weight-bold text-right cartGrandTotal rounded mx-1 mb-1 pr-2">Grandtotal: ₱ <?php echo number_format(($grandtotal), 2, ".", ","); ?> </div>
                    <button type="button" class="btn btn-success mb-1" id="chkOut"><i class="far fa-credit-card"></i> Checkout</button>
                <?php } else {?>
                <span class="font-weight-bold"><i class='far fa-frown'></i> Your cart is empty.</span>
                <?php }?>
            </div>
        </div>
        <?php }
}?>

        <!-- search form -->
        <div class="nav-item col-auto px-0 searchWrapper">
            <button type="button" class="btn btn-outline-dark d-md-none px-3" id="searchtgl">
                <i class="fas fa-search"></i>
            </button>
            <form class="form-inline justify-content-end searchForm rounded">
                <input class="form-control col-8 col-sm-9 col-md-7 col-lg-7" name="search" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-dark col-3 col-sm-2 col-md-4 col-lg-4 searchBtn" type="submit">
                    <i class="fas fa-search d-inline-block d-md-none"></i>
                    <span class="d-none d-md-inline-block">Search
                        <span>
                </button>
            </form>
        </div>
    </nav>
    <!-- /.nav // bottom nav -->

    <!-- .container -->
    <div class="container mx-auto">
        <!-- main content -->
        <?php display_content();?>
    </div>
    <!-- /.container -->

    <!-- footer -->
    <footer class="text-dark position-relative text-center mt-5">
        <a class="footerlink" href="#">&copy; 2018 Andro O. Marces</a>
    </footer>

    <!-- modal -->
    <div class="modal fade register-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 text-center"></div>
        </div>
    </div>

    <!-- div that is referred by JS/JQuery for breakpoints -->
    <div class="d-none d-md-inline-block position-absolute breakpointDiv"></div>

    <!-- imports JQuery 3.3.1 js -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

    <!-- imports Popper 1.12.9 js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    
    <!-- imports Bootstrap 4.0.0 js -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- imports template.js -->
    <script src="assets/js/template.js"></script>

    <!-- defines user and cart id for js -->
    <script>
        var user = <?php if (isset($_SESSION["role"])) {
            if ($_SESSION["role"] == "user") {
                echo 1;
            } else {
                echo 2;
            }
        } else {
            echo 0;
        } ?>;
        var cartId = <?php if (isset($_SESSION["cart_id"])) {
            echo $_SESSION["cart_id"];
        } else {
            echo "\"\"";
        } ?>;
        var userId = <?php if (isset($_SESSION["user_id"])) {
            echo $_SESSION["user_id"];
        } else {
            echo "\"\"";
        } ?>;
    </script>

    <!-- imports page js -->
    <?php display_js();?>
</body>

</html>