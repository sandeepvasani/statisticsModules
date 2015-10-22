<?php
ini_set('mysql.connect_timeout',300);
ini_set('default_socket_timeout',300);
?>
<html>
<body>
<form method="post" enctype="multipart/form-data">
    <br/>
    <input type="file" name="image" />
    <br/><br/>
    <input type="submit" name="sumit" value="Upload" />
</form>
<?php
if(isset($_POST['sumit']))
{
    if(getimagesize($_FILES['image']['tmp_name']) == FALSE)
    {
        echo "Please select an image.";
    }
    else
    {
        $image= addslashes($_FILES['image']['tmp_name']);
        $image= file_get_contents($image);
        $image= base64_encode($image);
        saveimage($image);
    }
}
displayimage();
function saveimage($image)
{
    $con=mysqli_connect("localhost","root","");
    mysqli_select_db($con,"db_statistics");
    $qry="insert into question_image (ImageType,ImageData) values ('png','$image')";
    $result=mysqli_query($con, $qry);
    if($result)
    {
        echo "<br/>Image uploaded.";
    }
    else
    {
        echo "<br/>Image not uploaded.";
    }
}
function displayimage()
{
    $con=mysqli_connect("localhost","root","");
    mysqli_select_db($con,"db_statistics");
    $qry="select * from question_image";
    $result=mysqli_query($con, $qry);
    while($row = mysqli_fetch_array($result))
    {
        echo '<img height="300" width="300" src="data:image;base64,'.$row[2].' "> ';
    }
    mysqli_close($con);
}

?>
</body>
</html>