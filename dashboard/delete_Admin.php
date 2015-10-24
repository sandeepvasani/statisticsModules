<?php
session_start();
if(!$_SESSION['email'] && $_SESSION['user_role']!='superadmin')
{
    header('Location: ../index.php');//redirect to login page to secure the welcome page without login access.
	exit;
}

include("dbconnect.php");

//$id=$_GET['id'];
$delete_user="DELETE FROM user_tbl Where PID = ".$_GET['id']."";//select query for deleting user.
$result=mysqli_query($dbcon,$delete_user);//here run the sql query.
// if successfully deleted
if($result){
   header('location: adminDetails.php');
}

else {
    echo "ERROR";
}
?>
