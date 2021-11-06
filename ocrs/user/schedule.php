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

// Create connection
$conn = mysqli_connect($servername, $dbusername, $dbpassword,'project');

$result = mysqli_query($conn,"SELECT course_details.c_id as id, course_details.c_name as name, course_details.descr as descr FROM course_details ,user_courses_enrolled  WHERE user_courses_enrolled.net_id = '$net_id' and user_courses_enrolled.c_id = course_details.c_id and user_courses_enrolled.estatus != 'c'");

$json = array();

if ($result) {
	
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
       