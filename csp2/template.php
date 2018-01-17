<?php session_start();?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        <?php //display_title();?>
    </title>
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
    <link rel="stylesheet" href="assets/lib/bootstrap.css">
    <script defer src="assets/lib/fontawesome-5.0.4.js"></script>
    <link rel="stylesheet" href="assets/css/template.css">
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-light bg-white pt-1" id="navBar">
        <button class="navbar-toggler" type="button" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="dropdown d-md-none ml-auto mr-1" id="ddsu1">
            <button class="btn btn-light bg-white" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-sign-in-alt"></i> Login
            </button>
            <div class="dropdown-menu dropdown-menu-right ddsu1">
                <form class="px-4 py-3">
                    <div class="form-group">
                        <label for="DropdownFormEmail1">Email Address</label>
                        <input type="email" class="form-control" id="DropdownFormEmail1" placeholder="Email" autocomplete="username email">
                    </div>
                    <div class="form-group">
                        <label for="DropdownFormPassword1">Password</label>
                        <input type="password" class="form-control" id="DropdownFormPassword1" placeholder="Password" autocomplete="current-password">
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="dropdownCheck1">
                        <label class="form-check-label" for="dropdownCheck1">
                            Remember Me
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">New around here? Sign up</a>
                <a class="dropdown-item" href="#">Forgot password?</a>
            </div>
        </div>
        <a class="navbar-brand font-weight-bold mr-0" href="#">
            <img src="/csp2/assets/img/1.png" width="30" height="30" class="d-inline-block align-top" alt="">
            <span class="d-none d-md-inline-block">Pinoyware</span>
        </a>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home
                        <span class="sr-only">(current)</span>
                        <!-- JS IF THIS! -->
                    </a>
                </li>
                <li class="nav-item dropdown" id="ddp">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Products
                    </a>
                    <div class="dropdown-menu ddmenu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">PCs</a>
                        <a class="dropdown-item" href="#">Laptops</a>
                        <a class="dropdown-item" href="#">Accessories</a>
                        <a class="dropdown-item" href="#">All Products</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact Us</a>
                </li>
            </ul>
            <div class="dropdown ml-2 ml-auto" id="ddsu2">
                <button class="btn btn-light bg-white" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
                <div class="dropdown-menu dropdown-menu-right ddsu2">
                    <form class="px-4 py-3">
                        <div class="form-group">
                            <label for="DropdownFormEmail2">Email Address</label>
                            <input type="email" class="form-control" id="DropdownFormEmail2" placeholder="Email" autocomplete="username email">
                        </div>
                        <div class="form-group">
                            <label for="DropdownFormPassword2">Password</label>
                            <input type="password" class="form-control" id="DropdownFormPassword2" placeholder="Password" autocomplete="current-password">
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="dropdownCheck2">
                            <label class="form-check-label" for="dropdownCheck2">
                                Remember Me
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">New around here? Sign up</a>
                    <a class="dropdown-item" href="#">Forgot password?</a>
                </div>
            </div>
        </div>
    </nav>







    <footer class="bg-white text-dark position-relative text-center">
        <a class="footerlink" href="#">&copy; 2018 Andro O. Marces</a>
    </footer>
    <script src="assets/lib/jquery-3.2.1.min.js"></script>
    <script src="assets/lib/popper.min.js"></script>
    <script src="assets/lib/bootstrap.js"></script>
    <script src="assets/js/template.js"></script>
</body>

</html>