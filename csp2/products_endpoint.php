<?php
session_start();
require "connection.php";

// in haystack function
function in_haystack($needle, $haystack, $strict = false)
{
    foreach ($haystack as $item) {
        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_cart($needle, $item, $strict))) {
            return true;
        }
    }
    return false;
}

// generate products section
if (isset($_GET["items"])) {
    if (isset($_GET["sort"])) {
        if ($_GET["sort"] == "" || $_GET["sort"] == "0") {
            $sort = 0;
        } else {
            $sort = intval(mysqli_real_escape_string($conn, $_GET["sort"]));
        }} else {
        $sort = 0;
    }
    if (isset($_GET["cat"])) {
        if ($_GET["cat"] == "" || $_GET["cat"] == "0") {
            $cat = 0;
        } else {
            $cat = mysqli_real_escape_string($conn, $_GET["cat"]);
        }
    } else {
        $cat = 0;
    }
    if (isset($_GET["brand"])) {
        if ($_GET["brand"] == "" || $_GET["brand"] == "0") {
            $brand = 0;
        } else {
            $brand = mysqli_real_escape_string($conn, $_GET["brand"]);
        }} else {
        $brand = 0;
    }
    if (isset($_GET["minp"])) {
        if ($_GET["minp"] == "" || $_GET["minp"] == "0") {
            $minp = 0;
        } else {
            $minp = intval(mysqli_real_escape_string($conn, $_GET["minp"]));
            $btnminp = $minp;
        }} else {
        $minp = 0;
    }
    if (isset($_GET["maxp"])) {
        if ($_GET["maxp"] == "" || $_GET["maxp"] == "0") {
            $maxp = 0;
            $btnmaxp = 0;
        } else {
            $maxp = intval(mysqli_real_escape_string($conn, $_GET["maxp"]));
            $btnmaxp = $maxp;
        }} else {
        $maxp = 0;
        $btnmaxp = 0;
    }
    if (isset($_GET["search"])) {
        if ($_GET["search"] == "") {
            $search = "";
        } else {
            $search = mysqli_real_escape_string($conn, $_GET["search"]);
            $btnsearch = $search;
        }} else {
        $search = "";
    }
    if (isset($_GET["page"])) {
        if ($_GET["page"] == "" || $_GET["page"] == "0") {
            $page = 1;
        } else {
            $page = intval(mysqli_real_escape_string($conn, $_GET["page"]));
        }} else {
        $page = 1;
    }
    unset($_GET);
    if ($sort == 1) {
        $sort = ",name DESC";
    } else if ($sort == 2) {
        $sort = ",price";
    } else if ($sort == 3) {
        $sort = ",price DESC";
    } else {
        $sort = ",name";
    }
    if ($cat == 0) {
        $cat = "";
    } else {
        $cat = "AND category_id IN ($cat)";
    }
    if ($brand == 0) {
        $brand = "";
    } else {
        $brand = "AND brand_id IN ($brand)";
    }
    if ($minp == 0) {
        $minp = "WHERE price > 0";
    } else {
        $minp = "WHERE price > $minp";
    }
    if ($maxp == 0 || $maxp <= $minp) {
        $maxp = "";
    } else {
        $maxp = "AND price < $maxp";
    }
    if ($search !== "") {
        $search = "AND (name LIKE '%$search%' OR processor LIKE '%$search%' OR screen_size LIKE '%$search%' OR ram LIKE '%$search%' OR hdd LIKE '%$search%' OR gpu LIKE '%$search%' OR item_description LIKE '%$search%')";
    }
    $offset = (($page * 10) - 10);
    $sql = "SELECT product_id, name, price, image, processor, screen_size, ram, hdd, gpu, item_description, priority_id, category_id FROM products $minp $maxp $brand $cat $search ORDER BY priority_id DESC$sort LIMIT $offset, 18446744073709551615";
    $result = mysqli_query($conn, $sql);
    $rowcount = mysqli_num_rows($result);
    $pages = ceil(($rowcount + (($page - 1) * 10)) / 10);?>
    <script>
        var maxpage = parseInt(<?php echo $pages; ?>);
    </script>
    <?php $pagenos = 1;?>
    <nav>
        <ul class="pagination mb-1 d-inline-flex">
            <li class="page-item">
                <a class="page-link pagitext border-dark" href="#">
                    <span class="d-block d-md-none" aria-hidden="true">&laquo;</span>
                    <span class="d-none d-md-block">Previous</span>
                </a>
            </li>
            <?php while ($pagenos <= $pages) {
        if ($pagenos == $page) {?>
            <li class="page-item active page<?php echo $pagenos; ?>">
                <a class="page-link pagitext border-dark" href="#">
                    <?php echo $pagenos; ?>
                </a>
            </li>
            <?php } else {?>
            <li class="page-item page<?php echo $pagenos; ?>">
                <a class="page-link pagitext border-dark" href="#">
                    <?php echo $pagenos; ?>
                </a>
            </li>
            <?php }
        $pagenos++;}?>
            <li class="page-item">
                <a class="page-link pagitext border-dark" href="#">
                    <span class="d-none d-md-block">Next</span>
                    <span class="d-block d-md-none" aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
        <span class="ml-3 font-weight-bold d-inline-block">(
            <?php echo ($rowcount + (($page - 1) * 10)); ?> result<?php if (($rowcount + (($page - 1) * 10)) > 1) {echo "s";}?>.)</span>
        <?php if ($search !== "") {?>
        <button type="button" class="ml-1 btn btn-outline-danger searchTerm">
            <i class="fas fa-times-circle"></i>
            <?php echo $btnsearch; ?>
        </button>
        <?php }
    if ($minp == "WHERE price > 0") {} else {?>
        <button type="button" class="ml-1 btn btn-outline-danger clearMinp">
            <i class="fas fa-times-circle"></i>
            <?php echo $btnminp; ?>
        </button>
        <?php }
    if ($btnmaxp == "" || $btnmaxp == 0) {} else {?>
        <button type="button" class="ml-1 btn btn-outline-danger clearMaxp">
            <i class="fas fa-times-circle"></i>
            <?php echo $btnmaxp; ?>
        </button>
        <?php }?>
    </nav>
    <div class="row no-gutters">
        <?php if ((($rowcount + (($page - 1) * 10)) - (($page - 1) * 10) < 10)) {
        $remitems = (($rowcount + (($page - 1) * 10)) - (($page - 1) * 10));
    } else {
        $remitems = 10;
    }
    $itemnos = 0;
    while ($itemnos < $remitems) {
        $row = mysqli_fetch_assoc($result);
        extract($row);
        $str = nl2br($item_description);
        $hdd = str_replace("00", "", $hdd);?>
        <a href="#" class="col-12 col-lg-6 productCard mb-1" id="product<?php echo $product_id; ?>" data-index="<?php echo $product_id; ?>"
            data-name="<?php echo $name; ?>" data-price="<?php echo $price ?>" data-img="<?php echo $image; ?>" data-proc="<?php echo $processor; ?>"
            data-screen="<?php echo $screen_size; ?>" data-ram="<?php echo $ram; ?>" data-hdd="<?php echo $hdd; ?>" data-gpu="<?php echo $gpu; ?>">
            <div class="media rounded mr-1">
                <img class="align-self-center mr-2 scale-img" src="<?php echo $image; ?>" alt="<?php echo $name; ?>">
                <div class="media-body">
                    <h6 class="mt-0 font-weight-bold pb-0 mb-0">
                        <?php echo $name; ?>
                    </h6>
                    <p class="pb-0 mb-0">
                        <small class="font-weight-bold itemPrice">
                            ₱ <?php echo number_format($price, 2, ".", ","); ?>
                        </small>
                    </p>
                    <?php if ($processor == "") {} else {?>
                    <small class="d-none d-md-inline-block">
                        <span class="font-weight-bold">Processor:</span>
                        <?php echo substr($processor, 0, stripos($processor, "-")); ?>,
                    </small>
                    <?php }
        if ($screen_size == "") {} else {?>
                    <small class="d-none d-md-inline-block">
                        <span class="font-weight-bold">Screen Size:</span>
                        <?php echo $screen_size; ?>",
                    </small>
                    <?php }
        if ($ram == "") {} else {?>
                    <small class="d-none d-md-inline-block">
                        <span class="font-weight-bold">RAM:</span>
                        <?php echo $ram; ?>GB,
                    </small>
                    <?php }
        if ($hdd == "") {} else {?>
                    <small class="d-none d-md-inline-block">
                        <span class="font-weight-bold">Storage:</span>
                        <?php echo $hdd; ?>,
                    </small>
                    <?php }
        if ($gpu == "") {} else {?>
                    <small class="d-none d-md-inline-block">
                        <span class="font-weight-bold">GPU:</span>
                        <?php echo $gpu; ?>
                    </small>
                    <?php }?>
                    <p class="d-none prodDescript" id="descript<?php echo $product_id; ?>">
                        <?php echo $str; ?>
                    </p>
                </div>
            </div>
        </a>
        <?php $itemnos++;}
}

