<?php
session_start();

if(!$_SESSION['email'] || ($_SESSION['user_role']!='admin' && $_SESSION['user_role']!='superadmin'))
{
    header('Location: ../index.php');//redirect to login page to secure the welcome page without login access.
	exit;
}

session_destroy();
header("Location: ../index.php");
exit;
?>