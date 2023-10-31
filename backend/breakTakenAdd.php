<?php 
session_start();

if (isset($_POST['submitFormBtn'])) {
	require '../include/connection.php';

	$empID = $_SESSION['empIDSESS'];

	$break_date = date('Y-m-d');
	$from_time = date('h:i:s A');
	$from_reason = $_POST['from_reason'];

	$created_at = date('Y-m-d h:i:s');


	$query = $conn->prepare("SELECT * from daily_attendance where employee_id = :employee_id and attendance_date = :attendance_date");
    $query->bindParam(':employee_id',$empID);
    $query->bindParam(':attendance_date',$break_date);
    $query->execute();
    $empDailyAttResult = $query->fetchAll();
    $empDailyAttRow = count($empDailyAttResult);
    if(isset($empDailyAttRow)) {
    	if ($empDailyAttRow==0) {    	
	    	$_SESSION['msg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
	                                                <i class="fas fa-sad-tear me-1"></i>
	                                                 Your attendance is not mark today. First you mark your attendance and take break.
	                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	                                            </div>';
			 header("location:../breakTimeList.php");
		die();  
		}   
   }



    $query = $conn->prepare("INSERT INTO break_time_in_out(employee_id,break_date,from_time,from_reason,created_at) values(:employee_id,:break_date,:from_time,:from_reason,:created_at)");
	$query->bindParam(':employee_id',$empID);
	$query->bindParam(':break_date',$break_date);
	$query->bindParam(':from_time',$from_time);
	$query->bindParam(':from_reason',$from_reason);
	$query->bindParam(':created_at',$created_at);
	if($query->execute()){	
		$_SESSION['msg'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
	                                                <i class="fas fa-smile-beam me-1"></i>
	                                                You have taken break successfully.
	                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	                                            </div>';
		header("location:../breakTimeList.php");
	}else{
		$_SESSION['msg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
	                                                <i class="fas fa-sad-tear me-1"></i>
	                                                 Something went wrong.
	                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	                                            </div>';
		header("location:../breakTimeList.php");
	}



}else{
	header("location:../login.php");
}



?>