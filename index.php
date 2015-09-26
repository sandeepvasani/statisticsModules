
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
        <br/><a href="signup.php" style="font-size:small"> Register as a new user </a><br /> <a href="" style="font-size:small"> Forgot Password</a>
    </fieldset>

</form>

</body>
</html>

<?php

if(isset($_POST['Login']))
{
    $user_email=$_POST['email'];
    $user_pass=$_POST['pass'];

    $check_user="select * from user_tbl WHERE email = '$user_email' AND upassword = '$user_pass'";
    $result=mysqli_query($dbcon,$check_user);
	
	
    if(mysqli_num_rows($result))
    {
		$row = mysqli_fetch_assoc($result);
		$_SESSION['email']=$user_email;//here session is used and value of $user_email store in $_SESSION.
		if($row['user_role']=='admin'|| $row['user_role']=='superadmin')
			header('Location: dashboard/members.php');
		else
			header('Location: test.php');

        

    }
    else
    {
        echo "Invalid Login Credentials.";
    }
}
?>