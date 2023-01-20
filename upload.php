<?php
$server = "localhost";
$user = "mihaiprodan";
$password = "1234";
$db = "DB_OSA";

$connection = mysqli_connect($server, $user, $password, $db);
session_start();
if(isset($_POST['submitChanges']))
{
    $username = $_POST['username'];
    $full_name = $_POST['full_name'];
    $about_me = $_POST['about_me'];
    $email = $_POST['email'];
    $instagram = $_POST['instagram'];
    $facebook = $_POST['facebook'];
    $whatsapp = $_POST['whatsapp'];
    $backgroundColor = $_POST['backgroundColor'];
    $photo = $_POST['photo'];
    $query = "update users set username = '".$username."', email = '".$email."', photo = '".$photo."', full_name = '".$full_name."', about_me = '".$about_me."', instagram = '".$instagram."', facebook = '".$facebook."', whatsapp = '".$whatsapp."', backgroundColor = '".$backgroundColor."' where username = '".$_SESSION['username']."'";
    $results = mysqli_query($connection, $query);
    mysqli_query($connection, $query);
    unset($_SESSION["username"]);
    $_SESSION["username"] = $username;
    //echo $query;
    header("Location: profile.php?userid=".$username."");
}
?>