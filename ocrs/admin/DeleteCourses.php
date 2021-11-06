<?php

$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$c_id = $_POST["c_id"];

// Create connection
$conn = mysqli_connect($servername, $dbusername, $dbpassword,'project');


$result = mysqli_query($conn,"delete from course_assignment where c_id='$c_id'");
if($result){
	$result = mysqli_query($conn,"update user_courses_enrolled set estatus='c' where c_id='$c_id'");
}

if($result)	{
	echo "success";
} else {
	echo "Error";
}

?>