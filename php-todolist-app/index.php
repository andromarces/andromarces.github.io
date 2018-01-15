<?php $todos = file_get_contents('assets/todos.json');
$todos = json_decode($todos, true);?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>PHP To-Do List</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy"
        crossorigin="anonymous">
    <script defer src="https://use.fontawesome.com/releases/v5.0.4/js/all.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Indie+Flower|Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div class="card text-center col-12 col-md-8 mt-5 mx-auto px-0">
        <div class="card-header">
            <h1>To-Do List</h1>
        </div>
        <div class="card-body col-12 col-md-8 mx-auto">
            <input class="mb-2 col-10 px-0" id="newTask" type="text" placeholder="Add New Task">
            <span class="col-1 px-0">
                <i class="fas fa-plus-square fa-2x" data-fa-transform="down-3"></i>
            </span>
            <ul class="list-group col-10 mx-auto text-left">
                <?php foreach ($todos as $key => $todo) {
                if ($todo['done'] === false) {?>
                <li class="list-group-item" id="<?php echo $key; ?>">
                    <span class="mr-1">
                        <i class="fas fa-trash-alt"></i>
                    </span>
                    <?php echo $todo['task']; ?>
                </li>
                <?php } else {?>
                <li class="list-group-item" id="<?php echo $key; ?>" class="completed">
                    <span class="mr-1">
                        <i class="fas fa-trash-alt"></i>
                    </span>
                    <?php echo $todo['task']; ?>
                </li>
                <?php }}?>
            </ul>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4"
        crossorigin="anonymous"></script>
    <script src="assets/js/todo.js"></script>
</body>

</html>