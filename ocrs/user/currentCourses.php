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
$query = "SELECT c.c_id as id, c.c_name as name, c.descr as descr from course_details c,user_courses_enrolled u where u.net_id = '$net_id' and u.c_id = c.c_id and u.estatus = 'e'";
mysqli_prepare($conn,$query);
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
       