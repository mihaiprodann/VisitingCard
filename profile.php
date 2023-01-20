<?php
session_start();
$server = "localhost";
$user = "mihaiprodan";
$password = "1234";
$db = "DB_OSA";

$connection = mysqli_connect($server, $user, $password, $db);

if(!$connection)
    echo "nu s a conectat... " . mysqli_connect_error();

#check if user exists and url is valid
if(isset($_GET['userid']))
{
    $userid = $_GET['userid'];
    $sql = "SELECT * FROM users WHERE username = '$userid'";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($result);
    if($row)
    {
        $username = $row['username'];
        $email = $row['email'];
        $phone = $row['whatsapp'];
        $instagram = $row['instagram'];
        $facebook = $row['facebook'];
        $about_me = $row['about_me'];
        $photo = $row['photo'];
        $full_name = $row['full_name'];
    }
    else
    {
        header("Location: index.php");
    }
} else
    header("Location: index.php");

?>

<html>

<head>
    <title>Your visiting card</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</head>

<body style="background-image: url(bg.jpg); background-position: center; background-size: cover;">
    <nav class="navbar d-flex justify-content-between"
        style="background-color: rgba(0, 0, 0, 0.61); backdrop-filter: blur(5px);">
        <?php
                if(isset($_SESSION['username'])) {
                    echo '<a class="navbar-brand" href="index.php" style="color: white; user-select: none; margin-left: 20px;">HOMEPAGE</a>';
                    echo '<a class="navbar-brand" href="profile.php?userid='.$_SESSION['username'].'" style="color: white; user-select: none; margin-left: 20px;">Logged in as '.$_SESSION['username'].'</a>';
                }
                else
                {
                    echo '<a class="navbar-brand ml-2" href="index.php" style="color: white; user-select: none; margin-left: 20px;">HOMEPAGE</a>';
                    echo '<a class="navbar-brand" style="color: white; user-select: none; margin-left: 20px;">You are not logged in.</a>';
                }
            ?>
    </nav>
    <div class="container">
        <!-- user visiting card-->
        <section style="background-color: rgb(33, 37, 41); box-shadow: 0px 0px 26px -8px rgb(33, 37, 41);">
            <div class="row mt-5 rounded">
                <div class="col-lg-4">
                    <div class="card mb-4 border-0">
                        <div class="card-body bg-dark text-center border-0 text-white">
                            <img <?php ?> alt="avatar" src="<?php echo $photo ?>" class="img-fluid" width="200"
                                height="500">
                            <h5 class="my-3"><?php
                                echo $_GET['userid'];
                            ?></h5>

                            <!-- insights -->
                            <?php
                                #check if the logged user is the same as the one he is visiting
                                if(isset($_SESSION['username']) && $_SESSION['username'] == $_GET['userid'])
                                {
                                    echo '<a href="insights.php" class="btn btn-outline-light">Insights</a>';
                                }
                            ?>
                            <!-- rating -->
                            <?php
                                #check if logged user is different than the one he is rating
                                if(isset($_SESSION['username']) && $_SESSION['username'] != $_GET['userid'])
                                {
                                    $sql = "SELECT * FROM ratings WHERE username = '".$_SESSION['username']."' AND rated_user = '".$_GET['userid']."'";
                                    $result = mysqli_query($connection, $sql);
                                    $row = mysqli_fetch_array($result);
                                    if($row)
                                    {
                                        echo '<p class="mb-0">You have already rated this user. ('.$row['rating'].'/10)</p>';
                                    }
                                    else
                                    {
                                        echo '
                                        <form class="form-inline" action="" method="POST">
                                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Rate user</label>
                                            <select style="font-size: 16px; background: transparent; color: white; border: 0;" class="custom-select my-1 mr-sm-2" name="ratingSelect">
                                                <option style="color: white; background-color: rgb(33, 37, 41)" selected value="1">1</option>
                                                <option style="color: white; background-color: rgb(33, 37, 41)" value="2">2</option>
                                                <option style="color: white; background-color: rgb(33, 37, 41)" value="3">3</option>
                                                <option style="color: white; background-color: rgb(33, 37, 41)" value="4">4</option>
                                                <option style="color: white; background-color: rgb(33, 37, 41)" value="5">5</option>
                                                <option style="color: white; background-color: rgb(33, 37, 41)" value="6">6</option>
                                                <option style="color: white; background-color: rgb(33, 37, 41)" value="7">7</option>
                                                <option style="color: white; background-color: rgb(33, 37, 41)" value="8">8</option>
                                                <option style="color: white; background-color: rgb(33, 37, 41)" value="9">9</option>
                                                <option style="color: white; background-color: rgb(33, 37, 41)" value="10">10</option>
                                            </select>
                                        
                                            <div class="d-flex justify-content-center mb-2">
                                                <input type="submit" name="submitRating" class="btn btn-outline-light ms-1" value = "Submit rating">
                                            </div>
                                        </form>';
                                        #submit rating
                                        if(isset($_POST['submitRating']))
                                        {
                                            $rating = $_POST['ratingSelect'];
                                            $sql = "INSERT INTO ratings (username, rated_user, rating) VALUES ('".$_SESSION['username']."', '".$_GET['userid']."', '".$rating."')";
                                            $result = mysqli_query($connection, $sql);
                                            if($result)
                                            {
                                                echo '<script>window.location.href = "profile.php?userid='.$_GET['userid'].'";</script>';
                                            }
                                            else
                                            {
                                                echo '<script>alert("Rating could not be submitted.");</script>';
                                            }
                                        }
                                    }
                                }

                            ?>
                            <!-- end of rating -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 mt-5">
                    <div class="card bg-dark text-white mb-4">
                        <div class="card-body">
                            <?php
                            $sql = "SELECT * FROM users WHERE username = '".$_GET['userid']."'";
                            $result = mysqli_query($connection, $sql);
                            $row = mysqli_fetch_array($result);
                        ?>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Full Name</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?php echo $full_name ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Email</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?php echo $row['email'] ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Phone</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?php echo $row['whatsapp'] ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Facebook</p>
                                </div>
                                <div class="col-sm-9">
                                    <a href="<?php echo $row['facebook'] ?>" target="_blank"
                                        class="text-white mb-0"><?php echo $row['facebook'] ?></a>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Instagram</p>
                                </div>
                                <div class="col-sm-9">
                                    <a href="<?php echo $row['instagram'] ?>" target="_blank"
                                        class="text-white mb-0"><?php echo $row['instagram'] ?></a>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">About me</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?php echo $row['about_me'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php
            if(isset($_SESSION['username']) && $_SESSION['username'] != $_GET['userid'])
            {
                echo '<div class="row">';
                echo '    <div class="col-3"></div>';
                echo '    <div class="col-6 text-center text-white mt-5">';
                echo '        <h3>Leave a comment on '.$_GET['userid'].'\'s visiting card</h3>';
                echo '        <form action="" method="post">';
                echo '            <div class="form-group">';
                echo '                <textarea class="form-control" name="comment" id="exampleFormControlTextarea1" rows="3"></textarea>';
                echo '                <input type="submit" class="btn btn-outline-light mt-3" name="submitComment" value="Submit comment">';
                echo '            </div>';
                echo '        </form>';
                echo '    </div>';
                echo '    <div class="col-3"></div>';
                echo '</div>';
            }

            #submit comment
            if(isset($_POST['submitComment']) && !empty($_POST['comments']))
            {
            echo 'dada';
                $comment = $_POST['comment'];
                $sql = "INSERT INTO comments (message, receiver_username, sender_username) VALUES ('$comment', '".$_GET['userid']."','".$_SESSION['username']."')";
                echo $sql;
                //$result = mysqli_query($connection, $sql);
                /*if($result)
                {
                    header("Location: profile.php?userid=".$_GET['userid']);
                }
                else {
                    echo "Error. Please try again";
                }*/
            }
        ?>

        <!-- comments -->

        <?php
            $sql = "SELECT * FROM comments WHERE receiver_username = '".$_GET['userid']."'";
            $result = mysqli_query($connection, $sql);
            $row = mysqli_fetch_array($result);
            if(mysqli_num_rows($result) == 0 || empty($row))
            {
                echo '<div class="row mb-5">';
                echo '<div class="col-3"></div>';
                echo '<div class="col-6 text-center text-white mt-5">';
                echo '<h3>There are no comments yet</h3>';
                echo '</div>';
                echo '<div class="col-3"></div>';
                echo '</div>';
            }
            else {
                echo '<div class="row">';
                echo '<div class="col-3"></div>';
                echo '<div class="col-6 text-center text-white mt-5">';
                echo '<h3>Comments</h3>';
                echo '</div>';
                echo '<div class="col-3"></div>';
                echo '</div>';
                $sql = "SELECT * FROM comments WHERE receiver_username = '".$_GET['userid']."' ORDER BY id DESC";
                $result = mysqli_query($connection, $sql);
                while($row = mysqli_fetch_array($result))
                {
                    echo '<div class="card bg-dark text-white mb-4">';
                    echo '<div class="card-body">';
                    echo '<div class="row">';
                    echo '<div class="col-sm-3">';
                    echo '<p class="mb-0">Comment</p>';
                    echo '</div>';
                    echo '<div class="col-sm-9">';
                    echo '<p class="text-muted mb-0">'.$row['message'].'</p>';
                    echo '</div>';
                    echo '</div>';
                    echo '<hr>';
                    echo '<div class="row">';
                    echo '<div class="col-sm-3">';
                    echo '<p class="mb-0">Commented by</p>';
                    echo '</div>';
                    echo '<div class="col-sm-9">';
                    echo '<a href="profile.php?userid='.$row['sender_username'].'" class="text-muted mb-0">'.$row['sender_username'].'</a>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            }
        ?>
    </div>
</body>

</html>

<script>
if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}
</script>