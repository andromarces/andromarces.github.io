<?php

function display_title()
{
    echo "Items";
}

function display_style()
{?>
    <style>
        strong {
            font-size: 1.5rem;
        }
    </style>
    <?php }
// $ages = [
//     'Peter' => 35,
//     'Ben' => 37,
//     'Joe' => 43,
// ];

// echo $ages['Peter']."<br>";
// echo $ages['Ben']."<br>";
// echo $ages['Joe']."<br>";

// foreach ($ages as $name => $age) {
//     echo "$name $age <br>";
// }

// $item1 = [
//     'name' => 'Coffee',
//     'description' => 'Powerful coffee drink.',
//     'price' => 3,
//     'img' => 'assets/img/coffee.jpeg',
//     'category' => 'Drinks',
// ];

// $item2 = [
//     'name' => 'Juice',
//     'description' => 'Natural fruit juice.',
//     'price' => 2,
//     'img' => 'assets/img/juice.jpeg',
//     'category' => 'Drinks',
// ];

// $item3 = [
//     'name' => 'Donut',
//     'description' => 'A ring of goodness.',
//     'price' => 4,
//     'img' => 'assets/img/donut.jpeg',
//     'category' => 'Food',
// ];

// $item4 = [
//     'name' => 'Cake',
//     'description' => 'A slice of heaven.',
//     'price' => 5,
//     'img' => 'assets/img/cake.jpeg',
//     'category' => 'Food',
// ];

// $item5 = [
//     'name' => 'Water',
//     'description' => "Good ol' H2O.",
//     'price' => 1,
//     'img' => 'assets/img/water.jpeg',
//     'category' => 'Drinks',
// ];

// $item6 = [
//     'name' => 'Ice Cream',
//     'description' => 'Great for those hot days.',
//     'price' => 6,
//     'img' => 'assets/img/icecream.jpeg',
//     'category' => 'Food',
// ];

// $items = [
//     $item1,
//     $item2,
//     $item3,
//     $item4,
//     $item5,
//     $item6,
// ];

// $file = fopen('items.json', 'w');
// fwrite($file, json_encode($items, JSON_PRETTY_PRINT)); /* rewrite the json file */
// fclose($file); /* close the json file */

// exit();

// foreach ($items as $item) {
//     // print_r($item);
//     foreach ($item as $key => $value) {
//         echo "$key: $value <br>";
//     }
//     echo "<hr>";
// }

$string = file_get_contents("items.json");
$items = json_decode($string, true);

function display_content()
{
    global $items;
    $categories = array_unique(array_column($items, 'category'));
    $filter = isset($_GET['category']) ? $_GET['category'] : 'All';?>
    <div class='col-12 col-md-8 col-lg-9'>
        <div class='row mb-1'>
            <form class='col-12 row'>
                <strong class="pr-2">Filter:</strong>
                <select class='custom-select col-2' name='category'>
                    <option selected>All</option>
                    <?php foreach ($categories as $category) {?>

                    <?php
echo $filter == $category ? "<option selected>$category</option>" : "<option>$category</option>";} ?>
                </select>
            </form>
        </div>

        <div class='row'>
            <?php foreach ($items as $item) {
        if ($filter == 'All' || $item['category'] == $filter) {?>
            <div class='col-12 col-md-6 col-lg-4 card' style='width: 18rem;'>
                <img class='card-img-top' src='<?php echo $item["img"]; ?>' alt='img' style='max-height: 165px;'>
                <div class='card-body'>
                    <p>
                        Name:
                        <?php echo $item['name']; ?>
                        <br> Description:
                        <?php echo $item['description']; ?>
                        <br> Price: Php
                        <?php echo $item['price']; ?>
                        <br> Category:
                        <?php echo $item['category'];
            if (isset($_SESSION['username']) && $_SESSION['username'] == 'admin') { ?>
                        <br>
                        <button type="button" class="btn btn-primary">Edit</button>
                        <button type="button" class="btn btn-danger">Delete</button>
                        <?php } else if (isset($_SESSION['username'])) {?>
                        <br>
                        <button type="button" class="btn btn-success">Add to Cart</button>
                        <?php }?>
                    </p>
                </div>
            </div>
            <?php }}?>
        </div>
    </div>
    <?php }

function display_script()
{?>
    <script>
        $('select[name=category]').change(function () {
            // alert("Y");
            $('form[class="col-12 row"]').submit();
        });
    </script>

    <?php }

require "template.php";

?>