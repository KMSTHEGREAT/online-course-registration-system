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
$c_id = $_POST["c_id"];

// Create connection
$conn = mysqli_connect($servername, $dbusername, $dbpassword,'project');


$result = mysqli_query($conn,"delete from user_courses_enrolled where c_id=$c_id and net_id = '$net_id'");
if($result)	{
	echo "success";
} else {
	echo "Error";
}

?>