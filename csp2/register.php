<?php
require "template.php";

function display_title()
{
    echo "Pinoyware - Register";
}

function display_css()
{?>
    <link rel="stylesheet" href="assets/css/register.css">
    <?php }

function display_bottom_nav()
{}

function display_content()
{
    if (isset($_SESSION["username"])) {
    } else {
        require "connection.php";?>

    <h1 class="text-center">Registration</h1>

    <form class="col-12 col-md-10 col-lg-9 col-xl-8 mx-auto px-0 px-md-3" id="regForm">
        <div class="form-row">
            <div class="col-sm-6 col-lg-4 mb-3">
                <label for="firstName">First name</label>
                <input type="text" class="form-control" name="firstname" pattern="^$|^[^\s]+(\s+[^\s]+)*$" autocomplete="given-name" id="firstName"
                    placeholder="First name" required>
            </div>
            <div class="col-sm-6 col-lg-4 mb-3">
                <label for="lastName">Last name</label>
                <input type="text" class="form-control" pattern="^$|^[^\s]+(\s+[^\s]+)*$" name="lastname" autocomplete="family-name" id="lastName"
                    placeholder="Last name" required>
            </div>
            <div class="col-sm-6 col-lg-4 mb-3">
                <label for="registerEmail">Email</label>
                <input type="email" class="form-control" name="email" autocomplete="email" id="registerEmail" placeholder="Email" required>
                <small class="form-text text-muted">
                    <span class="mailCheck"></span>
                </small>
            </div>
            <div class="col-sm-6 col-lg-4 mb-3">
                <label for="registerUsername">Username</label>
                <input type="text" class="form-control" name="username" autocomplete="username" id="registerUsername" pattern="^[A-Za-z0-9_]{1,32}$"
                    placeholder="Username" required>
                <small class="form-text text-muted">
                    <span class="userCheck">Maximum 32 characters long. No spaces at start and end.</span>
                </small>
            </div>
            <div class="col-sm-6 col-lg-4 mb-3">
                <label for="registerPassword1">Password</label>
                <input type="password" id="registerPassword1" name="password1" class="form-control newPass" autocomplete="new-password" pattern="^(?:\S.{4,}\S)?$"
                    placeholder="Password" required>
                <small class="form-text text-muted">
                    Minimum of 6 characters. No spaces at start and end.
                </small>
            </div>
            <div class="col-sm-6 col-lg-4 mb-3">
                <label for="registerPassword2">Confirm Password</label>
                <input type="password" id="registerPassword2" name="password2" class="form-control newPass" autocomplete="new-password" pattern="^(?:\S.{4,}\S)?$"
                    placeholder="Confirm Password" required>
                <small class="form-text font-weight-bold passCheck">
                    <span class="matchCheck"></span>
                    <span class="lengthCheck"></span>
                </small>
            </div>
            <div class="col-sm-6 col-lg-4 mb-3">
                <label for="inputSex">Gender</label>
                <select class="form-control custom-select" name="sex" id="inputSex" required>
                    <option value="">Select Gender</option>
                    <option value=1>Female</option>
                    <option value=2>Male</option>
                </select>
            </div>
            <div class="col-sm-6 col-lg-4 mb-3">
                <label for="birthDay">Birthday</label>
                <input type="date" id="birthDay" name="birthday" class="form-control" autocomplete="bday" max="<?php echo date('Y-m-d', strtotime("
                    - 18 years ")) ?>" required>
            </div>
        </div>
        <div class="form-row">
            <div class="col-sm-6 col-lg-4 mb-3">
                <label for="country">Country</label>
                <select name="country" class="form-control custom-select" id="country" required>
                    <option value="" class="countryOption">Select Country</option>
                    <?php $sql = "SELECT * FROM countries ORDER BY countries.name ASC";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            extract($row);
            echo "<option value=$id>$name</option>";
        }?>
                </select>
            </div>
            <div class="col-sm-6 col-lg-4 mb-3 region"></div>
            <div class="col-sm-6 col-lg-4 mb-3 province"></div>
            <div class="col-sm-6 col-lg-4 mb-3 city"></div>
            <div class="col-sm-6 col-lg-8 mb-3">
                <label for="address">Address</label>
                <textarea class="form-control" name="address" id="address" pattern="^$|^[^\s]+(\s+[^\s]+)*$" auto-complete="street-address"
                    placeholder="Address" row=3 required></textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                <label class="form-check-label" for="invalidCheck">
                    Agree to terms and conditions.
                </label>
            </div>
        </div>
        <button class="btn btn-success regBtn d-block mx-auto" type="submit" disabled>Register</button>
    </form>

    <?php }}

function display_js()
{?>
    <script>
        <?php require "connection.php";
    // create list of countries with no regions
    $sql = "SELECT countries.name FROM countries WHERE NOT EXISTS (SELECT * FROM intl_regions WHERE intl_regions.country_id = countries.id)";
    $result = mysqli_query($conn, $sql);
    $noregion = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $noregion[] = $row["name"];
    }?>
        // list of countries with no regions in database (auto-generated)
        var noRegion = <?php echo json_encode($noregion); ?>;
    </script>
    <script src="assets/js/register.js"></script>
    <?php }