// generate brands section
if (isset($_GET["brands"])) {
    if (isset($_GET["cat"])) {
        if ($_GET["cat"] == "" || $_GET["cat"] == "0") {
            $cat = 0;
        } else {
            $cat = mysqli_real_escape_string($conn, $_GET["cat"]);
        }
    } else {
        $cat = 0;
    }
    if (isset($_GET["minp"])) {
        if ($_GET["minp"] == "" || $_GET["minp"] == "0") {
            $minp = 0;
        } else {
            $minp = intval(mysqli_real_escape_string($conn, $_GET["minp"]));
        }} else {
        $minp = 0;
    }
    if (isset($_GET["maxp"])) {
        if ($_GET["maxp"] == "" || $_GET["maxp"] == "0") {
            $maxp = 0;
        } else {
            $maxp = intval(mysqli_real_escape_string($conn, $_GET["maxp"]));
        }} else {
        $maxp = 0;
    }
    if (isset($_GET["search"])) {
        if ($_GET["search"] == "") {
            $search = "";
        } else {
            $search = mysqli_real_escape_string($conn, $_GET["search"]);
        }} else {
        $search = "";
    }
    if ($minp == 0 || $maxp <= $minp) {
        $minp = "WHERE price > 0";
    } else {
        $minp = "WHERE price > $minp";
    }
    if ($maxp == 0 || $maxp <= $minp) {
        $maxp = "";
    } else {
        $maxp = "AND price < $maxp";
    }
    if ($search !== "") {
        $search = "AND (name LIKE '%$search%' OR processor LIKE '%$search%' OR screen_size LIKE '%$search%' OR ram LIKE '%$search%' OR hdd LIKE '%$search%' OR gpu LIKE '%$search%' OR item_description LIKE '%$search%')";
    }
    if ($cat == 0) {
        $cat = "";
    } else {
        $cat = "AND category_id IN ($cat)";
    }
    $sql = "SELECT brand_id,brand_name FROM brands WHERE brand_id IN (SELECT brand_id FROM products $minp $cat $maxp $search) GROUP BY brand_id";
    $result = mysqli_query($conn, $sql);
    if (isset($_GET["brand"])) {
        if ($_GET["brand"] == "" || $_GET["brand"] == "0") {
            $brand = 0;
        } else {
            $brand = mysqli_real_escape_string($conn, $_GET["brand"]);
        }} else {
        $brand = 0;
    }
    unset($_GET);
    $brandstack = explode(",", $brand);
    while ($row = mysqli_fetch_assoc($result)) {
        extract($row);
        if (in_haystack($brand_id, $brandstack)) {?>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="<?php echo $brand_id; ?>" id="brandCheck<?php echo $brand_id; ?>"
                checked>
            <label class="form-check-label" for="brandCheck<?php echo $brand_id; ?>">
                <?php echo $brand_name; ?>
            </label>
        </div>
        <?php } else {?>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="<?php echo $brand_id; ?>" id="brandCheck<?php echo $brand_id; ?>">
            <label class="form-check-label" for="brandCheck<?php echo $brand_id; ?>">
                <?php echo $brand_name; ?>
            </label>
        </div>
        <?php }}
}

