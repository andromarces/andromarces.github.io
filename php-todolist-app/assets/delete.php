<?php

$id = $_POST['id'];

$todos = file_get_contents('todos.json');
$todos = json_decode($todos, true);

// delete task from the array $todos
unset($todos[$id]);

// echo $id;
// var_dump($todos);


// update json file
$file = fopen('todos.json', 'w');
fwrite($file, json_encode($todos, JSON_PRETTY_PRINT));
fclose($file);