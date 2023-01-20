<html>
    <head>
        <title>Your visiting card</title>   
        <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script> 
    </head>
    <body style="background-image: url(bg.jpg); background-position: center; background-size: cover;">  
        <nav class="navbar d-flex justify-content-center text-center" style="background-color: rgba(0, 0, 0, 0.61); backdrop-filter: blur(5px);">
            <a class="navbar-brand ml-2" href="index.php" style="color: white; user-select: none; margin-left: 20px;">HOMEPAGE</a>
        </nav>    
        <div class="container text-white">
            <div class="row">
                <div class="col-12 text-center mt-5">
                    <h1 style="font-weight: bolder; font-size: 100px">Your online visiting card</h1>
                </div>
            </div>
            <div class="row">
                <div class="col text-center mt-5">
                <blockquote class="blockquote text-right">
                <p class="mb-0">"Connect with others in a modern and professional way with our online visiting cards"</p>
              </blockquote>
                </div>
            </div>
            <div class="row">
                <div class="col-3"></div>
                <div class="col-6 text-center">
                    <form action="" method="POST">
                        <div class="form-group mt-5">
                            <label for="email">Your username</label>
                            <input name="username" type="text" class="form-control" style="background-color: rgba(255, 255, 255, 0.05); border: 0; border-bottom: 1px solid white; text-align: center; color: white;"/>
                        </div>
                        <div class="form-group mt-4">
                            <label for="pwd">Your password</label>
                            <input name="password" type="password" class="form-control" style="background-color: rgba(255, 255, 255, 0.05); border: 0; border-bottom: 1px solid white; text-align: center; color: white;"/>
                        </div>
                        <input name="loginButton" type="submit" class="btn btn-outline-light mt-2 w-100 btn-lg btn-block" value="Login">
                    </form>
                </div>
                <div class="col-3"></div>
            </div>
            <?php
                if(isset($_POST['loginButton'])) {
                    session_start();
                    $server = "localhost";
                    $user = "mihaiprodan";
                    $password = "1234";
                    $db = "DB_OSA";

                    $connection = mysqli_connect($server, $user, $password, $db);

                    if(!$connection)
                        echo "nu s a conectat... " . mysqli_connect_error();

                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
                    $runquery = mysqli_query($connection, $query);
                    if(mysqli_num_rows($runquery) == 1) {
                        $_SESSION['username'] = $username;
                        header("Location: index.php");
                    }
                    else {
                        echo "<div class='row'>
                                <div class='col-3'></div>
                                <div class='col-6 text-center'>
                                    <div class='alert alert-danger mt-5' role='alert'>
                                        Wrong username or password!
                                    </div>
                                </div>
                                <div class='col-3'></div>
                            </div>";
                    } 
                }
            ?>
        </div>
    </body>
</html>