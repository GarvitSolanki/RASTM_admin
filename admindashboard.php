<?php
session_start();
$username = $_SESSION['username'] or header("Location: ./index.php");
/* var_dump($_POST); */
if($_SESSION['verified']=="true")
{
	$servername = "111.118.215.168";
	$username = "aaditikc_rastm_n";
	$password = "#2^7rQgr~&mi";
	$dbname = "aaditikc_rastm_paper";
	// Create connection
	$con = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$con) {
		die("Connection failed: " . mysqli_connect_error());
	}
	$query = "SELECT researcher_info.r_name,submissions.title,submissions.no_of_pages,submissions.submission_track,submissions.No_of_authors,submissions.submitted_file_name FROM submissions  INNER JOIN researcher_info 
	ON researcher_info.researcher_id = submissions.researcher_id;";
	/* $query2 = "SELECT * FROM `researcher_info`;"; */
	$result = mysqli_query($con,$query) or die(mysqli_error($con));
	
}
else
{
	header("Location: ./index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Amigos</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>


	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
	<script>
    function marksolved(id,rev)
	{
		document.getElementById("preloader").style.display = "block";
		$.ajax({
             url:"marksolved.php?id=" +id+ "&rev=" + rev, //the page containing php script
             type: "get", //request type,
             success:function(){
							 document.getElementById("preloader").style.display = "none"
							 Swal.fire(
									'success!',
									'order marked as Delivered!',
									'success'
								)

							window.location.reload();
            }
          });
	}
	function markpending(id,rev)
	{
		document.getElementById("preloader").style.display="block";
		$.ajax({
             url:"markpending.php?id=" +id+ "&rev=" + rev, //the page containing php script
             type: "get", //request type,
             success:function(){

						 		document.getElementById("preloader").style.display="none";
								Swal.fire(
								   'success!',
								   'order marked as Pending!',
								   'success'
								 )

							window.location.reload();
            }
          });

	}
    </script>
    <!-- Javscript Auto Refresh-->
    <script type="text/JavaScript">
         <!--
            function AutoRefresh( t ) {
               setTimeout("location.reload(true);", t);
            }
         //-->
     </script>
</head>
<body onload="JavaScript:AutoRefresh(1500000);">
	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span></button>
				<a class="navbar-brand" href="#"><span>Ras</span>Tm 2020</a>
				<div class="pull-right">
					<a class="btn  pull-right navbar-brand" href="./index.php">Logout</a>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</nav>
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">

		<ul class="nav menu">
			<li class="active"><a href="www.rastm.i3lab.in"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>

		<div class="divider"></div>
		<br>
			<li style="padding:2%;"><a href="#" class="btn btn-success"><em class="fa fa-plane">&nbsp;</em><strong>Submission Tracker</strong></a></li>
			<!-- <li style="padding:2%;"><a href="#" class="btn btn-warning"><em class="fa fa-plane fa-flip-vertical">&nbsp;</em><strong> Plane Landing</strong></a></li>
			<li style="padding:2%;"><a href="#" class="btn btn-danger"><em class="fa fa-exclamation-triangle">&nbsp;</em><strong> Emergency</strong></a></li> -->

		</ul>
	</div><!--/.sidebar-->

	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Dashboard</li>
				
			</ol>
			
		</div><!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Paper Submissions</h1>
			</div>
          
		</div><!--/.row-->

		<!-- <div class="panel panel-container">
			<div class="row">
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-teal panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-shopping-cart color-blue"></em>
							<div class="large"></div>
							<div class="text-muted">Number of Total Submissons</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-blue panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-hourglass-half color-orange"></em>
							<div class="large"><span id="pendingorders"></span></div>
							<div class="text-muted">Pending Orders</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-orange panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-users color-teal"></em>
							<div class="large"><span id="deliveredorders"></span></div>
							<div class="text-muted">Delivered Orders</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-red panel-widget ">
						<div class="row no-padding"><em class="fa fa-xl fa-exclamation-triangle color-red"></em>
							<div class="large">2</div>
							<div class="text-muted">Special Requests</div>
						</div>
					</div>
				</div>
			</div><!--/.row-->
		</div> -->
	</div>	<!--/.main-->

	<!-- Table View Start -->

	<div class="container table-responsive pull-right col-sm-9 col-xs-10 col-md-10">
		<!--<h2 style="text-align:center">Manage Complains</h2>-->
	<table class="table table-hover">
		<thead>
			<tr>
				<th class="text-center">Sr. No.</th>
				<th>Name of Author</th>
				<th class="text-center">Submission Name</th>
				<th class="text-center">No of Pages</th>
				<th class="text-center">Submission Track</th>
				<th class="text-center">No of Authors</th>
				<th class="text-center">Action</th>
			</tr>
		</thead>
		<tbody>

	<?php

/* 	for ($i=0; $i < mysqli_num_rows($result); $i++)
	{
		$doc[$i] = $rows[$i]['doc'];
		if(isset($doc[$i]["username"]))
		{

		echo '
			<tr>
				<td class="text-center">'.($i+1).'</td>
				<td>'.$doc[$i]['username'].'</td>
				<td class="text-center">'.$doc[$i]['seatnumber'].'</button></td>
				<td class="text-center">'.$doc[$i]['fooditem'].'</td>
				';
				if($doc[$i]['status'] == "True")
				{
					$deliveredorders++;
					echo '
					<td class="text-center"><button class="btn btn-success"><i class="fa fa-check-circle"></i> Delivered</button></td>
					<td class="text-center"><button class="btn btn-warning" onclick="markpending(\''.$doc[$i]['_id'].'\',\''.$doc[$i]['_rev'].'\')"><i class="fa fa-eye"></i> Mark as Pending</button></td>
					';
				}
				else
				{
					$pendingorders++;
					echo '
					<td class="text-center"><button class="btn btn-danger"><i class="fa fa-times-circle"></i> Pending</button></td>
					<td class="text-center"><button class="btn btn-warning" onclick="marksolved(\''.$doc[$i]['_id'].'\',\''.$doc[$i]['_rev'].'\')"><i class="fa fa-check"></i> Mark as Delivered</button></td>
					';

				}
				echo '

			</tr>

		';
		}
	}
 */	
	$i=0;
	while($row = mysqli_fetch_assoc($result))
	{
		
		echo '
			<tr>
				<td class="text-center">'.($i+1).'</td>
				<td>'.$row['r_name'].'</td>
				<td class="text-center">'.$row['title'].'</button></td>
				<td class="text-center">'.$row['no_of_pages'].'</td>
				<td class="text-center">'.$row['submission_track'].'</td>
				<td class="text-center">'.$row['No_of_authors'].'</td>
				<td class="text-center"><a class="btn btn-outline-danger btn-circle" href="http://52.206.184.26/paper/Uploads/'.$row['submitted_file_name'].'"><i class="fa fa-download"></i></a></td>
				';
				echo '

			</tr>

		';
	}	

	?>

	</tbody>
	</table>
	</div>

	<script type="text/javascript">
		document.getElementById("pendingorders").innerHTML = <?php echo $pendingorders; ?>;
		document.getElementById("deliveredorders").innerHTML = <?php echo $deliveredorders; ?>;
	</script>

	<!-- Table View End-->
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/custom.js"></script>
<!-- preloader -->
		 	<div id="preloader" class="preloader">
         <div class="loader-circle"></div>
         <div class="loader-circle1"></div>
         <div class="loader-logo"></div>
			 </div>

</body>
</html>
