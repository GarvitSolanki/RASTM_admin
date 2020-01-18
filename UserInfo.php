<?php

if(isset($_GET['id'])){

    $trackd = $_GET['id'];
    /* $sql = "SELECT * FROM something  WHERE submission = $track";
    mysqli fetch assoc 
    array 
    */
	

  /*$servername = "111.118.215.168";
	$username = "aaditikc_rastm_n";
	$password = "#2^7rQgr~&mi";
    $dbname = "aaditikc_rastm_paper";
    */
    $servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "aaditikc_rastm_paper";
	// Create connection
	$con = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$con) {
		die("Connection failed: " . mysqli_connect_error());
	}
	$query = "SELECT researcher_info.*,submissions.*,authors.* FROM submissions INNER JOIN researcher_info 
	ON researcher_info.researcher_id = submissions.researcher_id INNER JOIN authors ON authors.submission_id = submissions.submission_id WHERE researcher_info.researcher_id='$id';";
	/* $query2 = "SELECT * FROM `researcher_info`;"; */
    $result = mysqli_query($con,$query) or die(mysqli_error($con));
      $i=0;
	while($row = mysqli_fetch_assoc($result))
	{
		
		echo '
			<tr>
				<td class="text-center">'.($i+1).'</td>
				<td>'.$row['r_name'].'</td>
				<td class="text-center">'.$row['title'].'</button></td>
				<td class="text-center">'.$row['submission_track'].'</td>
				<td class="text-center">'.$row['email'].'</td>
				<td class="text-center">'.$row['No_of_authors'].'</td>
				<td class="text-center">'.$row['submission_time'].'</td>
				<td class="text-center"><a class="btn btn-outline-danger btn-circle" target="_blank" href="http://52.206.184.26/paper/Uploads/'.$row['submitted_file_name'].'"><i class="fa fa-download"></i></a></td>
				';
				echo '

			</tr>

		';
		$i++;
	}	
	
}



?>