// add to cart
if (isset($_POST["addtocart"])) {
    $index = mysqli_real_escape_string($conn, $_POST["index"]);
    $cart_id = mysqli_real_escape_string($conn, $_POST["cartid"]);
    unset($_POST);

    $sql = "SELECT item_id, quantity FROM cart_items WHERE item_id = '$index' AND cart_id = '$cart_id'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            extract($row);
        }
        $qty = ($quantity + 1);

        $sql = "UPDATE cart_items SET quantity = '$qty' WHERE cart_items.item_id = '$index' AND cart_items.cart_id = '$cart_id'";

        $result = mysqli_query($conn, $sql);

    } else {
        $sql = "INSERT INTO cart_items (item_id, quantity, cart_id) VALUES ('$index', 1, '$cart_id')";

        $result = mysqli_query($conn, $sql);
    }
}

// generate qty cart counter
if (isset($_GET["counter"])) {
    $cart_id = mysqli_real_escape_string($conn, $_GET["cartid"]);
    unset($_GET);

    $sql = "SELECT p.product_id 'product_id', ci.quantity 'quantity' FROM products p, cart_items ci, cart c WHERE p.product_id = ci.item_id AND ci.cart_id = '$cart_id' AND c.cart_status_id = 3 GROUP BY product_id";

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
        <?php } else {
        echo "";
    }
}

