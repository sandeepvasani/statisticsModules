<!doctype HTML>


<?php
include("dbconnect.php");

if(isset($_POST['Register']))
{
	
    $user_fname=mysqli_real_escape_string($dbcon, $_POST['fname']);//here getting result from the post array after submitting the form.
    $user_lname=mysqli_real_escape_string($dbcon, $_POST['lname']);
    $user_address=mysqli_real_escape_string($dbcon, $_POST['address']);
    $phone=mysqli_real_escape_string($dbcon, $_POST['phone']);

    $user_pass=mysqli_real_escape_string($dbcon, $_POST['pass']);//same
    $user_email=mysqli_real_escape_string($dbcon, $_POST['email']);//same


    if($user_fname=='' || $user_lname=='' || $user_address=='')
    {
        //javascript use for input checking
        echo"<script>alert('Please enter all the personal details')</script>";
		echo"1";
        exit();//this use if first is not work then other will not show
    }

    if($user_pass=='')
    {
        echo"<script>alert('Please enter the password')</script>";
		echo"2";
        exit();
    }

    if($user_email=='')
    {
        echo"<script>alert('Please enter the email')</script>";
		echo"3";
        exit();
    }
//here query check weather if user already registered so can't register again.
    $check_email_query="select * from user_tbl WHERE email='$user_email'";
    $run_query=mysqli_query($dbcon,$check_email_query);
	
    if(mysqli_num_rows($run_query)>0)
    {
        echo "<script>alert('Email $user_email is already exist in our database, Please try another one!')</script>";
        exit();
    }
	echo "ahsfjsak";
//insert the user into the database.

    $insert_user="insert into user_tbl (FirstName,LastName,username,email,upassword,phone_number,user_role,address) VALUES ('$user_fname','$user_lname','$user_email','$user_email',SHA2(CONCAT('$user_email','$user_pass'),512),'$phone','Student','$user_address')";
    if(mysqli_query($dbcon,$insert_user))
    {
       header('Location: index.php');  
    }

}

?>

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
<form id="msform" role="form" method="post" action="signup.php">
    <!-- progressbar -->
    <ul id="progressbar">
        <li class="active">Account Setup</li>

        <li>Personal Details</li>
        <li>Payment Details</li>
    </ul>
    <!-- fieldsets -->
    <fieldset>
        <h2 class="fs-title">Create your account</h2>
        <h3 class="fs-subtitle">This is step 1</h3>
        <div class="fs-error"></div>
        <input type="text" name="email" id="email" placeholder="Email" />
        <div id="pswd_info">
            <h4>Password must meet the following requirements:</h4>
            <ul>
                <li id="letter" class="invalid">At least <strong>one letter</strong></li>
                <li id="capital" class="invalid">At least <strong>one capital letter</strong></li>
                <li id="number" class="invalid">At least <strong>one number</strong></li>
                <li id="length" class="invalid">Be at least <strong>8 characters</strong></li>
            </ul>
        </div>
        <input type="password" name="pass"  id="pass" placeholder="Password" />
        <input type="password" name="cpass"  id="cpass" placeholder="Confirm Password" />
        <input type="button" name="next" class="next action-button" value="Next" />
        <br/><a href="index.php" style="font-size:small"> Existing User? </a><br />

    </fieldset>
    <fieldset>

        <h2 class="fs-title">Personal Details</h2>
        <h3 class="fs-subtitle">We will never sell it</h3>
        <div class="fs-error"></div>
        <input type="text" name="fname" id="fname" placeholder="First Name" />
        <input type="text" name="lname" id="lname" placeholder="Last Name" />
        <input type="text" name="phone" id="phone" placeholder="Phone" />
        <textarea name="address" id="address" placeholder="Address"></textarea>
        <input type="button" name="previous" class="previous action-button" value="Previous" />
        <input type="button" name="next" class="next action-button" value="Next" />
        <br/><a href="index.php" style="font-size:small"> Existing User? </a><br />

    </fieldset>
    <fieldset>
        <h2 class="fs-title">Payment Details</h2>
        <h3 class="fs-subtitle">Select your paymen plan</h3>
        <input type="text" name="creditnumber" id="creditnumber" placeholder="Credit Card Number" />
        <input type="text" name="expirydate" id="expirydate" placeholder="Expiry Date" />
        <input type="text" name="cvv" id="cvv" placeholder="cvv" />
        <input type="button" name="previous" class="previous action-button" value="Previous" />
        <input type="submit" name="Register" class="submit action-button" value="Register" />
        <br/><a href="index.php" style="font-size:small"> Existing User? </a><br />
    </fieldset>
</form>

</body>
</html>
