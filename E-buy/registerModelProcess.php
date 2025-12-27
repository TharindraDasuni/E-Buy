<?php

include "connection.php";

$model = $_POST["m"];

if (empty($model)) {
    echo ("Please Enter Your model");
} else if (strlen($model) > 20) {
    echo ("Your model Should be less than 20 Characters");
} else {

    $rs = Database::search("SELECT * FROM `model` WHERE `name` = '" . $model . "'");
    $num = $rs->num_rows;

    if ($num > 0) {
        echo ("Your Model is Already Exists");
    } else {
        Database::iud("INSERT INTO `model` (`name`) VALUE ('" . $model . "')");
        echo ("success");
    }
}
