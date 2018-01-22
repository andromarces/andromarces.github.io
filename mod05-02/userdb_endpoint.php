<?php
session_start();
require 'connection.php';
$username = $_POST['username'];

$sql = "SELECT username FROM users";

$result = mysqli_query($conn,$sql);

$users = array();

while ($row = mysqli_fetch_assoc($result)) {
    $users[] = $row['username'];
}

if (array_key_exists($username, array_flip($users))) {
    echo true;
} else {
    echo false;
}