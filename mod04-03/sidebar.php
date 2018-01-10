<?php if (isset($_SESSION['username'])) {} else {?>

<form class="col-12 col-md-4 col-lg-3 border rounded border-dark" action="authenticate.php" method="POST">
    <div class="form-group">
        <label for="exampleInputUsername1">Username</label>
        <input type="text" class="form-control" id="exampleInputUsername1" aria-describedby="usernameHelp" placeholder="Enter Username"
            name="username">
        <small id="usernameHelp" class="form-text text-muted">We'll never share your info with anyone else.</small>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
    </div>
    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
    </div>
    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
</form>

<?php }?>