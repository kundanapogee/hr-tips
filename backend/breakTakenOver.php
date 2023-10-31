<?php 
session_start();

if (isset($_POST['submitFormBtn'])) {
	require '../include/connection.php';

	$empID = $_SESSION['empIDSESS'];

    $break_id = $_POST['break_id'];
	$to_reason = $_POST['to_reason'];
	
	$to_time = date('h:i:s A');
	$created_at = date('Y-m-d h:i:s');

	// die();


	$query = $conn->prepare("SELECT * from break_time_in_out where id = :break_id");
	$query->bindParam(':break_id',$break_id);
	$query->execute();
	$todayAttResult = $query->fetchAll();
	$todayAttRow = count($todayAttResult);
	if (isset($todayAttRow)) {
		if ($todayAttRow>0) {
			$from_time = $todayAttResult[0]['from_time'];
		    $end_time = new DateTime($to_time);
	        $start_time = new DateTime($from_time);
	        $timediff = $end_time->diff($start_time);
	        $total_time = $timediff->format('%h:%i:%s');
		}
	}


    $query = $conn->prepare("UPDATE break_time_in_out SET 
    					to_time = :to_time,
    					to_reason = :to_reason,
    					total_time = :total_time where id = :id");
	$query->bindParam(':to_time',$to_time);
	$query->bindParam(':to_reason',$to_reason);
	$query->bindParam(':total_time',$total_time);
	$query->bindParam(':id',$break_id);
	if($query->execute()){	
		$_SESSION['msg'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
	                            <i class="fas fa-smile-beam me-1"></i>
	                            Your break has been over successfully.
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