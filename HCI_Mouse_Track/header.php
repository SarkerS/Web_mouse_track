<?php

session_start();


$host = "localhost";
$user = "root";
$pass = "";
$db = "project_hci_new";
// Create connection
$conn = new mysqli($host, $user, $pass, $db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$image_host = "http://" . $_SERVER['HTTP_HOST'] . "/project_hci";



if (isset($_POST['logout'])) {

//    session_destroy();
    $_SESSION['response'] = "Logged Out Successfully";
    $_SESSION['responseType'] = "success";

    $_SESSION['loggedIn'] = false;
    $_SESSION['username'] = "";
    $_SESSION['userId'] = "";
    $_SESSION['email'] = "";
}

if (isset($_POST['login'])) {
    if (!empty($_POST['username']) && !empty($_POST['password'])) {

        $sql = "SELECT * from users Where `username`='" . $_POST['username'] . "' and `password` = '" . $_POST['password'] . "'";
        $data = mysqli_query($conn, $sql) or die (mysqli_error($conn));
        if ($data->num_rows == 1) {
            foreach ($data as $row) {

                if ($_POST['username'] == $row['username'] && $_POST['password'] == $row['password']) {
                    $_SESSION['loggedIn'] = true;
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['userId'] = $row['user_id'];
                    $_SESSION['email'] = $row['email'];
                    header("Location: ./index.php");

                } else {
                    $_SESSION['response'] = "Username or Password Incorrect";
                    $_SESSION['responseType'] = "error";
                }
            }
        } else {
            $_SESSION['response'] = "Username or Password Incorrect";
            $_SESSION['responseType'] = "error";
        }

    } else {

        $_SESSION['response'] = "Please provide correct information";
        $_SESSION['responseType'] = "error";

    }
}


if (isset($_POST['register'])) {
    if (!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['passwordConfirm'])) {
        if (($_POST['password']) == ($_POST['passwordConfirm'])) {
            $sql = "INSERT INTO users (`username`,`email`,`password`,`user_ip`) VALUES('" . $_POST['username'] . "','" . $_POST['email'] . "','" . $_POST['password'] . "','" . $_SERVER['REMOTE_ADDR'] . "')";
            mysqli_query($conn, $sql) or die (mysqli_error($conn));;
            $_SESSION['response'] = "User registered Successfully";
            $_SESSION['responseType'] = "success";
        } else {
            $_SESSION['response'] = "Password and Confirm Password Mismatch";
            $_SESSION['responseType'] = "error";
        }

    } else {

        $_SESSION['response'] = "Please provide correct information";
        $_SESSION['responseType'] = "error";

    }

}


?>


<!DOCTYPE html>
<!--[if IE 8 ]>
<html class="ie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]>
<html class="ie ie9" lang="en"> <![endif]-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Advance HcI</title>
    <meta name="viewport"
          content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1, user-scalable=no">



    <!-- CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/superfish.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/myApp.css" rel="stylesheet">
    <link href="fontello/css/fontello.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="http://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="http://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<header>
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-3">
                <a href="" id=""><h4>HCI PROJECT LOGO</h4></a>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-9">
                <div class="pull-right">

                    <?php
                    if (isset($_SESSION['loggedIn'])) {
                        if ($_SESSION['loggedIn']) {
                            ?>


                            <form method="post" action="./login.php">
                                <a class="button_top" href="#">Hello, <?php echo $_SESSION['username']?></a>
                                <input type="hidden" name="logout" value="1" />
                                <button type="submit" class="button_top" id="login_top">Sign Out</button>

                            </form>


                            <?php
                        }else{
                            ?>
                            <a href="./register.php" class="button_top">Register</a>
                            <a href="./login.php" class="button_top" id="login_top">Sign in</a>
                            <?php
                        }
                    }else{
                        ?>
                        <a href="./register.php" class="button_top">Register</a>
                        <a href="./login.php" class="button_top" id="login_top">Sign in</a>
                    <?php
                    }
                    ?>

                </div>

            </div>
        </div>
    </div>
</header>
<!-- End header -->

<nav>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div id="mobnav-btn"></div>
                <ul class="sf-menu">
                    <li>
                        <a href="#">Home</a>
                    </li>

                    <li class="normal_drop_down">
                        <a href="#">Upcoming Items</a>

                        <div class="mobnav-subarrow"></div>
                        <ul>
                            <li><a href="">Shirt</a></li>
                            <li><a href="">Pant</a></li>
                            <li><a href="">Winter cloths</a></li>
                        </ul>
                    </li>
                    <li><a href="">Clearence &amp; Sale</a></li>
                    <li><a href="">Blog</a></li>
                    <li class="mega_drop_down">
                        <a href="#">About Us</a>

                        <div class="mobnav-subarrow"></div>
                        <div class="sf-mega">
                            <div class="col-md-3 col-sm-4">
                            </div>
                            <div class="col-md-3 col-sm-4">
                                <h5>Communicate</h5>
                                <ul class="mega_submenu">
                                    <li><a href="">About us</a></li>
                                    <li><a href="">Stores</a></li>
                                    <li><a href="">News &amp; Events</a></li>
                                </ul>
                            </div>
                            <div class="col-md-3 col-sm-4">
                                <h5>Resources</h5>
                                <ul class="mega_submenu icons">
                                    <li><a href="#"> Downloads<i class="icon-download"></i></a></li>
                                    <li><a href="#">Stuffs <i class="icon-user"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li><a href="">Contacts</a></li>
                </ul>

                
                <!-- End search -->

            </div>
        </div>
        <!-- End row -->
    </div>
    <!-- End container -->
</nav>

<section id="sub-header">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 text-center">
                <h1>Intelligent Shopping Site</h1>

                <p class="lead boxed ">A Machine Learning Based Approach</p>

            </div>
        </div>
        <!-- End row -->
    </div>
    <!-- End container -->
    <div class="divider_top"></div>
</section>
<!-- End sub-header -->

