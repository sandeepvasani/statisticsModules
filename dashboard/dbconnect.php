
<?php

$servername = "localhost";
$username = "root";
$password = "password";

// Create connection
$dbcon = new mysqli($servername, $username, $password);

// Check connection
if ($dbcon->connect_error) {
    die("Connection failed: " . $dbcon->connect_error);
}
echo "Connected successfully";

mysqli_select_db($dbcon,"db_statistics")
or die("Could not select examples");
?>

