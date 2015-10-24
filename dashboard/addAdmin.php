<?php
session_start();


if(!(isset($_SESSION['email'])))
{
    header('Location: ../index.php');//redirect to login page to secure the welcome page without login access.
    exit;
}
if(!(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'superadmin'))
{
    header('Location: ../index.php');//redirect to login page to secure the welcome page without login access.
    exit;
}

?>

<?php
include("dbconnect.php");

if(isset($_POST['Add_Member']))
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
        //echo"1";
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

    $insert_user="insert into user_tbl (FirstName,LastName,username,email,upassword,phone_number,user_role,address) VALUES ('$user_fname','$user_lname','$user_email','$user_email',SHA2(CONCAT('$user_email','$user_pass'),512),'$phone','admin','$user_address')";
    if(mysqli_query($dbcon,$insert_user))
    {
        header('Location: adminDetails.php');
    }



}

if(isset($_POST['Update_Admin']))
{

    $id=$_SESSION['id'];
    $user_fname=mysqli_real_escape_string($dbcon, $_POST['fname_u']);//here getting result from the post array after submitting the form.
    $user_lname=mysqli_real_escape_string($dbcon, $_POST['lname_u']);
    $user_address=mysqli_real_escape_string($dbcon, $_POST['address_u']);
    $phone=mysqli_real_escape_string($dbcon, $_POST['phone_u']);

    $user_email=mysqli_real_escape_string($dbcon, $_POST['email_u']);//same

    echo $user_fname;
    if($user_fname=='' || $user_lname=='' || $user_address=='')
    {
        //javascript use for input checking
        echo"<script>alert('Please enter all the personal details')</script>";
        echo"1";
        exit();//this use if first is not work then other will not show
    }



    if($user_email=='')
    {
        echo"<script>alert('Please enter the email')</script>";
        echo"3";
        exit();
    }

    $insert_user="Update user_tbl set FirstName= '$user_fname', LastName = '$user_lname', email = '$user_email', phone_number = '$phone', address = '$user_address' WHERE PID = $id";

    //echo '$insert_user';

    if(mysqli_query($dbcon,$insert_user))
    {

        header('Location: adminDetails.php');


    }
}?>

<html lang="en">
<head>

    <!-- start: Meta -->
    <meta charset="utf-8">
    <title>Statistics Module</title>
    <meta name="description" content="Statistics Module">
    <meta name="keyword" content="Dashboard">
    <!-- end: Meta -->

    <!-- start: Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- end: Mobile Specific -->

    <!-- start: CSS -->
    <link id="bootstrap-style" href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
    <link id="base-style" href="css/style.css" rel="stylesheet">
    <link id="base-style-responsive" href="css/style-responsive.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>
    <!-- end: CSS -->


    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <link id="ie-style" href="css/ie.css" rel="stylesheet">
    <![endif]-->

    <!--[if IE 9]>
    <link id="ie9style" href="css/ie9.css" rel="stylesheet">
    <![endif]-->

    <!-- start: Favicon -->
    <link rel="shortcut icon" href="img/favicon.ico">
    <!-- end: Favicon -->




</head>

<body>
<!-- start: Header -->
<div class="navbar">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="index1.html"><span>Statistics Module</span></a>

            <!-- start: Header Menu -->
            <div class="nav-no-collapse header-nav">
                <ul class="nav pull-right">

                    <!-- start: User Dropdown -->
                    <li class="dropdown">
                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="halflings-icon white user"></i> <?php
                            echo $_SESSION['email']
                            ?>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-menu-title">
                                <span>Account Settings</span>
                            </li>
                            <li><a href="#"><i class="halflings-icon user"></i> Profile</a></li>
                            <li><a href="logout.php"><i class="halflings-icon off"></i> Logout</a></li>
                        </ul>
                    </li>
                    <!-- end: User Dropdown -->
                </ul>
            </div>
            <!-- end: Header Menu -->

        </div>
    </div>
