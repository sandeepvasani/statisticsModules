<?php
session_start();

if(!$_SESSION['email'] || ($_SESSION['user_role']!='admin' && $_SESSION['user_role']!='superadmin'))
{
    header('Location: ../index.php');//redirect to login page to secure the welcome page without login access.
	exit;
}


?>

<html lang="en">
<head>

    <!-- start: Meta -->
    <meta charset="utf-8">
    <title>Statistics Module</title>
    <meta name="description" content="Bootstrap Metro Dashboard">
    <meta name="author" content="Dennis Ji">
    <meta name="keyword" content="Metro, Metro UI, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
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
                            <li><a href="index.php"><i class="halflings-icon off"></i> Logout</a></li>
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
<form id="msform" role="form" method="post" action="members.php">

    <div class="container-fluid-full">
        <div class="row-fluid">

            <!-- start: Main Menu -->
            <div id="sidebar-left" class="span2">
                <div class="nav-collapse sidebar-nav">
                    <ul class="nav nav-tabs nav-stacked main-menu">
                        <li><a href="index1.html"><i class="icon-bar-chart"></i><span class="hidden-tablet"> Dashboard</span></a></li>
                        <li>
                            <a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Admin</span></a>
                            <ul>
                                <li><a class="submenu" href="addAdmin.html"><i class="icon-file-alt"></i><span class="hidden-tablet"> Add Admin</span></a></li>
                                <li><a class="submenu" href="changePassword.html"><i class="icon-file-alt"></i><span class="hidden-tablet"> Change Admin Password</span></a></li>

                            </ul>

                        </li>
                        <li><a href="reports.html"><i class="icon-list-alt"></i><span class="hidden-tablet"> Reports</span></a></li>
                        <li>
                            <a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Member Details</span></a>
                            <ul>
                                <li><a class="submenu" href="addMember.html"><i class="icon-file-alt"></i><span class="hidden-tablet"> Add Member</span></a></li>
                                <li><a class="submenu" href="members.php"><i class="icon-file-alt"></i><span class="hidden-tablet"> View Members</span></a></li>

                            </ul>

                        </li>
                        <li><a href="file-manager.html"><i class="icon-folder-open"></i><span class="hidden-tablet"> File Manager</span></a></li>
                        <li><a href="settings.html"><i class="icon-lock"></i><span class="hidden-tablet"> Settings</span></a></li>
                    </ul>
                </div>
            </div>
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
                    <li><a href="#">Member Details</a></li>
                </ul>

                <?php
            require_once('dbconnect.php');
            $id=$_GET['id'];
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
                        <h2><i class="halflings-icon edit"></i><span class="break"></span>Member Details</h2>
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
echo "<input class='input-xlarge focused' id='focusedInput' type='text' placeholder='First Name' value='$fname'>"

?>
                                      </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="focusedInput">Last Name</label>
                                    <div class="controls">
                                        <?php
                                        echo "<input class='input-xlarge focused' id='focusedInput' type='text' placeholder='Last Name' value='$lname'>"

                                        ?>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="focusedInput">Email</label>
                                    <div class="controls">
                                        <?php
                                        echo "<input class='input-xlarge focused' id='focusedInput' type='text' placeholder='Email' value='$email'>"

                                        ?>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="focusedInput">Phone</label>
                                    <div class="controls">
                                        <?php
                                        echo "<input class='input-xlarge focused' id='focusedInput' type='text' placeholder='Phone' value='$phone'>"

                                        ?>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="focusedInput">Address</label>
                                    <div class="controls">
                                        <?php
                                        echo "<input class='input-xlarge focused' id='focusedInput' type='text' placeholder='Address' value='$address'>"

                                        ?>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="focusedInput">User Role</label>
                                    <div class="controls">
                                        <?php
                                        echo "<input class='input-xlarge uneditable-input' id='focusedInput' type='text' placeholder='User Role' value='$role'>"

                                        ?>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                    <button class="btn">Cancel</button>
                                </div>
                            </fieldset>
                        </form>

                    </div>
                </div><!--/span-->

            </div><!--/row-->


        </div><!--/.fluid-container-->

        <!-- end: Content -->
    </div><!--/#content.span10-->
</div><!--/fluid-row-->

<div class="modal hide fade" id="myModal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">�</button>
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
        <span style="text-align:left;float:left">&copy; 2013 <a href="http://jiji262.github.io/Bootstrap_Metro_Dashboard/" alt="Bootstrap_Metro_Dashboard">Bootstrap Metro Dashboard</a></span>

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

</body>
</html>
