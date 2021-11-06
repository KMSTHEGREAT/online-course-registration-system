<?php
session_start();
?>

<?php
if(!isset($_SESSION['sess_username'])) {
  header("location: ../index.html");
  exit();
}

?>

<?php

$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$net_id= $_SESSION['sess_username'];
$param1 = $_GET['param1'];

// Create connection
$conn = mysqli_connect($servername, $dbusername, $dbpassword,'project');

$result = mysqli_query($conn,"select term_id from term_code where status = 1");

if ($result) {
	while($row = mysqli_fetch_assoc($result)){
		$term_id = $row["term_id"];
	}
}

if($param1 != "" && $param1 != "All"){
	$query = "SELECT c.c_id as id, c.c_no as cnum, c.fees as fees, c.c_name as cname, c.descr as descr, d.dname as dname, t.c_id, t.term_id, t.status FROM course_details c,department d, course_assignment t WHERE c.d_id = d.d_id and d.d_id='$param1' and c.c_id = t.c_id and t.term_id = '$term_id' and t.status = '1'";
	mysqli_prepare($conn,$query);
	$result = mysqli_query($conn,$query);
} else {
	$result = mysqli_query($conn,"SELECT course_details.c_id as id, course_details.c_no as cnum, course_details.fees as fees, course_details.c_name as cname, course_details.descr as descr, department.dname as dname FROM course_details, department WHERE department.d_id = course_details.c_id");
}

if ($result) {
	$json = array();
	 while ($row = mysqli_fetch_assoc($result))
        {
		 $json[] = $row; 
        }
	$response = array(
		"data" => $json
	);

	echo json_encode($response);
} else {
    	$json = array();
	$response = array(
		"data" => $json
	);
	echo json_encode($response);
}

mysqli_close($conn);

?>
       