<?php
    include './connection/connection.php';
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
                    echo '<a class="navbar-brand ml-2" style="color: white; user-select: none; margin-left: 20px;">HOMEPAGE</a>';
                }
            ?>
        </nav> 
   
        <div class="container text-white">
            <div class="row">
                <div class="col-12 text-center mt-5">
                    <h1 style="font-weight: bolder; font-size: 100px">Your online visiting card</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center mt-5">
                    <h2 style="font-weight: bolder; font-size: 50px">Your insights</h2>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col">
                <div class="card bg-dark text-center">
                    <div class="card-header">
                        The last person who visited your profile is...
                    </div>
                    <div class="card-body">
                        <blockquote class="blockquote mb-0">
                            <p>
                                <?php
                                    $sql = "SELECT * FROM `users` WHERE `username` = '".$_SESSION['username']."'";
                                    $result = mysqli_query($connection, $sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $last = $row['last_visitator'];
                                echo '<a href="profile.php?userid=' . $last . '" style="color: white; text-decoration: none; font-weight: bolder; font-size: 30px;">' . $last . '</a>';
                                ?>
                            </p>
                        </blockquote>
                    </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col">
                <div class="card bg-dark text-center">
                    <div class="card-header">
                        Your profile rating is...
                    </div>
                    <div class="card-body">
                        <blockquote class="blockquote mb-0">
                            <p>
                                <?php
                                    $total_rating_query = "SELECT SUM(`rating`) AS `total_rating` FROM `ratings` WHERE `rated_user` = '".$_SESSION['username']."'";
                                    $total_rating_result = mysqli_query($connection, $total_rating_query);
                                    $total_rating = mysqli_fetch_array($total_rating_result)[0];

                                    $number_of_ratings_query = "SELECT COUNT(`rating`) AS `number_of_ratings` FROM `ratings` WHERE `rated_user` = '".$_SESSION['username']."'";
                                    $number_of_ratings_result = mysqli_query($connection, $number_of_ratings_query);
                                    $number_of_ratings = mysqli_fetch_array($number_of_ratings_result)[0];

                                    $rating = $total_rating / $number_of_ratings;
                                    if((int)$number_of_ratings > 0)
                                        echo '<p style="color: white; text-decoration: none; font-weight: bolder; font-size: 30px;">'.number_format((float)$rating, 2, '.', '').'</p>';
                                    else
                                        echo '<p style="color: white; text-decoration: none; font-weight: bolder; font-size: 30px;">No one rated you yet.</p>';
                                ?>
                            </p>
                        </blockquote>
                    </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col">
                <div class="card bg-dark text-center">
                    <div class="card-header">
                        The last person who rated your profile is...
                    </div>
                    <div class="card-body">
                        <blockquote class="blockquote mb-0">
                            <p>
                                <?php
                                    $person_query = "SELECT username FROM `ratings` WHERE `rated_user` = '".$_SESSION['username']."' ORDER BY `id` DESC LIMIT 1";
                                    $person_result = mysqli_query($connection, $person_query);
                                    $person = mysqli_fetch_array($person_result)[0];

                                    $rating_query = "SELECT rating FROM `ratings` WHERE `rated_user` = '".$_SESSION['username']."' ORDER BY `id` DESC LIMIT 1";
                                    $rating_result = mysqli_query($connection, $rating_query);
                                    $rating = mysqli_fetch_array($rating_result)[0];

                                    if((int)$number_of_ratings > 0)
                                        echo '<p style="color: white; text-decoration: none; font-weight: bolder; font-size: 30px;">'.$person.', who rated you '.$rating.' out of 10.</p>';
                                    else
                                        echo '<p style="color: white; text-decoration: none; font-weight: bolder; font-size: 30px;">No one rated you yet.</p>';
                                ?>
                            </p>
                        </blockquote>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
<style>
textarea:focus, input:focus{
    outline: none;
}
</style>
</html>
