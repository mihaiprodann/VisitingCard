<?php
session_start();
$server = "localhost";
$user = "mihaiprodan";
$password = "1234";
$db = "DB_OSA";

$connection = mysqli_connect($server, $user, $password, $db);

if(!$connection)
    die("eroare de conexiune");
if(!isset($_SESSION["username"]))
{
    header("Location: index.php");
}
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
                    <h2 style="font-weight: bolder; font-size: 50px">Edit your online visiting card</h2>
                </div>
            </div>
            <form action="" method="POST">
            <div class="row mt-5">
                <div class="col-6">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" style="background-color: rgba(255, 255, 255, 0.05); border: 0; border-bottom: 1px solid white; text-align: center; color: white;" name = "username"
                            value = "<?php
                                $query = "SELECT * FROM users WHERE username = '".$_SESSION['username']."'";
                                $result = mysqli_query($connection, $query);
                                $row = mysqli_fetch_assoc($result);
                                echo $row['username'];?>"   
                    >       
                        
                        <label for="email" class="mt-4">Email:</label>
                        <input type="email" class="form-control" style="background-color: rgba(255, 255, 255, 0.05); border: 0; border-bottom: 1px solid white; text-align: center; color: white;" name = "email"
                            value = "<?php
                                echo $row['email'];?>"
                        >
                        
                        <label for="full_name" class="mt-4">Full name:</label>
                        <input type="text" class="form-control" style="background-color: rgba(255, 255, 255, 0.05); border: 0; border-bottom: 1px solid white; text-align: center; color: white;" name = "full_name"
                            value = "<?php
                                echo $row['full_name'];?>"
                        >
                        
                        <label for="about_me" class="mt-4">About me</label>
                        <textarea type="text" class="form-control" style="background-color: rgba(255, 255, 255, 0.05); border: 0; border-bottom: 1px solid white;color: white;" cols="40" rows="5" name = "about_me">
                        <?php
                                echo $row['about_me'];
                        ?>
                        </textarea>
                </div>
                <div class="col-6">
                        <label for="phone_number" class="mt-4">Phone number:</label>
                        <input type="text" class="form-control" style="background-color: rgba(255, 255, 255, 0.05); border: 0; border-bottom: 1px solid white; text-align: center; color: white;" name = "phone_number"
                            value = "<?php
                                echo $row['whatsapp'];?>"
                        >
                   
                        <label for="photo" class="mt-4">Photo: <sup><a target="_blank" href="<?php echo $row['photo'] ?>">(view actual photo)</a></sup></label>
                        <input type="link" class="form-control" style="background-color: rgba(255, 255, 255, 0.05); border: 0; border-bottom: 1px solid white; text-align: center; color: white;" name = "photo"
                            value = "<?php
                                echo $row['photo'];?>"
                        >
                            
                        <label for="facebook" class="mt-4">Facebook:</label>
                        <input type="link" class="form-control" style="background-color: rgba(255, 255, 255, 0.05); border: 0; border-bottom: 1px solid white; text-align: center; color: white;" name = "facebook"
                            value = "<?php
                                echo $row['facebook'];?>"
                        >

                        <label for="instagram" class="mt-4">Instagram:</label>
                        <input type="link" class="form-control" style="background-color: rgba(255, 255, 255, 0.05); border: 0; border-bottom: 1px solid white; text-align: center; color: white;" name = "instagram"
                            value = "<?php
                                echo $row['instagram'];?>"
                        >
                </div>
            </div>
            <div class="row">
                <div class="col">
                <input name="submitButton" type="submit" class="btn btn-outline-light mt-2 w-100 btn-lg btn-block" value="Save your details">    
            </div>
            </form>

            <?php
                #submit button
                if(isset($_POST['submitButton'])) {
                    $username = $_POST['username'];
                    $email = $_POST['email'];
                    $full_name = $_POST['full_name'];
                    $about_me = $_POST['about_me'];
                    $phone_number = $_POST['phone_number'];
                    $photo = $_POST['photo'];
                    $facebook = $_POST['facebook'];
                    $instagram = $_POST['instagram'];

                    $query = "UPDATE users SET username = '$username', email = '$email', full_name = '$full_name', about_me = '$about_me', whatsapp = '$phone_number', photo = '$photo', facebook = '$facebook', instagram = '$instagram' WHERE username = '".$_SESSION['username']."'";
                    $result = mysqli_query($connection, $query);
                    if($result) {
                        echo '<div class="alert alert-success mt-5 text-center" role="alert">
                        Your details have been saved!
                      </div>';
                    }
                    else {
                        echo '<div class="alert alert-danger mt-5 text-center" role="alert">
                        Your details have not been saved!
                      </div>';
                    }
                }
            ?>
        </div>
    </body>
</html>