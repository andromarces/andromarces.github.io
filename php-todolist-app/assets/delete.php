<?php

$id = $_POST['id'];

$todos = file_get_contents('todos.json');
$todos = json_decode($todos, true);

// echo $id;
// delete task from the array $todos
unset($todos[$id]);

// update json file
$file = fopen('todos.json', 'w');
fwrite($file, json_encode($new_todos, JSON_PRETTY_PRINT));
fclose($file);
