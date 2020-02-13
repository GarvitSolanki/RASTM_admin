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
    /*
    $servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "aaditikc_rastm_paper";
	*/
	// Create connection
	$con = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$con) {
		die("Connection failed: " . mysqli_connect_error());
	}
	$query = "SELECT researcher_info.r_name,researcher_info.email,submissions.submission_time,submissions.submission_id,submissions.title,submissions.no_of_pages,submissions.submission_track,submissions.No_of_authors,submissions.submitted_file_name FROM submissions  INNER JOIN researcher_info 
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
	<link href="css/datepicker.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>


	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->

    <!-- Javscript Auto Refresh-->
    <script type="text/JavaScript">
         <!--
            function AutoRefresh( t ) {
               setTimeout("location.reload(true);", t);
            }
         //-->
	 </script>
	 <style>
		 .tt{
			 color: black;
		 }
		 .tt:hover{
			 background: #30a5ff; 
		 }
		 
	</style>
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
			

		<div class="divider"></div>
		<br>
		
			<li style="padding:2%;"><a href="admindashboard.php" class="btn btn-success"><em class="fa fa-clock-o">&nbsp;</em><strong>All Submissions</strong></a></li>
			<li  style="padding:2%;"><button style="width:100%; padding: 5% 0 5% 0;" id="T1" value="Engineering" class="btn btn-info tt"><em class="fa fa-cogs">&nbsp;</em><strong> Engineering Track</strong></a></li>
			<li  style="padding:2%;"><button style="width:100%; padding: 5% 0 5% 0;"id="T2" value="Science" class="btn btn-info tt"><em class="fa fa-flask">&nbsp;</em><strong> Science Track</strong></button></li>
			<li style="padding:2%;"><button style="width:100%; padding: 5% 0 5% 0;" id="T3" value="Management"  class="btn btn-info tt"><em class="fa fa-area-chart">&nbsp;</em><strong> Management Track</strong></button></li>
		<div class="divider"></div>
		<br>
		<div class="input-group input-group-sm mb-3 " style="width:100%;">
			<input type="date" class="form-control" id="date-input">
			
		</div>
		<div style="width:100%;">
				<button style="width:100%;" id="T4" class="btn btn-info tt" type="button">Search By Date</button>
		</div>
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
			</div>/.row-->
		</div> 
	</div>	<!--/.main-->

	<!-- Table View Start -->
	
	<div class="container table-responsive pull-right col-sm-9 col-xs-10 col-md-10">
		<!--<h2 style="text-align:center">Manage Complains</h2>-->
		<div style="padding: 0 2% 3% 0; float: right;" >
			<button id="downloadall"   class="btn btn-warning"><em class="fa fa-download">&nbsp;</em><strong> Download All</strong></button>
		</div>
	<table class="table table-hover" id="info-table">
		<thead>
			<tr>
				<th class="text-center">Paper Id</th>
				<th>Name of Author</th>
				<th class="text-center">Paper Title</th>
				<th class="text-center">Paper Track</th>
				<th class="text-center">Author's Email</th>
				<th class="text-center">No of Authors</th>				
				<th class="text-center">Submission Time</th>
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
				<td class="text-center">'.$row['submission_id'].'</td>
				<td>'.$row['r_name'].'</td>
				<td class="text-center">'.$row['title'].'</button></td>
				<td class="text-center">'.$row['submission_track'].'</td>
				<td class="text-center">'.$row['email'].'</td>
				<td class="text-center">'.$row['No_of_authors'].'</td>
				<td class="text-center">'.$row['submission_time'].'</td>
				<td class="text-center"><a class="btn btn-outline-danger btn-circle" target="_blank" href="http://52.206.184.26/paper_submission/Uploads/'.$row['submitted_file_name'].'"><i class="fa fa-download"></i></a></td>
				';
				echo '

			</tr>

		';
		$i++;
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
<script>
/*function getdatabytrack(a){
	ajax data -> a,
	method get 
	sucess(

		table append
	)
	
}
*/
$("#T1").click(function(){
	track=$("#T1").val();
	
  $.ajax({url: "SearchTrackApi.php", method: "get", data: {trackName : track},success: function(result){
    $("tbody").html(result);
  }});
});

$("#T2").click(function(){
	track=$("#T2").val();
	
  $.ajax({url: "SearchTrackApi.php", method: "get", data: {trackName : track},success: function(result){
    $("tbody").html(result);
  }});
});

$("#T3").click(function(){
	track=$("#T3").val();
	
  $.ajax({url: "SearchTrackApi.php", method: "get", data: {trackName : track},success: function(result){
    $("tbody").html(result);
  }});
});


$('#T4').on('click', function(){
  var date = new Date($('#date-input').val());
  day = date.getDate();
  month = date.getMonth() + 1;
  year = date.getFullYear();
  if (month < 10){ month = "0" + month;}
        if (day < 10) {day = "0" + day;}
        if(month=="13")
        {
          month = "01";
          year = date.getFullYear()+1;
        }
  td=[year, month,day ].join('-');
  
  $.ajax({url: "SearchDateApi.php", method: "get", data: {trackDate : td},success: function(result){
    $("tbody").html(result);
  }});
});

 TableData = new Array();
    

$("#downloadall").click(function(){
	TableData = new Array();
	$('tbody tr a').each(function(row){
		TableData[row]=$(this).attr('href');
		$(this).trigger('click');
	});

	alert(TableData);
});


</script>
</html>
