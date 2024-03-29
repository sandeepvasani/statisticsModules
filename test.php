<!DOCTYPE html>
<?php
include('dbconnect.php');
session_start();

if(!$_SESSION['email'])
{
    header('Location: index.php');//redirect to login page to secure the welcome page without login access.
	exit;
}
?>
<html lang="en">
<head>
	
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>Statistics Modules</title>
	<meta name="description" content="Statistic Modules Dashboard">
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

<?php

if(!isset($_SESSION["ques_asked"]) )
{
	
	$_SESSION["right_ans"]=0;
	$_SESSION["ques_asked"]=0;
	$_SESSION['ans']='';
	
	$numbers=range(1,5);
	shuffle($numbers);
	$numbers=array_slice($numbers,0,5);
	$_SESSION["numbers"]=$numbers;
//print_r($numbers);
}
else
{
	if(isset($_POST['Next']))
{
	 if($_SESSION['ans']==$_POST['answer'])
	{
		$_SESSION['right_ans']+=1;
		$_SESSION['ans']='';
	//	echo "right";
	} 
	$_SESSION["ques_asked"]+=1;
	header('Location: test.php');
}
	
	
	
}

	if($_SESSION['ques_asked']>4)
	{
		//session_destroy();
		//$_SESSION["ques_asked"]=0;
		header('Location: result.php');
		unset($_SESSION['ques_asked']);
		
		//echo $_SESSION['right_ans'];
				
		//exit;
		
	
	}


$svar= $_SESSION["ques_asked"];
//echo $svar;
//echo $_SESSION["numbers"][$svar];
$ques_query="select * from ques_tbl WHERE qno =".$_SESSION['numbers'][$svar]. " AND ques_type='median'";
    $result=mysqli_query($dbcon,$ques_query);
	
	
    if(mysqli_num_rows($result))
    {
		$row = mysqli_fetch_assoc($result);
		$_SESSION['ans']=$row['rightans'];
	
	}
?>

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
				<a class="brand" href="index.html"><span>Statistics Modules</span></a>
								
				<!-- start: Header Menu -->
				<div class="nav-no-collapse header-nav">
					<ul class="nav pull-right">
															

						<!-- start: User Dropdown -->
						<li class="dropdown">
							<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
								<i class="halflings-icon white user"></i> <?php
                            echo $_SESSION['email']?>
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
				
			<!-- start: Main Menu -->
			<div id="sidebar-left" class="span2">
            <div class="nav-collapse sidebar-nav">
                <ul class="nav nav-tabs nav-stacked main-menu">
                    <li><a class="submenu"><i class="icon-file-alt"></i><span class="hidden-tablet"> Question: <?php echo $_SESSION['ques_asked']+1?></span></a></li>
                    <li>
                        <a class="submenu"><i class="icon-folder-close-alt"></i><span class="hidden-tablet" id="time"></span></a>
                     </li>
                    <li><a class="submenu"><i class="icon-file-alt"></i><span class="hidden-tablet"> Score: <?php echo $_SESSION['right_ans']?></span></a></li>
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
			<form method="post" action="test.php">
			<div id="content" class="span10">
			
						<table class="table table-bordered table-striped table-condensed">
							  <tbody role="alert" aria-live="polite" aria-relevant="all">
					  <tr>
								
								<td> <?php echo $row['question']?></td>
						</tr>
						<tr>
								
								<td> <input type="text" name="answer" id="answer" placeholder="Enter Answer"/></td>
						</tr>
						</tbody>
						 </table>  
						 <div class="pagination pagination-centered">
						  <ul>
							
							<li>
							<button class="btn btn-large btn-info" type="submit" name="Next" value="Next">Next</button>
							</li>
						  </ul>
						</div>     
			</div>
			</form>
				</div><!--/span-->
			</div><!--/row-->
    

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
			<span style="text-align:left;float:left">&copy; 2015 <a>Statistics Modules</a></span>
			
		</p>

	</footer>
	
	<!-- start: JavaScript-->
	
	<script language="javascript" type="text/javascript">
<!--

sec=0
min=5
function display(){ 
 if (sec<=0){ 
    sec=59 
    min-=1 
 } 
if (min<=-1){ 
    sec=0 
    min+=1
 
 }
  else 
    sec-=1 
    if (sec <= 9)
    sec="0"+sec
    document.getElementById("time").innerHTML = "Time: "+min+"."+sec; 
    setTimeout("display()",1000) 
} 
display()
// -->
</script>

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
