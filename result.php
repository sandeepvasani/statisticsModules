<?php
session_start();
include('dbconnect.php');
if(!$_SESSION['email'])
{
    header('Location: index.php');//redirect to login page to secure the welcome page without login access.
	exit;
}
//
$_SESSION['result_displayed']=1;
//current result
if($_SESSION['Question_Category']=="mean")
{
	$median_percentage=0;
	$mode_percentage=0;
	$probability_percentage=0;
	$histogram_percentage=0;
	$mean_percentage=$_SESSION['right_ans']*100/$_SESSION['Question_Total'];
}
if($_SESSION['Question_Category']=="median")
{
	
	$median_percentage=$_SESSION['right_ans']*100/$_SESSION['Question_Total'];
	$mode_percentage=0;
	$probability_percentage=0;
	$histogram_percentage=0;
	$mean_percentage=0;
	
}
if($_SESSION['Question_Category']=="mode")
{
	$median_percentage=0;
	$mode_percentage=$_SESSION['right_ans']*100/$_SESSION['Question_Total'];
	$probability_percentage=0;
	$histogram_percentage=0;
	$mean_percentage=0;
}
if($_SESSION['Question_Category']=="probability")
{
	$median_percentage=0;
	$mode_percentage=0;
	$probability_percentage=$_SESSION['right_ans']*100/$_SESSION['Question_Total'];
	$histogram_percentage=0;
	$mean_percentage=0;
}
if($_SESSION['Question_Category']=="histogram")
{
	$median_percentage=0;
	$mode_percentage=0;
	$probability_percentage=0;
	$histogram_percentage=$_SESSION['right_ans']*100/$_SESSION['Question_Total'];
	$mean_percentage=0;
}
//

$email=$_SESSION['email'];
$colupdate=$_SESSION['Question_Difficulty'].$_SESSION['Question_Category'];
$total=$_SESSION['Question_Category']."Total";
$rightans=$_SESSION['right_ans'];
$totalquestion=$_SESSION['Question_Total'];
//make the email field in the database unique.
//make default value of all colunms as null except index and email.
//$ques_query="INSERT INTO `result`(`Email`, `EasyMean`, `EasyMedian`, `EasyMode`, `EasyHistogram`, `EasyProbability`, `HardMean`, `HardMedian`, `HardMode`, `HardHistogram`, `HardProbabilty`, `Percentage`, `Percentile`) VALUES('$_SESSION['email']',) on duplicate key update EasyMean=EasyMean+'$_SESSION['right_ans']'";
$ques_query="INSERT INTO result (Email,$colupdate,$total) VALUES ('$email','$rightans','$totalquestion') on duplicate key update ".$colupdate."=".$colupdate."+".$_SESSION['right_ans'].",".$total."=".$total."+".$_SESSION['Question_Total'];
$result=mysqli_query($dbcon,$ques_query);


$query="select * from result";
 $result_rows=mysqli_query($dbcon,$query);
	
    if(mysqli_num_rows($result_rows))
    {
		$row = mysqli_fetch_assoc($result_rows);
	
	$overall_median_percentage=($row['MedianTotal']==0)?0:($row['EasyMedian']+$row['HardMedian'])*100/$row['MedianTotal'];
	$overall_mode_percentage=($row['ModeTotal']==0)?0:($row['EasyMode']+$row['HardMode'])*100/$row['ModeTotal'];
	$overall_probability_percentage=($row['ProbabilityTotal']==0)?0:($row['EasyProbability']+$row['HardProbabilty'])*100/$row['ProbabilityTotal'];
	$overall_histogram_percentage=($row['HistogramTotal']==0)?0:($row['EasyHistogram']+$row['HardHistogram'])*100/$row['HistogramTotal'];
	$overall_mean_percentage=($row['MeanTotal']==0)?0:($row['EasyMean']+$row['HardMean'])*100/$row['MeanTotal'];
}
?>

