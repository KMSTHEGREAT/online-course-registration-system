<?php

$servername = "localhost";
$dbusername = "root";
$dbpassword = "";

// Create connection
$conn = mysqli_connect($servername, $dbusername, $dbpassword,'project');  
$courseid = mysqli_real_escape_string($conn, $_POST['courseid']);

if (isset($_POST['action'])) {
    switch ($_POST['action']) {
		case 'Insert':
		    $coursenumber = mysqli_real_escape_string($conn, $_POST['coursenumber']);
			$instructor = mysqli_real_escape_string($conn, $_POST['instructor']);
			$fees = mysqli_real_escape_string($conn, $_POST['fees']);
			$termid = mysqli_real_escape_string($conn, $_POST['termid']);
			$deptid= mysqli_real_escape_string($conn, $_POST['deptid']);
			$coursename = mysqli_real_escape_string($conn, $_POST['coursename']);
			$description= mysqli_real_escape_string($conn, $_POST['description']);
         
            insert($conn,$courseid,$coursenumber,$instructor,$fees,$termid,$deptid,$coursename,$description);
			break;
    }
}

if(mysqli_connect_errno()){
	echo "Failed";
}	

function insert($conn,$courseid,$coursenumber,$instructor,$fees,$termid,$deptid,$coursename,$description)
{
	
	$sql = "INSERT INTO `course_details`(`c_id`, `c_no`, `fees`, `d_no`, `c_name`, `descr`) VALUES ('$courseid','$coursenumber','$fees','$deptid','$coursename','$description')";
	$result = mysqli_query($conn,$sql);
	echo $sql;
	
	$sql1 = "INSERT INTO course_assignment(c_id,lname,term_id,status) VALUES ('$courseid','$instructor','$termid','1')";
	$result1 = mysqli_query($conn,$sql1);
	echo $sql1;
	
	$sql2 = "INSERT INTO term_code(status,term_id) VALUES ('1','$termid')";
	$result2 = mysqli_query($conn,$sql2);
	echo $sql2;
	
	exit;
}	

mysqli_close($conn);

?>