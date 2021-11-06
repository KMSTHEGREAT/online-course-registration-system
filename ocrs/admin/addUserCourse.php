<?php

$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$c_id = $_POST['c_id'];
$net_id = $_POST['netId'];


//Create connection
$conn = mysqli_connect($servername, $dbusername, $dbpassword,'project');


$result = mysqli_query($conn,"INSERT INTO user_courses_enrolled VALUES ('$net_id',$c_id,'e')");
	
if($result)	{
	echo "success";
} else {
	echo "Error";
}

?>