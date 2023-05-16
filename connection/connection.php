<?php
session_start();
$server = "localhost";
$user = "root";
$password = "";
$db = "visiting_card_db";

$connection = mysqli_connect($server, $user, $password, $db);

if(!$connection)
    echo "nu s a conectat... " . mysqli_connect_error();

?>