<?php
session_start();

include "connection.php";

$brand = $_POST["b"];

if (empty($brand)) {
    echo ("Please Provide Your Brand Name");
} else if (strlen($brand) > 20) {
    echo ("Brand Name should be less than 20 characters");
} else {
    $rs = Database::search("SELECT * FROM `brand` WHERE `name`='" . $brand . "'");
    $num = $rs->num_rows;

    if ($num > 0) {
        echo ("Brand Already Exists");
    } else {
        Database::iud("INSERT INTO `brand` (`name`) VALUES ('" . $brand . "')");
        echo ("success");
    }
}
