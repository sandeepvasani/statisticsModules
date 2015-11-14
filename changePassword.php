<?php
include("dbconnect.php");
session_start();//session starts here
?>

<!doctype HTML>
<html>
<head>

    <!-- jQuery -->
    <script src="js/jquery-1.9.1.min.js" type="text/javascript"></script>
    <!-- jQuery easing plugin -->
    <script src="js/jquery.easing.min.js" type="text/javascript"></script>

    <script src="js/script.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="css/login_style.css">

</head>
<body>
<!-- multistep form -->

<form id="msform" role="form" method="post" action="changePassword.php">
    <!-- progressbar -->
    <!-- fieldsets -->
    <fieldset>
        <h3 class="fs-subtitle">Update your password</h3>
        <div class="fs-error"></div>
        <input type="password" name="password" id="password" placeholder="Password" />
        <input type="password" name="password_again" id="password_again" placeholder="Type again" />
        <input type="submit" id="Change" name="Change" value="Change Password" />
    </fieldset>

</form>

</body>
</html>

<?php

if(isset($_POST['Change'])) {
    echo 'still updating....';

    $pass1 = mysqli_real_escape_string($dbcon, $_POST['password']);
    $pass2 = mysqli_real_escape_string($dbcon, $_POST['password_again']);
    $user = $_SESSION['username'];
   // echo $user;
    $query2 = "Update user_tbl SET upassword = SHA2(CONCAT('$user','$pass1'),512) WHERE username = '$user'";
    if(!$query2){
        die("Invalid query: " .mysqli_error());
    }



   // echo 'still updating';
    if(mysqli_query($dbcon,$query2))
    {
   //     header('Location: index.php');
    }

}

    if (isset($_GET["token"])  && !empty($_GET["token"])) {
        $token = $_GET["token"];

        $query1 = mysqli_query($dbcon, "SELECT username, tstamp FROM forget_password WHERE token = '$token'");


        if(!$query1){
            die("Invalid query: " .mysqli_error());
        }

        while($row3 = mysqli_fetch_array($query1))
        {
            $username=$row3['username'];
            $_SESSION['username'] = $username;

            $tstamp=$row3['tstamp'];
        }

        $query = mysqli_query($dbcon, "DELETE FROM forget_password WHERE username = '$username' AND token = '$token' AND tstamp = '$tstamp'");

        if(!$query){
            die("Invalid query: " .mysqli_error());
        }
        $delta = 21600;

       // echo 'Updating';
        // Check to see if link has expired
        if ($_SERVER["REQUEST_TIME"] - $tstamp > $delta) {
            throw new Exception("Token has expired.");
        }
        unset($_GET['token']);
    }
// verify token
?>
