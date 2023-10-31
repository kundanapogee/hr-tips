<?php 
session_start();

if (isset($_POST['submitFormBtn'])) {
	require '../include/connection.php';

	$event_name = $_POST['event_name'];
	$start_date = $_POST['start_date'];
	$end_date = $_POST['end_date'];
	$classname = $_POST['classname'];

	$created_at = date('Y-m-d h:i:s');
	$updated_at = date('Y-m-d h:i:s');

	$query = $conn->prepare("INSERT INTO events(event_name,start_date,end_date,classname,created_at,updated_at) values(:event_name,:start_date,:end_date,:classname,:created_at,:updated_at)");
	$query->bindParam(':event_name',$event_name);
	$query->bindParam(':start_date',$start_date);
	$query->bindParam(':end_date',$end_date);
	$query->bindParam(':classname',$classname);
	$query->bindParam(':created_at',$created_at);
	$query->bindParam(':updated_at',$updated_at);
	if($query->execute()){
		$_SESSION['amsg'] = '<div class="alert alert-success alert-dismissible myAlertBox">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		Added successfully.
		</div>';
		header("location:../eventsList.php");
	}else{
		$_SESSION['amsg'] = '<div class="alert alert-danger alert-dismissible myAlertBox">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		Something went wrong.
		</div>';
		header("location:../eventsList.php");			    			
	}
}else{
	header("location:../login.php");
}





?>