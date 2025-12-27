<?php

include "connection.php";

$cat = $_POST["c"];

if (empty($cat)) {
    echo ("Please Provide Your Product Category");
} else if (strlen($cat) > 20) {
    echo ("The Category should be less than 20 Characters");
} else {

    $rs = Database::search("SELECT * FROM `category` WHERE `name`='" . $cat . "'");
    $num = $rs->num_rows;

    if ($num > 0) {
        echo ("The Category Already Exists");
    } else {
        Database::iud("INSERT INTO `category` (`name`) VALUE ('" . $cat . "')");
        echo ("success");
    } 
}
