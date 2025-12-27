<?php

include "connection.php";

$color = $_POST["clr"];

if (empty($color)) {
    echo ("Please Provide Your Product Color");
} else if (strlen($color) > 20) {
    echo ("The Color should be less than 20 Characters");
} else {

    $rs = Database::search("SELECT * FROM `color` WHERE `name`='" . $color . "'");
    $num = $rs->num_rows;

    if ($num > 0) {
        echo ("The Color Already Exists");
    } else {
        Database::iud("INSERT INTO `color` (`name`) VALUE ('" . $color . "')");
        echo ("success");
    }
}
