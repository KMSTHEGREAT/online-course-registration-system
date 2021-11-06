<?php

$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$param1 = $_GET['param1'];

// Create connection
$conn = mysqli_connect($servername, $dbusername, $dbpassword,'project');
if(mysqli_connect_errno()){
	echo 'error:'. mysqli_connect_errno();
}

$query = "SELECT course_details.c_id as id, course_details.c_no as cnum, course_details.fees as fees, course_details.c_name as cname, course_details.descr as descr, department.dname as dname FROM course_details ,department WHERE course_details.d_no = department.d_id";
$result = mysqli_query($conn,$query);

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
       