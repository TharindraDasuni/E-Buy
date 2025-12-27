<?php

session_start();

require "connection.php";

if (isset($_SESSION["u"])) {

    $user_email = $_SESSION["u"]["email"];

    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $mobile = $_POST["mobile"];
    $gender = $_POST["gender"];
    $line1 = $_POST["addressLine1"];
    $line2 = $_POST["addressLine2"];
    $pCode = $_POST["postalcode"];
    $city = $_POST["city"];
    $district = $_POST["district"];
    $province = $_POST["province"];

    if (empty($fname)) {
        echo ("Please Enter Your First Name.");
    } else if (strlen($fname) > 20) {
        echo ("The Charater Limit Is 20.");
    } else if (empty($lname)) {
        echo ("Please Enter Your Last Name.");
    } else if (strlen($lname) > 20) {
        echo ("The Charater Limit Is 20");
    } else if (empty($mobile)) {
        echo ("Please Enter Your Mobile Number.");
    } else if (strlen($mobile) != 10) {
        echo ("The Character Limit Is 10.");
    } else if (!preg_match("/07[0,1,2,4,5,6,7,8][0-9]{7}/", $mobile)) {
        echo ("Invalid Mobile Number.");
    } else if (empty($gender)) {
        echo ("Please Select Your Gender.");
    } else if (empty($line1)) {
        echo ("Please Enter Your Address Line 1.");
    } else if (empty($line2)) {
        echo ("Please Enter Your Address Line 2.");
    } else if (empty($city)) {
        echo ("Please Select Your City.");
    } else if (empty($district)) {
        echo ("Please Select Your District.");
    } else if (empty($province)) {
        echo ("Please Select Your Province.");
    } else if (empty($pCode)) {
        echo ("Please Enter Your Postal Code.");
    } else {

        $address_rs = Database::search("SELECT * FROM `user_has_address` WHERE 
    `user_email`='" . $user_email . "'");

        $address_num = $address_rs->num_rows;

        if ($address_num == 1) {
            Database::iud("UPDATE `user_has_address` SET `city_id`='" . $city . "',`line1`='" . $line1 . "',
        `line2`='" . $line2 . "',`postal_code`='" . $pCode . "' WHERE `user_email`='" . $user_email . "' ");

            Database::iud("UPDATE `city` SET  `district_id` = '" . $district . "' WHERE `id`='" . $city . "' ");

            Database::iud("UPDATE `district` SET `province_id`='" . $province . "' WHERE `id`= '" . $district . "' ");
        } else {
            Database::iud("INSERT INTO `user_has_address`(`user_email`,`city_id`,`line1`,`line2`,`postal_code`)
        VALUES ('" . $user_email . "','" . $city . "','" . $line1 . "','" . $line2 . "','" . $pCode . "')");

            Database::iud("UPDATE `city` SET  `district_id` = '" . $district . "' WHERE `id`='" . $city . "' ");

            Database::iud("UPDATE `district` SET `province_id`='" . $province . "' WHERE `id`= '" . $district . "' ");
        }

        $allowed_image_extentions = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");

        if (isset($_FILES["pImg"])) {

            $p_img = $_FILES["pImg"];
            $file_type = $p_img["type"];

            if (in_array($file_type, $allowed_image_extentions)) {

                $new_file_type;

                if ($file_type == "image/jpg") {
                    $new_file_type = ".jpg";
                } else if ($file_type == "image/jpeg") {
                    $new_file_type = ".jpeg";
                } else if ($file_type == "image/png") {
                    $new_file_type = ".png";
                } else if ($file_type == "image/svg+xml") {
                    $new_file_type = ".svg";
                }

                $file_name = "resource//profileimg//" . $lname . "_" . $mobile . "_" . uniqid() . $new_file_type;
                move_uploaded_file($p_img['tmp_name'], $file_name);

                $p_img_rs = Database::search("SELECT * FROM `user_img` WHERE `user_email`='" . $user_email . "' ");

                $p_img_num = $p_img_rs->num_rows;

                if ($p_img_num == 1) {
                    Database::iud("UPDATE `user_img` SET `path`='" . $file_name . "' WHERE `user_email`='" . $user_email . "' ");
                } else {
                    Database::iud("INSERT INTO `user_img` (`path`,`user_email`) VALUES ('" . $file_name . "','" . $user_email . "')");
                }
            } else {
                echo ("The Uploaded File Type is Not Allowed.");
            }
        } else {
        }

        $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $user_email . "'");
        $user_num = $user_rs->num_rows;
        $d = $user_rs->fetch_assoc();

        if ($user_num == 1) {

            if (empty($d["gender_id"])) {

                Database::iud("UPDATE `user` SET `gender_id`='" . $gender . "' WHERE `email`='" . $user_email . "'");
                
            }

            Database::iud("UPDATE `user` SET `fname`='" . $fname . "',`lname`='" . $lname . "',`mobile`='" . $mobile . "' WHERE `email`='" . $user_email . "'");


            echo ("success");
        } else {
            echo ("You are not recognized as a valid user.");
        }
    }

}

?>