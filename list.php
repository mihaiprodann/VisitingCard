<?php
session_start();
$server = "localhost";
$user = "mihaiprodan";
$password = "1234";
$db = "DB_OSA";

$connection = mysqli_connect($server, $user, $password, $db);

if(!$connection)
    echo "nu s a conectat... " . mysqli_connect_error();

?>

<html>
    <head>
        <title>Your visiting card</title>   
        <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script> 
    </head>
    <body style="background-image: url(bg.jpg); background-position: center; background-size: cover;">  
        <nav class="navbar d-flex justify-content-between" style="background-color: rgba(0, 0, 0, 0.61); backdrop-filter: blur(5px);">
            <?php
                if(isset($_SESSION['username'])) {
                    echo '<a class="navbar-brand" href="index.php" style="color: white; user-select: none; margin-left: 20px;">HOMEPAGE</a>';
                    echo '<a class="navbar-brand" href="profile.php?userid='.$_SESSION['username'].'" style="color: white; user-select: none; margin-left: 20px;">Logged in as '.$_SESSION['username'].'</a>';
                }
                else
                {
                    echo '<a class="navbar-brand ml-2" href="index.php" style="color: white; user-select: none; margin-left: 20px;">HOMEPAGE</a>';
                }
            ?>
        </nav> 
   
        <div class="container text-white">
            <div class="row">
                <div class="col-12 text-center mt-5">
                    <h1 style="font-weight: bolder; font-size: 80px">Get in touch with our users</h1>
                </div>
            </div>
            <div class="row">
                <?php
                    $sql = "SELECT * FROM users";
                    $result = mysqli_query($connection, $sql);
                    while($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="col-3 mt-5 d-flex text-center justify-content-center">';
                        echo '<div class="card bg-dark" style="width: 12rem;">';
                        echo '<img src="'.$row['photo'].'" height = "150px" class="card-img-top" alt="...">';
                        echo '<div class="card-body text-center">';
                        echo '<h5 class="card-title">'.$row['username'].'</h5>';
                        echo '<p class="card-text">'.$row['description'].'</p>';
                        echo '<a href="profile.php?userid='.$row['username'].'" class="btn btn-outline-light mt-2 btn-block">Go to profile</a>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                ?>
            </div>
            <br><br><br>
        </div>
    </body>
</html>