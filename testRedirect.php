<?php
ob_start();
include('dbconnect.php');
session_start();
if(!$_SESSION['email'])
{
    header('Location: index.php');//redirect to login page to secure the welcome page without login access.
	exit;
}
$_SESSION['Question_Total']=$_GET['qnos'];
if($_SESSION['Question_Difficulty']=="easy")
	 header('Location: testEasy.php');
 else
	header('Location: testDifficult.php');
?>