<?php
require "template.php";

function display_title()
{
    echo "Pinoyware - Admin";
}

function display_css()
{?>
    <link rel="stylesheet" href="assets/css/admin.css">
    <?php }

function display_bottom_nav()
{?>

    <button type="button" id="sectionBtn" class="nav-item btn btn-outline-dark px-3 mr-auto">
        <span class="text-center sectionTitle">
            <i class="fas fa-columns"></i> Sections</span>
    </button>

    <?php }

function display_content()
{
    if (isset($_SESSION["username"])) {
        if ($_SESSION["role"] == "staff") {

    require "connection.php";?>
    <div class="row">

        <!-- nav group -->
        <div class="section p-0">
            <div class="px-1 mx-0 border border-dark rounded" id="sectionParent">
                <div class="nav flex-column nav-pills my-1" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="v-pills-users-tab" data-toggle="pill" href="#v-pills-users" role="tab" aria-controls="v-pills-users"
                        aria-selected="true"><i class="fas fa-users"></i> Users</a>
                    <a class="nav-link" id="v-pills-staff-tab" data-toggle="pill" href="#v-pills-staff" role="tab" aria-controls="v-pills-staff"
                        aria-selected="false"><i class="fas fa-users"></i> Staff</a>
                    <a class="nav-link" id="v-pills-products-tab" data-toggle="pill" href="#v-pills-products" role="tab" aria-controls="v-pills-products"
                        aria-selected="false"><i class="fab fa-dropbox"></i> Products</a>
                    <a class="nav-link" id="v-pills-orders-tab" data-toggle="pill" href="#v-pills-orders" role="tab" aria-controls="v-pills-orders"
                        aria-selected="false"><i class="fas fa-plane"></i> Orders</a>
                </div>
            </div>
        </div>

        <!-- content section -->
        <div class="col ml-md-2 mr-md-0 px-0" id="contentParent">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-sm">
                    <thead>
                        <tr>
                            <th scope="col">
                                <input type="checkbox" disabled>
                            </th>
                            <th scope="col">#</th>
                            <th scope="col">Username</th>
                            <th scope="col">Email</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Sex</th>
                            <th scope="col">Birthday</th>
                            <th scope="col">Address</th>
                            <th scope="col">City</th>
                            <th scope="col">Province</th>
                            <th scope="col">Phil. Region</th>
                            <th scope="col">Intl. Region</th>
                            <th scope="col">Country</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $sql = "SELECT u.user_id 'user_id', u.username 'username', u.email 'email', u.first_name 'first_name', u.last_name 'last_name', g.sex 'sex', u.birthday 'birthday', u.address 'address', pc.city_name 'city', pp.province_name 'province', pr.region_name 'philregion', ir.name 'intlregion', c.name 'country' FROM users u, phil_city pc, phil_province pp, phil_region pr, intl_regions ir, countries c, gender g WHERE u.city_id = pc.city_id AND u.province_id = pp.province_id AND u.phil_region_id = pr.region_id AND u.intl_region_state_id = ir.id AND u.country_id = c.id AND g.id = u.sex ORDER BY user_id";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($result)) {
                                extract($row); ?>

                        <tr>
                            <th class="align-middle" scope="row">
                                <input type="checkbox" data-index="<?php echo $user_id; ?>" data-email="<?php echo $email; ?>" data-username="<?php echo $username; ?>" class="rowcheck">
                            </th>
                            <td class="align-middle">
                                <?php echo $user_id; ?>
                            </td>
                            <td class="align-middle">
                                <?php echo $username; ?>
                            </td>
                            <td class="align-middle">
                                <?php echo $email; ?>
                            </td>
                            <td class="align-middle">
                                <?php echo $first_name; ?>
                            </td>
                            <td class="align-middle">
                                <?php echo $last_name; ?>
                            </td>
                            <td class="align-middle">
                                <?php echo ucfirst($sex); ?>
                            </td>
                            <td class="align-middle">
                                <?php echo $birthday; ?>
                            </td>
                            <td class="align-middle">
                                <?php echo $address; ?>
                            </td>
                            <td class="align-middle">
                                <?php echo $city; ?>
                            </td>
                            <td class="align-middle">
                                <?php echo $province; ?>
                            </td>
                            <td class="align-middle">
                                <?php echo $philregion; ?>
                            </td>
                            <td class="align-middle">
                                <?php echo $intlregion; ?>
                            </td>
                            <td class="align-middle">
                                <?php echo $country; ?>
                            </td>
                        </tr>
                            <?php } ?>
                    </tbody>
                </table>
            </div>
            <button type="button" id="addBtn" class="btn btn-success ml-1 ml-sm-0"><i class="fas fa-plus-circle"></i> Add</button>
            <button type="button" id="editBtn" class="btn btn-warning" disabled><i class="fas fa-edit"></i> Edit</button>
            <button type="button" id="delBtn" data-index="<?php echo $_SESSION["staff_id"]; ?>" data-username="<?php echo $_SESSION["username"]; ?>" class="btn btn-danger" disabled><i class="fas fa-trash-alt"></i> Delete</button>
        </div>
        <?php }
    }
}

function display_js()
{?>
        <script src="assets/js/admin.js"></script>
        <?php }