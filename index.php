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
            <?php
                if(isset($_SESSION['username']))
                {
                    echo '
                        <div class="row">
                            <div class="col text-center mt-5">
                                <h2>Hi, ' . $_SESSION['username'] . '!</h2>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col text-center">
                            <h3>Search for someone\'s visiting card</h3>
                            <form action="" method="POST">
                                <div class="form-group mt-5 text-center">
                                    <label for="usernameToSearch">Search for someones username</label>
                                    <input name = "usernameToSearch" type="text" class="form-control" style="background-color: rgba(255, 255, 255, 0.05); border: 0; border-bottom: 1px solid white; text-align: center; color: white;" id="usernameToSearch"\>
                                    <input name="searchButtonX" type="submit" class="btn btn-outline-light mt-2 w-100 btn-lg btn-block" value="Search">
                                    <input name="randomButtonX" type="submit" class="btn mt-5 btn-outline-light mt-2 w-100 btn-lg btn-block" value="Show me a random visiting card">
                                    <input name="listButtonX" type="submit" class="btn btn-outline-light mt-2 w-100 btn-lg btn-block" value="Get in touch with other users">
                                </div>
                            </form>
                        </div>
                        
                    ';
                    if(isset($_POST['searchButtonX'])) {
                        header("Location: profile.php?userid=".$_POST['usernameToSearch']);
                    }
                    if(isset($_POST['randomButtonX']))
                    {
                        #select a random user from users table
                        $sql = "SELECT * FROM users ORDER BY RAND() LIMIT 1";
                        $result = mysqli_query($connection, $sql);
                        $row = mysqli_fetch_assoc($result);
                        header("Location: profile.php?userid=".$row['username']);
                    }
                    if(isset($_POST['listButtonX']))
                    {
                        header("Location: list.php");
                    }
                    echo '
                            <div class="col">
                            <div class="row">
                            <div class="col text-center">
                                <h3><a href="profile.php?userid='.$_SESSION['username'].'" style="color: white;">Here</a> you can see your visiting card.</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-center mt-2">
                                <h3><a href="edit.php" style="color: white;">Here</a> you can edit your visiting card.</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-center mt-2">
                                <h3><a href="insights.php" style="color: white;">Here</a> you can see your insights.</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4"></div>
                            <div class="col-4 text-center mt-5">
                                <form action="" method="post">
                                    <input name="logoutButton" type="submit" class="btn btn-outline-light mt-2 w-100 btn-lg btn-block" value="Logout">
                                </form>
                            </div>
                            <div class="col-4"></div>
                        </div>
                            </div>
                        </div>
                    ';
                    if (isset($_POST['logoutButton'])) {
                        unset($_SESSION['username']);
                        header("refresh:0; url=index.php");
                    }
                }
                else
                {
                    echo '
                        <div class="row">
                            <div class="col text-center mt-5">
                            <blockquote class="blockquote text-right">
                            <p class="mb-0">"Connect with others in a modern and professional way with our online visiting cards"</p>
                          </blockquote>
                            </div>
                        </div>
                        <div class="row mt-5">
                    ';
                    echo '
                            <div class="col-5 text-center">
                                <h3>Search for someone\'s visiting card</h3>
                                <form action="" method="POST">
                                    <div class="form-group mt-5 text-center">
                                        <label for="usernameToSearch">Search for someones username</label>
                                        <input name = "usernameToSearch" type="text" class="form-control" style="background-color: rgba(255, 255, 255, 0.05); border: 0; border-bottom: 1px solid white; text-align: center; color: white;" id="usernameToSearch"\>
                                        <input name="searchButton" type="submit" class="btn btn-outline-light mt-2 w-100 btn-lg btn-block" value="Search">
                                        <input name="randomButtonX" type="submit" class="btn mt-5 btn-outline-light mt-2 w-100 btn-lg btn-block" value="Show me a random visiting card">
                                        <input name="listButtonX" type="submit" class="btn btn-outline-light mt-2 w-100 btn-lg btn-block" value="Get in touch with other users">    
                                    </div>
                                </form>
                            </div>
                    ';
                    if(isset($_POST['randomButtonX']))
                    {
                        #select a random user from users table
                        $sql = "SELECT * FROM users ORDER BY RAND() LIMIT 1";
                        $result = mysqli_query($connection, $sql);
                        $row = mysqli_fetch_assoc($result);
                        header("Location: profile.php?userid=".$row['username']);
                    }
                    if(isset($_POST['listButtonX']))
                    {
                        header("Location: list.php");
                    }
                    if (isset($_POST['searchButton'])) {
                        header("Location: profile.php?userid=" . $_POST['usernameToSearch']);
                    }
                    echo '
                            <div class="col-2"></div>
                            <div class="col-5 text-center mt-5">
                                <form action="" method="POST">
                                    <div class="form-group mt-2">
                                        <label for="username">Username:</label>
                                        <input type="username" class="form-control" style="background-color: rgba(255, 255, 255, 0.05); border: 0; border-bottom: 1px solid white; text-align: center; color: white;" name = "username">
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="pwd">Password:</label>
                                        <input type="password" class="form-control" style="background-color: rgba(255, 255, 255, 0.05); border: 0; border-bottom: 1px solid white; text-align: center; color: white;" name = "password">
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="repeat_password">Repeat password:</label>
                                        <input type="password" class="form-control" style="background-color: rgba(255, 255, 255, 0.05); border: 0; border-bottom: 1px solid white; text-align: center; color: white;" name = "repeatPassword">
                                    </div>
                                    <input name="registerBtn" type="submit" class="btn btn-outline-light mt-2 w-100 btn-lg btn-block" value="Register">
                                </form>
                                <p>Already have an account? <a href="login.php" style="color: white;">Login</a></p>
                            </div>
                        </div>
                    ';

                    //Register
                if (isset($_POST['registerBtn'])) {
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $repeatPassword = $_POST['repeatPassword'];
                    if ($password == $repeatPassword) {
                        $query = "SELECT * FROM users WHERE username = '$username'";
                        $result = mysqli_query($link, $query);
                        if (mysqli_num_rows($result) > 0) {
                            echo '<div class="alert alert-danger" role="alert">
                                This username is already taken!
                              </div>';
                        } else {

                            #check if username is taken
                            $query = "SELECT * FROM users WHERE username = '$username'";
                            $result = mysqli_query($connection, $query);
                            if(mysqli_num_rows($result)) {
                                echo '<div class="alert alert-danger" role="alert">
                                This username is already taken!
                              </div>';
                            } else {
                                $sql = "INSERT INTO users (username, password) VALUES ('" . $username . "', '" . $password . "')";
                                $result = mysqli_query($connection, $sql);
                                echo '<div class="alert alert-success" role="alert">
                                Account created. You can now <a href="login.php" style="color: #227538;">log in</a>.
                              </div>';
                            }
                        }
                    } else {
                        echo '<div class="alert alert-danger" role="alert">
                            Passwords do not match!
                          </div>';
                    }
                }
                    
                }
            ?>
        </div>
    </body>
<style>
textarea:focus, input:focus{
    outline: none;
}
</style>
</html>
