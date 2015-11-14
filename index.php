<?php
ob_start();
include("dbconnect.php");
session_start();//session starts here
?>
<?php

if(isset($_POST['Login']))
{
    $user_email=mysqli_real_escape_string($dbcon, $_POST['email']);
    $user_pass=mysqli_real_escape_string($dbcon, $_POST['pass']);
	//$passhash=SHA2(CONCAT('$user_email','$user_pass'),512);
    $check_user="select * from user_tbl WHERE email = '$user_email' AND upassword = SHA2(CONCAT('$user_email','$user_pass'),512)";
    $result=mysqli_query($dbcon,$check_user);
    if(mysqli_num_rows($result))
    {
		$row = mysqli_fetch_assoc($result);
		$_SESSION['email']=$user_email;//here session is used and value of $user_email store in $_SESSION.
        $_SESSION['user_role'] = $row['user_role'];
        $_SESSION['username'] = $row['username'];
		if($row['user_role']=='admin'|| $row['user_role']=='superadmin')
			header('Location: dashboard/members.php');
		else
			header('Location: chooseTest.php');    
    }
    else
    {
        echo "Invalid Login Credentials.";
    }
}
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

<form id="msform" role="form" method="post" action="index.php">

    <!-- progressbar -->
    <!-- fieldsets -->
    <fieldset>
        <h2 class="fs-title">Please Login</h2>
        <h3 class="fs-subtitle">Enter Your Credentials</h3>
        <div class="fs-error"></div>
        <input type="email" name="email" id="email" placeholder="Email" />
        <input type="password" name="pass"  id="pass" placeholder="Password" />
        <input type="submit" name="Login" class="next action-button" value="Login" />
        <br/><a href="signup.php" style="font-size:small"> Register as a new user </a><br /> <a href="forgetPassword.php" style="font-size:small"> Forgot Password</a>
    </fieldset>

</form>

</body>
</html>

