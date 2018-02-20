<?php session_start();
require "template.php";

function display_title()
{
    echo "Pinoyware";
}

function display_css()
{?>
<link rel="stylesheet" href="assets/css/index.css">
<?php }

function display_bottom_nav()
{}

function display_content()
{
    require "connection.php";?>
<img src="assets/img/front.png" class="position-absolute col-12 col-md-8 col-lg-6 mt-2" id="brand" alt="Pinoyware">
<div class="text-center">
<?php $sql = "SELECT image, name FROM products ORDER BY rand() LIMIT 9";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    extract($row); ?>
<img src="<?php echo $image; ?>" class="animated col-4 col-md-3 col-lg-2" alt="<?php echo $name; ?>">
<?php } ?>
</div>
<p class="frontCaption position-absolute text-center">Your one stop shop for all your PC gaming needs!</p>




<?php }

function display_js()
{?>
<script src="assets/js/index.js"></script>
<?php }