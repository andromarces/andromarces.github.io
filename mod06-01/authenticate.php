<?php
session_start();

$string = file_get_contents("assets/users.json");
$users = json_decode($string, true);

$username = $_POST['username']; //user input
$password = $_POST['password']; //user input

if(isset($users[$username]) && $users[$username] == $password){
	$_SESSION['username'] = $username;
	header('location: menu.php');
} else {
	echo "failed to login. incorrect login credentials.";
	echo " please login again <a href='login.php'>here</a>";
}

?>