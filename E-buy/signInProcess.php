<?php
session_start();

require "connection.php";

$email = $_POST["e"];
$password = $_POST["pw"];
$rememberme = $_POST["rm"];

if (empty($email)) {
    echo ("Please Provide A Email Address");
} else if (empty($password)) {
    echo ("Please Provide Your Password");
} else {

    $rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "' AND `password`='" . $password . "'");
    $n = $rs->num_rows;

    if ($n == 1) {

        echo ("success");
        $d = $rs->fetch_assoc();
        $_SESSION["u"] = $d;

        if ($rememberme == "true") {

            setcookie("email", $email, time() + (60 * 60 * 24 * 365));
            setcookie("password", $password, time() + (60 * 60 * 24 * 365));
        } else {
            setcookie("email", "", -1);
            setcookie("password", "", -1);
        }
        
    } else {
        echo ("Invalid Email or Password");
    }
}
