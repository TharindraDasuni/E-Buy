<?php
session_start();
require "connection.php";

$txt = $_POST["t"];

?>

<div class="col-12">
    <div class="row">

        <?php

        $user_rs = Database::search("SELECT * FROM `user` WHERE `fname` LIKE '%" . $txt . "%'");
        $user_num = $user_rs->num_rows;
        ?>


        <?php

        for ($x = 0; $x < $user_num; $x++) {

            $sid = $user_num;
            $user_data = $user_rs->fetch_assoc();

        ?>

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

                        <tr>
                            <td scope="col" class="align-content-center"><?php echo $x + 1; ?></td>
                            <td scope="col"> <?php
                                                $image_rs = Database::search("SELECT * FROM `user_img`  WHERE `user_email`='" . $user_data['email'] . "'");
                                                $image_data = $image_rs->fetch_assoc();
                                                ?>
                                <img src="<?php echo $image_data["path"] ?>" class="rounded-circle" style="height: 100px;" />
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
                                <td scope="col" class="align-content-center"> <button id="d<?php echo $user_data["email"]; ?>" class="btn btn-dark" onclick="manageUser('<?php echo $user_data['email']; ?>');">Deactivate</button></td>
                            <?php
                            } else {
                            ?>
                                <td scope="col" class="align-content-center"> <button id="a<?php echo $user_data["email"]; ?>" class="btn btn-info fw-bold" onclick="manageUser('<?php echo $user_data['email']; ?>');">Activate</button></td>
                            <?php

                            }
                            ?>

                        </tr>
            </div>

        <?php

        }
        ?>

        <?php
        if (isset($sid)) {
        } else {
            $sid = 0;
        }
        if ($sid == 1) {
        } elseif ($sid != 1) {
            if ($sid == 0) {
        ?>
                <!-- Empty View -->
                <div class="col-12 mt-5 mb-5">
                    <div class="row">
                        <div class="col-12 text-center">
                            <i class="bi bi-search text-light" style="font-size: 50px;"></i>
                        </div>
                        <div class="col-12 text-center mb-2">
                            <label class="form-label fs-4 text-info">The user you are looking for cannot be found.</label>
                        </div>
                        <div class="col-12 text-center mb-3">
                            <p class="fs-4 text-light">Search a user who has logged into E-Buy.</p>
                        </div>
                    </div>
                </div>
                <!-- Empty View -->
        <?php
            }
        }

        ?>



    </div>
</div>