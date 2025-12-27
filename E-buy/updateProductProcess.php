<?php

session_start();
require "connection.php";

if (isset($_SESSION["p"])) {
    $pid = $_SESSION["p"]["id"];

    $title = $_POST["title"];
    $qty = $_POST["qty"];
    $dwc = $_POST["dwc"];
    $doc = $_POST["doc"];
    $descri = $_POST["descri"];

    if (empty($title)) {
        echo ("Please enter a title");
    } elseif (empty($qty)) {
        echo ("Please enter a quantity");
    } elseif (empty($dwc)) {
        echo ("Please enter a Delivary cost of matara");
    } elseif (empty($doc)) {
        echo ("Please enter a Delivary cost of other");
    } elseif (empty($descri)) {
        echo ("Please enter a description");
    } else {

        Database::iud("UPDATE `product` SET `title`='" . $title . "',`qty`='" . $qty . "',
                `delivery_fee_colombo`='" . $dwc . "',`delivery_fee_other`='" . $doc . "',
                `description`='" . $descri . "' WHERE `id`='" . $pid . "'");

        $length = sizeof($_FILES);

        Database::iud("DELETE FROM `product_img` WHERE `product_id`='" . $pid . "'");

        $allowed_img_extantions = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");

        for ($x = 0; $x < $length; $x++) {
            if (isset($_FILES["image" . $x])) {

                $img_file = $_FILES["image" . $x];
                $file_extention = $img_file["type"];

                if (in_array($file_extention, $allowed_img_extantions)) {

                    $new_img_extention;

                    if ($file_extention == "image/jpg") {
                        $new_img_extention = ".jpg";
                    } else if ($file_extention == "image/jpeg") {
                        $new_img_extention = ".jpeg";
                    } else if ($file_extention == "image/png") {
                        $new_img_extention = ".png";
                    } else if ($file_extention == "image/svg+xml") {
                        $new_img_extention = ".svg";
                    }

                    $file_name = "resource//products//" . $title . "_" . $x . "_" . uniqid() . $new_img_extention;
                    move_uploaded_file($img_file["tmp_name"], $file_name);

                    Database::iud("INSERT INTO `product_img`(`img_path`,`product_id`)
                                                VALUES ('" . $file_name . "','" . $pid . "')");
                } else {
                    echo ("Not an allowed image type.");
                }
            }
        }

        echo ("success");

    }

}

?>