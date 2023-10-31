<?php 
session_start();

if (isset($_POST['submitFormBtn'])) {
	require '../include/connection.php';

	$designation_name = $_POST['designation_name'];

	$query = $conn->prepare("INSERT INTO designation(designation_name) values(:designation_name)");
	$query->bindParam(':designation_name',$designation_name);
	if($query->execute()){
		$_SESSION['amsg'] = '<div class="alert alert-success alert-dismissible myAlertBox">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		Added successfully.
		</div>';
		header("location:../designationList.php");
	}else{
		$_SESSION['amsg'] = '<div class="alert alert-danger alert-dismissible myAlertBox">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		Something went wrong.
		</div>';
		header("location:../designationList.php");			    			
	}
}else{
	header("location:../login.php");
}





?>