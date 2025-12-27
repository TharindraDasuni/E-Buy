<?php
session_start();

require "connection.php";

$email = $_POST["e"];
$password = $_POST["pw"];
$vCode = $_POST["vcode"];


if (empty($vCode)) {
    echo ("Please Provide Verification Code");
} else {

    $rs = Database::search("SELECT * FROM `admin` WHERE `email`='" . $email . "' AND `verification_code`='" . $vCode . "'");
    $n = $rs->num_rows;

    if ($n == 1) {

        echo ("success");
        $d = $rs->fetch_assoc();
        $_SESSION["a"] = $d;

    } else {
        echo ("Invalid Verification Code");
    }
}
