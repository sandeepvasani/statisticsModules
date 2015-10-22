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
	<title>Statistics Modules Dashboard</title>
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
<form>
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


<div class="container-fluid-full">
    <div class="row-fluid">
        <?php if(isset($_SESSION['email']) && (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin')) : ?>

                <div id="sidebar-left" class="span2">
                    <div class="nav-collapse sidebar-nav">
                        <ul class="nav nav-tabs nav-stacked main-menu">
                            <li><a href="dashboard.php"><i class="icon-bar-chart"></i><span class="hidden-tablet"> Dashboard</span></a></li>

                            <li><a href="reports.php"><i class="icon-list-alt"></i><span class="hidden-tablet"> Reports</span></a></li>
                            <li>
                                <a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Members</span></a>
                                <ul>
                                    <li><a class="submenu" href="AddMember.php"><i class="icon-file-alt"></i><span class="hidden-tablet"> Add Member</span></a></li>
                                    <li><a class="submenu" href="members.php"><i class="icon-file-alt"></i><span class="hidden-tablet"> View Members</span></a></li>

                                </ul>

                            </li>
                            <li><a href="file-manager.html"><i class="icon-folder-open"></i><span class="hidden-tablet"> File Manager</span></a></li>
                            <li><a href="settings.html"><i class="icon-lock"></i><span class="hidden-tablet"> Settings</span></a></li>
                        </ul>
                    </div>
                </div>

        <?php elseif(isset($_SESSION['email']) && (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'superadmin')) : ?>

                <div id="sidebar-left" class="span2">
                    <div class="nav-collapse sidebar-nav">
                        <ul class="nav nav-tabs nav-stacked main-menu">
                            <li><a href="dashboard.php"><i class="icon-bar-chart"></i><span class="hidden-tablet"> Dashboard</span></a></li>
                            <li>
                                <a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Admin</span></a>
                                <ul>
                                    <li><a class="submenu" href="addAdmin.php"><i class="icon-file-alt"></i><span class="hidden-tablet"> Add Admin</span></a></li>
                                    <li><a class="submenu" href="adminDetails.php"><i class="icon-file-alt"></i><span class="hidden-tablet">View Admins</span></a></li>

                                </ul>

                            </li>
                            <li><a href="reports.php"><i class="icon-list-alt"></i><span class="hidden-tablet"> Reports</span></a></li>
                            <li>
                                <a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Members</span></a>
                                <ul>
                                    <li><a class="submenu" href="AddMember.php"><i class="icon-file-alt"></i><span class="hidden-tablet"> Add Member</span></a></li>
                                    <li><a class="submenu" href="members.php"><i class="icon-file-alt"></i><span class="hidden-tablet"> View Members</span></a></li>

                                </ul>

                            </li>
                            <li><a href="file-manager.html"><i class="icon-folder-open"></i><span class="hidden-tablet"> File Manager</span></a></li>
                            <li><a href="settings.html"><i class="icon-lock"></i><span class="hidden-tablet"> Settings</span></a></li>
                        </ul>
                    </div>
                </div>


        <?php endif; ?>

        <!-- start: Main Menu -->
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
					<a href="index.html">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="#">Members</a></li>
			</ul>

			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Members</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								<th>FirstName</th>
                                <th>LastName</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Edit User</th>
							  </tr>
						  </thead>   
						  <?php
                            include("dbconnect.php");
                            if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
                            $start_from = ($page-1) * 10;
                            $view_users_query="select * from user_tbl Where user_role = 'student'";//select query for viewing users.
                            $run=mysqli_query($dbcon,$view_users_query);//here run the sql query.

                          
                          ?>
                                 
                            <tbody>
							<?php
									while($row=mysqli_fetch_array($run))//while look to fetch the result and store in a array $row.
                            {
                            $user_Id=$row[0];
                            $user_fname=$row[1];
                            $user_lname=$row[2];
                            $user_email=$row[3];
                            $phone=$row[5];
							
							echo " <tr>";
                            echo "<td> <a href=AddMember.php?id=" .$user_Id.">".$user_fname."</a> </td>";
                            echo "<td>".$user_lname."</td>";
                            echo "<td>".$user_email."</td>";
                            echo "<td>".$phone."</td>";
							echo "<td> <a class=\"btn btn-info\" href=board.php?id=".$user_Id."><i class=\"halflings-icon white edit\"></i></a>  <a class=\"btn btn-danger\" href=delete.php?id=".$user_Id." onclick=\"return confirm('Are you sure?')\"><i class=\"halflings-icon white trash\"></i></a></td>";
							echo "</tr>";
							}
                            ?>
							
                            </tbody>
					  </table>            
					</div>
				</div><!--/span-->   

	</div><!--/.fluid-container-->
</div>
        <!--end: Content -->
</div>
</div>
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
        <span style="text-align:left;float:left">&copy; 2015 <a href="">Statistics Modules</a></span>

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
//session_unset();

// destroy the session
//session_destroy();
?>
</form>
</body>
</html>
