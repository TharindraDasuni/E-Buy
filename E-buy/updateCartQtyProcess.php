<?php
session_start();
include "connection.php";

$cartId = $_POST["c"];
$newQty = $_POST["q"];
// echo($newQty);

$rs = Database::search("SELECT * FROM `cart` INNER JOIN `product`
ON `cart`.`product_id`=`product`.`id` WHERE `cart`.`id` = '" . $cartId . "'");

$num = $rs->num_rows;

if ($num > 0) {
    $d = $rs->fetch_assoc();

    if ($d["qty"] >= $newQty) {
        Database::iud("UPDATE `cart` SET `qty` = '" . $newQty . "' WHERE `id`='" . $cartId . "'");
        echo ("success");
    } else {
        echo ("Product Quantity Exceeded");
    }
} else {
    echo ("Cart Item Not Found");
}
