<?php
session_start();
require "users.php";

$username = $_POST['username'];
$password = $_POST['password'];

if (array_key_exists($username, $users)) {
    if ($users[$username] == $password) {
        $_SESSION['username'] = $username;
        header('location: items.php');
    } else {?>
    <script>
    location.replace('items.php#lif');
    </script>
<?php }} else {?>
    <script>
    location.replace('items.php#lif');
    </script>
<?php }?>
