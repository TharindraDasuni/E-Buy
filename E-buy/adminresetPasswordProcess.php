<?php

require "connection.php";

$email = $_POST["e"];
$np = $_POST["n"];
$rnp = $_POST["r"];
$vcode = $_POST["v"];

if(empty($email)){
    echo ("No Email Address Provided");
}else if(empty($vcode)){
    echo ("Please enter Verification Code");
}else if(empty ($np)){
    echo ("Please Enter New Password");
}else if(strlen($np) < 5 || strlen($np) > 20){
    echo ("Password Length is 5 - 20");
}else if(empty($rnp)){
    echo ("Please Confirm Your Password");
}else if($np != $rnp){
    echo ("Password does not matched");
}else{

    $rs = Database::search("SELECT * FROM `admin` WHERE 
    `email`='".$email."' AND `verification_code`='".$vcode."'");
    $n = $rs->num_rows;

    if($n == 1){

        Database::iud("UPDATE `admin` SET `password`='".$np."' WHERE 
        `email`='".$email."'");
        echo ("success");

    }else{

        echo ("Invalid Email or Verification Code");

    }

}

?>