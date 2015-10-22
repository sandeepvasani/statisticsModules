
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

<form id="msform" role="form" method="post" action="forgetPassword.php">

    <!-- progressbar -->
    <!-- fieldsets -->
    <fieldset>
        <h3 class="fs-subtitle">Enter Your Email ID</h3>
        <div class="fs-error"></div>
        <input type="email" name="email" id="email" placeholder="Email" />
        <input type="submit" name="Send" class="next action-button" value="Get Password" />

    </fieldset>

</form>

</body>
</html>

<?php

if(isset($_POST['Send']))
{
    $user_email=mysqli_real_escape_string($dbcon, $_POST['email']);

    $user = mysqli_query($dbcon,"SELECT username FROM user_tbl where email='$user_email'");

    $row = mysqli_fetch_array($user);

    $username = $row['username'];

    $token = sha1(uniqid($username, true));

    $time = $_SERVER["REQUEST_TIME"];
    $query = mysqli_query($dbcon, "INSERT INTO forget_password (username, token, tstamp) VALUES ('$username', '$token', '$time')"
    );



    $url = "http://localhost:8080/changepassword.php?token=$token";

    $message = "Your activation link is :".$url." Please use this url to change your password";

    $address = "patela7014@gmail.com";
    try {
        mail($address, "Password Change Link", $message);

     //   echo "Email Sent";
    }
    catch(Exception $ex){
    echo $ex->getMessage();
}

}
?>





<?php



?>