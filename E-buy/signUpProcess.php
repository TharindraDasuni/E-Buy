<?php

require "connection.php";

$f = $_POST["f"];
$l = $_POST["l"];
$e = $_POST["e"];
$p = $_POST["p"];
$m = $_POST["m"];

if(empty($f)){
    echo ("Please Provide Your First Name");
}else if(strlen($f) > 30){
    echo ("Max Character Limit is 30");
}else if(empty($l)){
    echo ("Please Provide Your Last Name");
}else if(strlen($l) > 30){
echo("Max Character Limit is 30");
}else if(empty($e)){
    echo ("Please Provide Email Address");
}else if (strlen($e) > 80){
    echo ("Email Address is too long.");
}else if (!filter_var($e,FILTER_VALIDATE_EMAIL)){
    echo ("Invalid Email Address");
}else if (empty($p)){
    echo ("Please Enter a Password");
}else if(strlen($p) < 5 || strlen($p) > 20){
    echo ("Password Length is 5 - 20");
}else if(empty($m)){
echo("Please Provide Contact Number");
}else if(strlen($m) != 10){
    echo ("Contact Number Length is 10");
}else if(!preg_match("/07[0,1,2,4,5,6,7,8][0-9]{7}/",$m)){
echo ("Invalid Contact Number");
}else{

$rs = Database::search("SELECT * FROM `user` WHERE `email`='".$e."' OR 
`mobile`='".$m."'");
$n = $rs->num_rows;

if($n > 0){
    echo("Email or Contact Already Exists");
}else{

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    Database::iud("INSERT INTO `user`
    (`fname`,`lname`,`email`,`password`,`mobile`,`joined_date`,`status`)
    VALUES ('".$f."','".$l."','".$e."','".$p."','".$m."','".$date."','1')");

    echo("success");
}

}
