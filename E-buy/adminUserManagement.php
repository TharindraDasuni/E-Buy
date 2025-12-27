<?php
session_start();
require "connection.php";

if (isset($_SESSION["a"])) {

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>E-Buy | Admin - User Manage</title>
        <link rel="icon" href="resource\logo.png" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="style.css" />
    </head>

    <body class="home-body" onload="usersLoad();">

        <!-- Nav Bar -->
        <?php include "adminNavbar.php" ?>
        <!-- Nav Bar -->

        <div class="offset-1 col-10  mt-lg-4 text-item">
            <h2 class="text-center fw-bold">Administration of Users</h2>

            <div class="row d-flex justify-content-end mt-5 mb-5 ms-0">


                <div class="col-8 col-lg-2">
                    <input type="text" class="form-control search-bar" placeholder="User" id="user">
                </div>

                <button class="btn btn-primary col-3 col-lg-2 search-btn" onclick="searchUser();">Search</button>
            </div>

            <div class="col-12 mt-3 mb-5 u-management-box p-3">
                <div id="searchUser">
                    <table class="table text-light u-mng-txt">
                        <!-- table header -->
                        <thead>
                            <tr>
                                <th scope="col">User ID</th>
                                <th scope="col">Profile Image</th>
                                <th scope="col">Full Name</th>
                                <th scope="col">Email Address</th>
                                <th scope="col">Contact</th>
                                <th scope="col">Registered Date</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <!-- table header -->




                        <!-- table body -->
                        <tbody>


                            <?php

                            $q = "SELECT * FROM `user` ";
                            $user_rs = Database::search($q);
                            $user_num = $user_rs->num_rows;


                            for ($x = 0; $x < $user_num; $x++) {
                                $user_data = $user_rs->fetch_assoc();
                            ?>
                                <tr>
                                    <td scope="col" class="align-content-center"><?php echo $x + 1; ?></td>
                                    <td scope="col" class="align-content-center"> <?php
                                                                                    $image_rs = Database::search("SELECT * FROM `user_img`  WHERE `user_email`='" . $user_data['email'] . "'");
                                                                                    $image_data = $image_rs->fetch_assoc();
                                                                                    ?>

                                        <?php if (isset($image_data["path"])) {
                                        ?>
                                            <img src="<?php echo $image_data["path"]; ?>" class="rounded-circle " style="height: 100px;" />

                                        <?php
                                        } else {
                                        ?>
                                            <img src="resource/profileimg.png" id="p_img" class="rounded-circle mt-5 profile-img" style="height: 100px;" />
                                        <?php
                                        }

                                        ?>

                                    </td>
                                    <td scope="col" class="align-content-center"><?php echo $user_data["fname"] . " " . $user_data["lname"]; ?></td>
                                    <td scope="col" class="align-content-center"><?php echo $user_data["email"]; ?></td>
                                    <td scope="col" class="align-content-center"><?php echo $user_data["mobile"]; ?></td>
                                    <td scope="col" class="align-content-center"><?php echo $user_data["joined_date"]; ?></td>

                                    <?php
                                    if ($user_data["gender_id"] == 1) {
                                    ?>

                                        <td scope="col" class="align-content-center"><?php echo "Male"; ?></td>

                                    <?php
                                    } else {
                                    ?>
                                        <td scope="col" class="align-content-center"><?php echo "Female"; ?></td>

                                    <?php
                                    }
                                    ?>

                                    <?php
                                    if ($user_data["status"] == 1) {
                                    ?>
                                        <td scope="col" class="align-content-center"> <button id="d<?php echo $user_data["email"]; ?>" class="btn btn-dark" onclick="manageUser('<?php echo $user_data['email']; ?>'); location.reload();">Deactivate</button></td>
                                    <?php
                                    } else {
                                    ?>
                                        <td scope="col" class="align-content-center"> <button id="a<?php echo $user_data["email"]; ?>" class="btn btn-info fw-bold" onclick="manageUser('<?php echo $user_data['email']; ?>'); location.reload();">Activate</button></td>
                                    <?php

                                    }
                                    ?>

                                </tr>
                            <?php
                            }
                            ?>
                </div>
                </tbody>

                <!-- table body -->

                </table>
            </div>


        </div>

        </div>

        <script src="script.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>


<?php
} else {
    echo '<html>
            <head>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
            </head>
            <body>
                <script type="text/javascript">
                    Swal.fire({
                        icon: "error",
                        title: "You are Not Logged Yet!",
                        text: "Please Login First"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location = "adminSignin.php";
                        }
                    });
                </script>
            </body>
          </html>';
    exit();
}
