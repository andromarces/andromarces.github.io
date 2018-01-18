<?php

$username = $_POST['username'];
$password = $_POST['pw'];

$string = file_get_contents("assets/users.json");
$users = json_decode($string, true);
echo "original users array: "; print_r($users);

$users[$username] = $password;
echo "<br> new users array: "; print_r($users);

$file = fopen("assets/users.json","w"); //open the json file
fwrite($file, json_encode($users, JSON_PRETTY_PRINT)); //rewrite the json file
fclose($file); //close the json file

?>