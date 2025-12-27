<?php
session_start();
?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>E-Buy | Profile Settings</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resource/logo.png" />

</head>

<body class="home-body">

    <div class="container-fluid">
        <div class="row">

            <?php include "header.php"; ?>

            <?php

            require "connection.php";

            if (isset($_SESSION["u"])) {

                $email = $_SESSION["u"]["email"];

                $u_rs = Database::search("SELECT  * FROM `user` WHERE `email`='" . $email . "' ");
                $u_data = $u_rs->fetch_assoc();

                $a_rs = Database::search("SELECT * FROM `user_has_address` INNER JOIN `city` ON
                `user_has_address`.`city_id` = `city`.`id` INNER JOIN `district` ON
                `city`.`district_id` = `district`.`id` INNER JOIN `province` ON
                `district`.`province_id` = `province`.`id` WHERE `user_email`='" . $email . "'");
                $a_data = $a_rs->fetch_assoc();

                $g_rs = Database::search("SELECT * FROM `gender` INNER JOIN `user` ON user.gender_id = gender.id WHERE `email`='" . $email . "' ");
                $g_data = $g_rs->fetch_assoc();

            ?>

                <div class="col-12 mt-4">
                    <div class="row">

                        <div class="offset-1 col-10 col-lg-10 rounded mt-0 mb-4">
                            <div class="row">

                                <div class="col-lg-3">
                                    <div class="text-center p-3 py-5 profileimg-box text-item">
                                        <h3 class="fw-bold">Profile</h3>

                                        <?php

                                        $image_rs = Database::search("SELECT * FROM `user_img` WHERE `user_email`='".$email."'");
                                        $image_details = $image_rs->fetch_assoc();

                                        if (isset($image_details["path"])) {
                                        ?>
                                        <img src="<?php echo $image_details["path"]; ?>" class="rounded-circle " style="width: 150px;" />
                                            
                                        <?php
                                        } else {
                                        ?>
                                            <img src="resource/profileimg.png" id="p_img" class="rounded-circle mt-5 profile-img" style="width: 150px;" />
                                        <?php
                                        }

                                        ?>

                                        <br />

                                        <input type="file" class="d-none" id="profileimage" />
                                        <label for="profileimage" class="mt-2 dp-update-txt" onclick="imageChange();"><i class="bi bi-camera me-1"></i> Update Profile Image</label>

                                        <br />

                                        <span class="name fw-bold"><?php echo $u_data["fname"]; ?></span>
                                        <span class="name"><?php echo $u_data["lname"]; ?></span>

                                    </div>
                                </div>

                                <div class="col-md-8 profile-box mt-5 mt-lg-0 offset-lg-1">
                                    <div class="p-5">

                                        <div class="d-flex justify-content-between align-items-center mb-3 ms-lg-5 text-item">
                                            <h3 class="fw-bold">User Profile Settings</h3>
                                        </div>

                                        <div class="row mt-4">

                                            <div class="col-12 col-lg-3 inputBox-up ms-0 ms-lg-5 me-4">
                                                <label class="form-label">First Name</label>
                                                <input type="text" id="fname" value="<?php echo $u_data["fname"]; ?>" class="p-2" />
                                                <i></i>
                                            </div>

                                            <div class="col-12 col-lg-3 inputBox-up ms-0 ms-lg-4 me-4">
                                                <label class="form-label">Last Name</label>
                                                <input type="text" id="lname" class="p-2" value="<?php echo $u_data["lname"]; ?>" />
                                                <i></i>
                                            </div>

                                            <div class="col-12 col-lg-3 inputBox-up ms-0 ms-lg-4 me-4">
                                                <label class="form-label">Contact No</label>
                                                <input type="text" id="mobile" class="p-2" value="<?php echo $u_data["mobile"]; ?>" />
                                                <i></i>
                                            </div>


                                            <div class="col-12 col-lg-3 inputBox-up ms-0 ms-lg-5 me-4">
                                                <label class="form-label">Email</label>
                                                <input type="text" id="email" class="p-2" readonly value="<?php echo $u_data["email"]; ?>" />
                                                <i></i>
                                            </div>

                                            <div class="col-12 col-lg-3 inputBox-up ms-0 ms-lg-4 me-4">
                                                <label class="form-label">Password</label>
                                                <div class="input-group">
                                                    <input type="password" id="pw" class="p-2" value="<?php echo $u_data["password"]; ?>" readonly />
                                                    <i></i>
                                                </div>
                                            </div>

                                            <?php
                                            
                                            $gender_rs = Database::search("SELECT * FROM `gender`");
                                            
                                            ?>

                                            <div class="col-12 col-lg-3 inputBox-up ms-0 ms-lg-4 me-4">
                                                <label class="form-label">Gender</label>
                                                <select class="mt-2" id="gender">
                                                    <option value="0">Select Gender</option>
                                                    <?php
                                                    $gender_num = $gender_rs->num_rows;
                                                    for ($x = 0; $x < $gender_num; $x++) {
                                                        $gender_data = $gender_rs->fetch_assoc();
                                                    ?>
                                                        <option value="<?php echo $gender_data["id"]; ?>
                                                        " <?php
                                                            if (!empty($g_data["gender_id"])) {
                                                                if ($gender_data["id"] == $g_data["gender_id"]) {
                                                            ?>selected<?php
                                                                    }
                                                                }
                                                                        ?>><?php echo $gender_data["gender_name"] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <!-- 
                                            <div class="col-12 col-lg-3 inputBox-up ms-0 ms-lg-4 me-4">
                                                <label class="form-label">Registered Date</label>
                                                <input type="text" class="p-2" readonly value="<?php echo $u_data["joined_date"]; ?>" />
                                                <i></i>
                                            </div> -->

                                            <?php
                                            if (!empty($a_data["line1"])) {
                                            ?>

                                                <div class="col-12 col-lg-3 inputBox-up ms-0 ms-lg-5 me-4">
                                                    <label class="form-label">Address Line 01</label>
                                                    <input type="text" id="a_line1" class="p-2" value="<?php echo $a_data["line1"]; ?>" />
                                                    <i></i>
                                                </div>

                                            <?php
                                            } else {
                                            ?>

                                                <div class="col-12 col-lg-3 inputBox-up ms-0 ms-lg-5 me-4">
                                                    <label class="form-label">Address Line 01</label>
                                                    <input type="text" id="a_line1" class="p-2" />
                                                    <i></i>
                                                </div>

                                            <?php
                                            }
                                            ?>

                                            <?php
                                            if (!empty($a_data["line2"])) {
                                            ?>
                                                <div class="col-12 col-lg-3 inputBox-up ms-0 ms-lg-4 me-4">
                                                    <label class="form-label">Address Line 02</label>
                                                    <input type="text" id="a_line2" class="p-2" value="<?php echo $a_data["line2"]; ?>" />
                                                    <i></i>
                                                </div>

                                            <?php
                                            } else {
                                            ?>
                                                <div class="col-12 col-lg-3 inputBox-up ms-0 ms-lg-4 me-4">
                                                    <label class="form-label">Address Line 02</label>
                                                    <input type="text" id="a_line2" class="p-2" />
                                                    <i></i>
                                                </div>

                                            <?php
                                            }
                                            ?>

                                            <?php
                                            if (!empty($a_data["postal_code"])) {
                                            ?>
                                                <div class="col-12 col-lg-3 inputBox-up ms-0 ms-lg-4 me-4">
                                                    <label class="form-label">Postal Code</label>
                                                    <input type="text" id="pc" class="p-2" value="<?php echo $a_data["postal_code"]; ?>" />
                                                    <i></i>
                                                </div>
                                            <?php
                                            } else {
                                            ?>
                                                <div class="col-12 col-lg-3 inputBox-up ms-0 ms-lg-4 me-4">
                                                    <label class="form-label">Postal Code</label>
                                                    <input type="text" id="pc" class="p-2" />
                                                    <i></i>
                                                </div>
                                            <?php
                                            }
                                            ?>

                                            <?php

                                            $province_rs = Database::search("SELECT * FROM `province`");
                                            $district_rs = Database::search("SELECT * FROM `district`");
                                            $city_rs = Database::search("SELECT * FROM `city`");

                                            ?>



                                            <div class="col-12 col-lg-3 inputBox-up ms-0 ms-lg-5 me-4 pt-2">
                                                <label>City</label>
                                                <select class="mt-2" id="city">
                                                    <option value="0">Select City</option>
                                                    <?php
                                                    $city_num = $city_rs->num_rows;
                                                    for ($x = 0; $x < $city_num; $x++) {
                                                        $city_data = $city_rs->fetch_assoc();
                                                    ?>
                                                        <option value="<?php echo $city_data["id"]; ?>
                                                        " <?php
                                                            if (!empty($a_data["city_id"])) {
                                                                if ($city_data["id"] == $a_data["city_id"]) {
                                                            ?>selected<?php
                                                                    }
                                                                }
                                                                        ?>><?php echo $city_data["name"] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="col-12 col-lg-3 inputBox-up ms-0 ms-lg-4 me-4">
                                                <label class="form-label">District</label>
                                                <select class="mt-2" id="district">
                                                    <option value="0">Select District</option>
                                                    <?php
                                                    $district_num = $district_rs->num_rows;
                                                    for ($x = 0; $x < $district_num; $x++) {
                                                        $district_data = $district_rs->fetch_assoc();
                                                    ?>
                                                        <option value="<?php echo $district_data["id"]; ?>
                                                        " <?php
                                                            if (!empty($a_data["district_id"])) {
                                                                if ($district_data["id"] == $a_data["district_id"]) {
                                                            ?>selected<?php
                                                                    }
                                                                }
                                                                        ?>><?php echo $district_data["name"] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="col-12 col-lg-3 inputBox-up ms-0 ms-lg-4 me-4">
                                                <label class="form-label">Province</label>
                                                <select class="mt-2" class="p-2" id="province">
                                                    <option value="0">Select Province</option>
                                                    <?php
                                                    $province_num = $province_rs->num_rows;
                                                    for ($x = 0; $x < $province_num; $x++) {
                                                        $province_data = $province_rs->fetch_assoc();
                                                    ?>
                                                        <option value="<?php echo $province_data["id"]; ?>
                                                        " <?php
                                                            if (!empty($a_data["province_id"])) {
                                                                if ($province_data["id"] == $a_data["province_id"]) {
                                                            ?>selected<?php
                                                                    }
                                                                }
                                                                        ?>><?php echo $province_data["name"] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="col-12 mt-5 ms-0 ms-lg-3">
                                                <div class="row">
                                                    <div class="offset-lg-2 col-12 col-lg-8">
                                                        <button class="up-button button" onclick="updateProfile();">Update My Profile</button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

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
                            window.location = "signin.php";
                        }
                    });
                </script>
            </body>
          </html>';
    exit();
}

            ?>
               

            <?php include "footer.php"; ?>

        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>