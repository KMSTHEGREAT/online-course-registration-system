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
$c_id = $_POST['c_id'];

//Create connection
$conn = mysqli_connect($servername, $dbusername, $dbpassword,'project');

foreach( $c_id as $v ) {
	$result = mysqli_query($conn,"INSERT INTO `user_courses_enrolled`(`c_id`, `net_id`, `estatus`) VALUES ($v,'$net_id','e')");
	if($result)
		$result = mysqli_query($conn,"DELETE FROM user_cart where net_id='$net_id' and c_id = $v");
	else {
		$result = false;
		break;
	}
}
if($result)	{
	echo "success";
} else {
	echo "Error";
}

?>