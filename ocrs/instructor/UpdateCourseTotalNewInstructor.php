<?php

$servername = "localhost";
$dbusername = "root";
$dbpassword = "";

// Create connection
$conn = mysqli_connect($servername, $dbusername, $dbpassword,'project');  
$courseid = mysqli_real_escape_string($conn, $_POST['courseid']);

if (isset($_POST['action'])) {
    switch ($_POST['action']) {
		case 'update':
		    $instructor= mysqli_real_escape_string($conn, $_POST['instructor']);
			$coursename = mysqli_real_escape_string($conn, $_POST['coursename']);
			echo $coursename;
			$description= mysqli_real_escape_string($conn, $_POST['description']);
        	echo $description;
			$fees= mysqli_real_escape_string($conn, $_POST['fees']);
			update($conn,$courseid,$coursename,$description,$instructor,$fees);
			break;
    }
}

if(mysqli_connect_errno()){
	echo "Failed";
}	
function update($conn,$courseid,$coursename,$description,$instructor,$fees)
{
	
	$sql = "update course_details set c_name='$coursename',descr='$description',fees='$fees' where c_id='$courseid'";
	$result = mysqli_query($conn,$sql);
	$sql1 = "update course_assignment set lname='$instructor' where c_id='$courseid'";
	$result1 = mysqli_query($conn,$sql1);
	exit;
}

mysqli_close($conn);

?>