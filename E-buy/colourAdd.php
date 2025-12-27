<?php

require "connection.php";

$colour = $_GET["clr"];

if (empty($colour)) {
    echo ("Please add the colour.");
} else {

    Database::iud("INSERT INTO `color` (`name`) VALUES ('" . $colour . "')");
    echo ("success");

}
