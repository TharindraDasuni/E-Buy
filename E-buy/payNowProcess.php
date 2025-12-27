<?php

session_start();
require "connection.php";

if (isset($_SESSION["u"])) {

    if (isset($_post["payment"])) {
        $payment = json_decode($_POST["payment"], true);

        $date = new DateTime();
        $date->setTimezone(new DateTimeZone("Asia/Colombo"));
        $time = $date->format("Y-m-d H-i-s");

        Database::iud("INSERT INTO `invoice` (`order_id`,`date`,`total`,`user_email`)
VALUES ('" . $payment["order_id"] . "','" . $time . "','" . $payment["total"] . "','" . $user["email"] . "')");

        $orderHistoryId = Database::$connection->insert_id;

        $rs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $payment["product_id"] . "'");
        $num = $rs->num_rows;

        for ($i = 0; $i < $num; $i++) {
            $d = $rs->fetch_assoc();

            Database::iud("INSERT INTO `invoice` (`qty`,`order_id`,`product_id`)
VALUES ('" . $d["cart_qty"] . "','" . $orderHistoryId . "','" . $d["product_id"] . "')");

            $rs2 = Database::search("SELECT * FROM `product` WHERE `id` = '" . $payment["product_id"] . "'");
            $d2 = $rs2->fetch_assoc();

            $newQty = $d2["qty"] - $d["qty"];
            Database::iud("UPDATE `product` SET `qty` = '" . $newQty . "' WHERE `id` = '" . $d["product_id"] . "'");

            // echo ("success");
           
            $order = array();
            $order["resp"] = "success";
            $order["order_id"] = $oid;
        
            echo json_encode($order);
        }
    }


    $pid = $_GET["id"];
    $qty = $_GET["qty"];
    $umail = $_SESSION["u"]["email"];

    $array;

    $orderId = uniqid();

    $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $pid . "'");
    $product_data = $product_rs->fetch_assoc();

    $city_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $umail . "'");
    $city_num = $city_rs->num_rows;

    if ($city_num == 1) {
        $city_data = $city_rs->fetch_assoc();

        $city_id = $city_data["city_id"];
        $address = $city_data["line1"] . "," . $city_data["line2"];

        $district_rs = Database::search("SELECT * FROM `city` WHERE `id`='" . $city_id . "'");
        $district_data = $district_rs->fetch_assoc();

        $district_id = $district_data["district_id"];
        $delivery = 0;

        if ($district_id == 1) {
            $delivery = $product_data["delivery_fee_colombo"];
        } else {
            $delivery = $product_data["delivery_fee_other"];
        }

        $item = $product_data["title"];
        $amount = ((int)$product_data["price"] * (int)$qty) + (int)$delivery;

        $fname = $_SESSION["u"]["fname"];
        $lname = $_SESSION["u"]["lname"];
        $mobile = $_SESSION["u"]["mobile"];
        $uaddress = $address;
        $city = $district_data["name"];

        $merchant_id = "1222483";
        $merchant_secret = "NjI0NjgzNTk3MTQxOTIzNjYxNDIxOTkwNzI5MzIxNjkzMTQyNTU=";
        $currency = "LKR";

        $hash = strtoupper(
            md5(
                $merchant_id .
                    $orderId .
                    number_format($amount, 2, '.', '') .
                    $currency .
                    strtoupper(md5($merchant_secret))
            )
        );

        $array["id"] = $orderId;
        $array["item"] = $item;
        $array["amount"] = $amount;
        $array["fname"] = $fname;
        $array["lname"] = $lname;
        $array["mobile"] = $mobile;
        $array["address"] = $uaddress;
        $array["umail"] = $umail;
        $array["city"] = $city;
        $array["hash"] = $hash;

        echo json_encode($array);
    } else {
        echo ("address error");
    }
}
// else{
//     echo ("Please Login First");
// }
