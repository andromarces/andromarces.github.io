Are you sure you want to delete this item:
<br>
<?php
$index = $_POST['index'];
$string = file_get_contents("assets/items.json");
$items = json_decode($string, true);

$img = $items[$index]['img'];
$name = $items[$index]['name'];
$description = $items[$index]['description'];
$price = $items[$index]['price'];
echo "<div class='row'>";
echo "<div class='col-xs-4 item_display'>";
echo "<img src='$img'>";
echo "<h5>$name</h5>";
echo "Price: Php$price<br>";
echo "</div></div>";

?>
<a href='delete.php?index=<?php echo $index; ?>'><button class="btn btn-danger">Yes</button></a> <button class="btn btn-primary" data-dismiss='modal'>No</button>