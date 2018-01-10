<?php
function display_title()
{
    echo "Items";
}

function display_content()
{?>

    <form class="col-12 col-md-8 col-lg-9 border rounded border-dark" action="#" method="POST">
        <div class="form-group">
            <label for="exampleInputFullName1">Full Name</label>
            <input type="text" class="form-control" id="exampleInputFullName1" aria-describedby="fullNameHelp" placeholder="Enter Full Name"
                name="name" required>
            <small id="fullNameHelp" class="form-text text-muted">We'll never share your info with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputUsername2">Username</label>
            <input type="text" class="form-control" id="exampleInputUsername2" aria-describedby="usernameHelp" placeholder="Enter Username"
                name="username" required>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword2">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password" name="password" onkeyup='check();'>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword3">Confirm Password</label>
            <input type="password" class="form-control" id="exampleInputPassword3" placeholder="Confirm Password" name="password2" onkeyup='check();'>
        </div>
        <div class="form-group">
            <strong id="passCheck"></strong>
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck2">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <button type="submit" class="btn btn-primary" id="btn" name="submit" disabled>Register</button>
    </form>

    <script defer>
        var check = function () {
            if (document.getElementById('exampleInputPassword2').value !=
                document.getElementById('exampleInputPassword3').value) {
                document.getElementById('passCheck').style.color = 'red';
                document.getElementById('passCheck').innerHTML = 'Not matching.';
                document.getElementById('btn').disabled = true;
                document.getElementById('btn').style.background = 'gray';
            } else {
                document.getElementById('passCheck').style.color = 'green';
                document.getElementById('passCheck').innerHTML = 'Matching.';
                document.getElementById('btn').disabled = false;
                document.getElementById('btn').style.background = '#0069d9';
            }
        }
    </script>

    <?php }

require "template.php";

?>