// generate cart menu
if (isset($_GET["cartmenu"])) {
    $cart_id = mysqli_real_escape_string($conn, $_GET["cartid"]);
    unset($_GET);

    $sql = "SELECT p.product_id 'product_id', p.name 'name', p.price 'price', p.image 'image', p.processor 'processor', p.screen_size 'screen_size', p.ram 'ram', p.hdd 'hdd', p.gpu 'gpu', p.item_description 'item_description', ci.quantity 'quantity', ci.creation_date 'creation_date' FROM products p, cart_items ci, cart c WHERE p.product_id = ci.item_id AND ci.cart_id = '$cart_id' AND c.cart_status_id = 3 GROUP BY product_id ORDER BY creation_date";

    $result = mysqli_query($conn, $sql);

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
        <?php }}

// cart qty update
if (isset($_POST["updatecart"])) {
    $index = mysqli_real_escape_string($conn, $_POST["index"]);
    $cart_id = mysqli_real_escape_string($conn, $_POST["cartid"]);
    $qty = mysqli_real_escape_string($conn, $_POST["qty"]);

    unset($_POST);

    $sql = "UPDATE cart_items SET quantity = '$qty' WHERE cart_items.item_id = '$index' AND cart_items.cart_id = '$cart_id'";

    $result = mysqli_query($conn, $sql);
}

// cart delete
if (isset($_POST["cartdel"])) {
    $index = mysqli_real_escape_string($conn, $_POST["index"]);
    $cart_id = mysqli_real_escape_string($conn, $_POST["cartid"]);
    
    unset($_POST);
    
    $sql = "DELETE FROM cart_items WHERE cart_items.item_id = '$index' AND cart_items.cart_id = '$cart_id'";
    
    $result = mysqli_query($conn, $sql);
}

// checkout
if (isset($_POST["checkout"])) {
    $cart_id = mysqli_real_escape_string($conn, $_POST["cartid"]);
    $user_id = mysqli_real_escape_string($conn, $_POST["userid"]);

    unset($_POST);
    
    $sql = "SELECT MAX(order_id) 'order_id' FROM orders";
    
    $result = mysqli_query($conn, $sql);
    
    $row = mysqli_fetch_assoc($result);
    
    $order_id = ($row["order_id"] + 1);


    $sql = "SELECT u.username 'username', g.sex 'sex', u.first_name 'first_name', u.last_name 'last_name', u.address 'address', pc.city_name 'city', pp.province_name 'province', pr.region_name 'philregion', ir.name 'intlregion', co.name 'country', p.name 'name', ci.quantity 'qty', p.price 'price' FROM cart ca, cart_items ci, status_cart_order sco, products p, users u, countries co, phil_city pc, phil_region pr, phil_province pp, intl_regions ir, gender g WHERE '$cart_id' = ci.cart_id AND ci.item_id = p.product_id AND '$user_id' = u.user_id AND g.id = u.sex AND u.city_id = pc.city_id AND u.province_id = pp.province_id AND u.phil_region_id = pr.region_id AND u.intl_region_state_id = ir.id AND u.country_id = co.id AND ca.cart_status_id = 3 GROUP BY p.name";
    
    $result = mysqli_query($conn, $sql);
    
    while ($row = mysqli_fetch_assoc($result)) {
        extract($row);
        $place = ($city == "N/A" ? $address . ", " . ($intlregion == "N/A" ? "" : $intlregion . ", ") . $country : $address . ", " . $city . ", " . $province . ", " . $philregion . ", " . $country);
        $fullname = (($sex == "male") ? "Mr. " . $first_name . " " . $last_name : "Ms. " . $first_name . " " . $last_name);
        $sql = "INSERT INTO orders (order_id, username, name, address, item, quantity, price, order_status) VALUES ('$order_id', '$username', '$fullname', '$place', '$name', '$qty', '$price', 3)";
        $temp = mysqli_query($conn, $sql);
    }
    
    $sql = "UPDATE cart SET order_id = '$order_id', cart_status_id = 5 WHERE cart_id = '$cart_id' AND user_id = '$user_id'";
    
    $result = mysqli_query($conn, $sql);
    
    $sql = "INSERT INTO cart (user_id, cart_status_id) VALUES ('$user_id', 3)";
    
    $result = mysqli_query($conn, $sql);

    $sql = "SELECT cart_id FROM cart WHERE user_id = '$user_id' AND cart_status_id = 3";
    
    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($result);

    unset($_SESSION["cart_id"]);

    $_SESSION["cart_id"] = $row["cart_id"];

    echo $_SESSION["cart_id"];
}