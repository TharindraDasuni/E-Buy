<?php

require "connection.php";

if (isset($_GET["email"])) {

    $user_email = $_GET["email"];

    $user_rs = Database::search("SELECT * FROM  `user` WHERE `email`='" . $user_email . "'");
    $user_num = $user_rs->num_rows;

    if ($user_num == 1) {

        $user_data = $user_rs->fetch_assoc();
        $status = $user_data["status"];

        if ($status == 1) {
            Database::iud("UPDATE `user` SET `status`='0' WHERE `email`='" . $user_email . "'");
            echo ("Deactivated");
        } elseif ($status == 0) {

            Database::iud("UPDATE `user` SET `status`='1' WHERE  `email`='" . $user_email . "'");
            echo ("Activated");
        }
    } else {
        echo ("The user you are looking for cannot be find");
    }
} else {
    echo ("Something Went Wrong.");
}