<html lang="en">
<head>
	
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>Statistics Modules Dashboard</title>
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
                            echo $_SESSION['email']; ?>
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
	
		
		<div class="row-fluid">
				
			<!-- start: Main Menu -->
			
			<!-- end: Main Menu -->
			
			<noscript>
				&lt;div class="alert alert-block span10"&gt;
					&lt;h4 class="alert-heading"&gt;Warning!&lt;/h4&gt;
					&lt;p&gt;You need to have &lt;a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank"&gt;JavaScript&lt;/a&gt; enabled to use this site.&lt;/p&gt;
				&lt;/div&gt;
			</noscript>
			
			<!-- start: Content -->
			<div class="span11" style="min-height: 699px;">
			
			<hr>		
			
			<div class="row-fluid">	
				<div class="box span12">
					<div class="box-header">
						<h2><i class="halflings-icon tasks"></i><span class="break"></span>Current Test Result</h2>
					</div>
					<div class="box-content">
						<ul class="skill-bar">
						<li>
				            	<h5>Mean ( <?php echo $mean_percentage;?>% )</h5>
				            	<div class="meter purple"><span style="width: <?php echo $mean_percentage*11.32;?>px; background: rgb(255, 196, 13);"></span></div><!-- Edite width here -->
				          	</li>
				        	<li>
				            	<h5>Median ( <?php echo $median_percentage;?>% )</h5>
				            	<div class="meter yellow"><span style="width: <?php echo $median_percentage*11.32;?>px; background: rgb(255, 196, 13);"></span></div><!-- Edite width here -->
				          	</li>
				          	<li>
				            	<h5>Mode ( <?php echo $mode_percentage;?>% )</h5>
				            	<div class="meter blue"><span style="width: <?php echo $mode_percentage*11.32;?>px; background: rgb(45, 137, 239);"></span></div><!-- Edite width here -->
				          	</li>
				          	<li>
				            	<h5>Probability ( <?php echo $probability_percentage;?>% )</h5>
				            	<div class="meter pink"><span style="width: <?php echo $probability_percentage*11.32;?>px; background: rgb(159, 0, 167);"></span></div><!-- Edite width here -->
				          	</li>
				          	<li>
				            	<h5>Histogram ( <?php echo $histogram_percentage;?>% )</h5>
				            	<div class="meter green"><span style="width: <?php echo $histogram_percentage*11.32;?>px; background: rgb(0, 163, 0);"></span></div><!-- Edite width here -->
				          	</li>
				      	</ul>
					</div>	
				</div><!--/span-->
				
			</div><!--/row-->
			<hr>
			<hr>
			<div class="row-fluid">	
				<div class="box span12">
					<div class="box-header">
						<h2><i class="halflings-icon tasks"></i><span class="break"></span>Overall Result</h2>
					</div>
					<div class="box-content">
						<ul class="skill-bar">
							<li>
				            	<h5>Mean ( <?php echo $overall_mean_percentage;?>% )</h5>
				            	<div class="meter purple"><span style="width: <?php echo $overall_mean_percentage*11.32;?>px; background: rgb(255, 196, 13);"></span></div><!-- Edite width here -->
				          	</li>
				        	<li>
				            	<h5>Median ( <?php echo $overall_median_percentage;?>% )</h5>
				            	<div class="meter yellow"><span style="width: <?php echo $overall_median_percentage*11.32;?>px; background: rgb(255, 196, 13);"></span></div><!-- Edite width here -->
				          	</li>
				          	<li>
				            	<h5>Mode ( <?php echo $overall_mode_percentage;?>% )</h5>
				            	<div class="meter blue"><span style="width: <?php echo $overall_mode_percentage*11.32;?>px; background: rgb(45, 137, 239);"></span></div><!-- Edite width here -->
				          	</li>
				          	<li>
				            	<h5>Probability ( <?php echo $overall_probability_percentage;?>% )</h5>
				            	<div class="meter pink"><span style="width: <?php echo $overall_probability_percentage*11.32;?>px; background: rgb(159, 0, 167);"></span></div><!-- Edite width here -->
				          	</li>
				          	<li>
				            	<h5>Histogram ( <?php echo $overall_histogram_percentage;?>% )</h5>
				            	<div class="meter green"><span style="width: <?php echo $overall_histogram_percentage*11.32;?>px; background: rgb(0, 163, 0);"></span></div><!-- Edite width here -->
				          	</li>
				      	</ul>
					</div>	
				</div><!--/span-->
				
			</div><!--/row-->
			
	</div><!--/.fluid-container-->
	</div>
	
			<!-- end: Content -->
		
		
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