</div>
<!-- start: Header -->
<form id="msform" role="form" method="post" action="addAdmin.php">

    <div class="container-fluid-full">
        <div class="row-fluid">

            <!-- start: Main Menu -->
            <?php if(isset($_SESSION['email']) && (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin')) : ?>

                <div id="sidebar-left" class="span2">
                    <div class="nav-collapse sidebar-nav">
                        <ul class="nav nav-tabs nav-stacked main-menu">
                            <li><a href="Dashboard.php"><i class="icon-bar-chart"></i><span class="hidden-tablet"> Dashboard</span></a></li>
                            <li>
                                <a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Members</span></a>
                                <ul>
                                    <li><a class="submenu" href="AddMember.php"><i class="icon-file-alt"></i><span class="hidden-tablet"> Add Member</span></a></li>
                                    <li><a class="submenu" href="members.php"><i class="icon-file-alt"></i><span class="hidden-tablet"> View Members</span></a></li>

                                </ul>

                            </li>
                            <li>
                                <a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Questions</span></a>
                                <ul>
                                    <li><a class="submenu" href="AddQuestion.php"><i class="icon-file-alt"></i><span class="hidden-tablet"> Add Question</span></a></li>
                                    <li><a class="submenu" href="Questions.php"><i class="icon-file-alt"></i><span class="hidden-tablet"> View Questions</span></a></li>

                                </ul>

                            </li>
                        </ul>
                    </div>
                </div>

            <?php elseif(isset($_SESSION['email']) && (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'superadmin')) : ?>

                <div id="sidebar-left" class="span2">
                    <div class="nav-collapse sidebar-nav">
                        <ul class="nav nav-tabs nav-stacked main-menu">
                            <li><a href="Dashboard.php"><i class="icon-bar-chart"></i><span class="hidden-tablet"> Dashboard</span></a></li>
                            <li>
                                <a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Admin</span></a>
                                <ul>
                                    <li><a class="submenu" href="addAdmin.php"><i class="icon-file-alt"></i><span class="hidden-tablet"> Add Admin</span></a></li>
                                    <li><a class="submenu" href="adminDetails.php"><i class="icon-file-alt"></i><span class="hidden-tablet"> View Admins</span></a></li>

                                </ul>

                            </li>
                            <li>
                                <a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Members</span></a>
                                <ul>
                                    <li><a class="submenu" href="AddMember.php"><i class="icon-file-alt"></i><span class="hidden-tablet"> Add Member</span></a></li>
                                    <li><a class="submenu" href="members.php"><i class="icon-file-alt"></i><span class="hidden-tablet"> View Members</span></a></li>

                                </ul>

                            </li>
                            <li>
                                <a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Questions</span></a>
                                <ul>
                                    <li><a class="submenu" href="AddQuestion.php"><i class="icon-file-alt"></i><span class="hidden-tablet"> Add Question</span></a></li>
                                    <li><a class="submenu" href="Questions.php"><i class="icon-file-alt"></i><span class="hidden-tablet"> View Questions</span></a></li>

                                </ul>

                            </li>
                        </ul>
                    </div>
                </div>

            <?php endif; ?>
            <!-- end: Main Menu -->

            <noscript>
                <div class="alert alert-block span10">
                    <h4 class="alert-heading">Warning!</h4>
                    <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
                </div>
            </noscript>

            <!-- start: Content -->
            <div id="content" class="span10">


                <ul class="breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                        <a href="index1.html">Home</a>
                        <i class="icon-angle-right"></i>
                    </li>
                    <li><a href="#">Admin Details</a></li>
                </ul>

                <?php
                require_once('dbconnect.php');
                if (isset($_GET['id']))
                {
                    $id=$_SESSION['id']=$_GET['id'];
                    $result3 = mysqli_query($dbcon,"SELECT * FROM user_tbl where PID='$id'");
                    while($row3 = mysqli_fetch_array($result3))
                    {
                        $fname=$row3['FirstName'];
                        $lname=$row3['LastName'];
                        $email=$row3['email'];
                        $phone=$row3['phone_number'];
                        $address=$row3['address'];
                        $role=$row3['user_role'];
                    }
                    ?>
                    <div class="row-fluid sortable">
                        <div class="box span12">
                            <div class="box-header" data-original-title>
                                <h2><i class="halflings-icon edit"></i><span class="break"></span>Admin Details</h2>
                                <div class="box-icon">
                                    <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                                </div>
                            </div>
                            <div class="box-content">
                                <form class="form-horizontal">
                                    <fieldset>
                                        <div class="control-group">
                                            <label class="control-label" for="focusedInput">First Name</label>
                                            <div class="controls">
                                                <?php
                                                echo "<input class='input-xlarge focused' id='focusedInput' name='fname_u' type='text' placeholder='First Name' value='$fname'>"

                                                ?>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="focusedInput">Last Name</label>
                                            <div class="controls">
                                                <?php
                                                echo "<input class='input-xlarge focused' id='focusedInput' name='lname_u' type='text' placeholder='Last Name' value='$lname'>"

                                                ?>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="focusedInput">Email</label>
                                            <div class="controls">
                                                <?php
                                                echo "<input class='input-xlarge focused' id='focusedInput' name='email_u' type='text' placeholder='Email' value='$email'>"

                                                ?>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="focusedInput">Phone</label>
                                            <div class="controls">
                                                <?php
                                                echo "<input class='input-xlarge focused' id='focusedInput' name='phone_u' type='text' placeholder='Phone' value='$phone'>"

                                                ?>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="focusedInput">Address</label>
                                            <div class="controls">
                                                <?php
                                                echo "<textarea name='address_u' rows='2' cols='10'>".$address;
                                                echo "</textarea>"

                                                ?>
                                            </div>
                                        </div>


                                        <div class="form-actions">
                                            <input type="submit" name="Update_Admin" class="btn btn-primary" value="Update Admin"/>
                                            <button class="btn">Cancel</button>
                                        </div>
                                    </fieldset>
                                </form>

                            </div>
                        </div><!--/span-->

                    </div><!--/row-->





                    <?php

                }
                else
                {?>
                    <div class="row-fluid sortable">
                        <div class="box span12">
                            <div class="box-header" data-original-title>
                                <h2><i class="halflings-icon edit"></i><span class="break"></span>Admin Details</h2>
                                <div class="box-icon">
                                    <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                                </div>
                            </div>
                            <div class="box-content">
                                <form class="form-horizontal">
                                    <fieldset>
                                        <div class="control-group">
                                            <label class="control-label" for="focusedInput">First Name</label>
                                            <div class="controls">
                                                <?php
                                                echo "<input class='input-xlarge focused' id='focusedInput' name='fname' type='text' placeholder='First Name'>"

                                                ?>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="focusedInput">Last Name</label>
                                            <div class="controls">
                                                <?php
                                                echo "<input class='input-xlarge focused' id='focusedInput' name='lname' type='text' placeholder='Last Name' >"

                                                ?>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="focusedInput">Email</label>
                                            <div class="controls">
                                                <?php
                                                echo "<input class='input-xlarge focused' id='focusedInput' name='email' type='text' placeholder='Email'>"

                                                ?>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="focusedInput">Phone</label>
                                            <div class="controls">
                                                <?php
                                                echo "<input class='input-xlarge focused' id='focusedInput' name='phone' type='text' placeholder='Phone' autocomplete='off' >"

                                                ?>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="focusedInput">Address</label>
                                            <div class="controls">
                                                <?php
                                               echo "<textarea name='address' rows='2' cols='10'></textarea>"

                                                ?>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="focusedInput">Password</label>
                                            <div class="controls">
                                                <?php
                                                echo "<input class='input-xlarge focused' id='focusedInput' name='pass' type='password' autocomplete='off'>"

                                                ?>
                                            </div>
                                        </div>

                                        <div class="form-actions">
                                            <input type="submit" name="Add_Member" class="btn btn-primary" value="Add Admin"/>
                                            <a href="adminDetails.php"><button type="button" class="btn">Cancel</button></a>
                                        </div>
                                    </fieldset>
                                </form>

                            </div>
                        </div><!--/span-->

                    </div><!--/row-->

                <?php }?>
            </div><!--/.fluid-container-->


            <!-- end: Content -->
        </div><!--/#content.span10-->
    </div><!--/fluid-row-->

    <div class="modal hide fade" id="myModal">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">×</button>
            <h3>Settings</h3>
        </div>
        <div class="modal-body">
            <p>Here settings can be configured...</p>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn" data-dismiss="modal">Close</a>
            <a href="#" class="btn btn-primary">Save changes</a>
        </div>
    </div>

    <div class="clearfix"></div>

    <footer>

        <p>
            <span style="text-align:left;float:left">&copy; 2015 <a href="" alt="">Statistics Module</a></span>

        </p>

    </footer>

    <!-- start: JavaScript-->

    <script src="js/jquery-1.9.1.min.js"></script>
    <script src="js/jquery-migrate-1.0.0.min.js"></script>

    <script src="js/jquery-ui-1.10.0.custom.min.js"></script>

    <script src="js/jquery.ui.touch-punch.js"></script>

    <script src="js/modernizr.js"></script>

    <script src="js/bootstrap.min.js"></script>

    <script src="js/jquery.cookie.js"></script>

    <script src='js/fullcalendar.min.js'></script>

    <script src='js/jquery.dataTables.min.js'></script>

    <script src="js/excanvas.js"></script>
    <script src="js/jquery.flot.js"></script>
    <script src="js/jquery.flot.pie.js"></script>
    <script src="js/jquery.flot.stack.js"></script>
    <script src="js/jquery.flot.resize.min.js"></script>

    <script src="js/jquery.chosen.min.js"></script>

    <script src="js/jquery.uniform.min.js"></script>

    <script src="js/jquery.cleditor.min.js"></script>

    <script src="js/jquery.noty.js"></script>

    <script src="js/jquery.elfinder.min.js"></script>

    <script src="js/jquery.raty.min.js"></script>

    <script src="js/jquery.iphone.toggle.js"></script>

    <script src="js/jquery.uploadify-3.1.min.js"></script>

    <script src="js/jquery.gritter.min.js"></script>

    <script src="js/jquery.imagesloaded.js"></script>

    <script src="js/jquery.masonry.min.js"></script>

    <script src="js/jquery.knob.modified.js"></script>

    <script src="js/jquery.sparkline.min.js"></script>

    <script src="js/counter.js"></script>

    <script src="js/retina.js"></script>

    <script src="js/custom.js"></script>
    <!-- end: JavaScript-->
    <?php
    // remove all session variables
    //  session_unset();

    // destroy the session
    //   session_destroy();
    ?>
</body>
</html>