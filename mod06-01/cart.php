<?php

function  display_title(){
	echo "CART";
}

function display_content(){
	$string = file_get_contents("assets/items.json");
	$items = json_decode($string, true);

	$total = 0;
	// print_r($_SESSION['cart']); // Array ([] => '')
	foreach ($_SESSION['cart'] as $index => $quantity) {
		$subtotal = $items[$index]['price'] * $quantity; 
		$total += $subtotal;
		$img = $items[$index]['img']; 
		echo "<div>";
		echo "<img class='col-xs-3' src='$img' style='float:left'>";
		echo $items[$index]['name']."<br>";
		echo $items[$index]['price']."<br>";	
		echo "<div style='float:right'>
			<h4>$subtotal</h4>
			<form method='post' action='add_to_cart.php?index=$index'>
			<input type='number' name='change_quantity' min=1 value='$quantity'><br>
			<button class='btn btn-primary'>Change Quantity</button><br>
			<a href='remove_from_cart.php?index=$index'>
			<button type='button' class='btn btn-danger'>Remove From Cart</button></a>
			</form>
			</div>";
		echo "</div>";
		echo "<div style='clear:both'></div>";
	}
	echo "<center><h3>Total: Php $total</h3></center>";
}

require 'template.php';

?>