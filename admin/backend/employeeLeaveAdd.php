<?php 
session_start();

if (isset($_POST['submitFormBtn'])) {
	require '../include/connection.php';

	$emp_id = $_POST['emp_id'];
	$leave_type_id = $_POST['leave_type_id'];
	$from_date = $_POST['from_date'];
	$to_date = $_POST['to_date'];
	$day_type = $_POST['day_type'];
	$reason = $_POST['reason'];
	// $attachedFile = $_POST['attachedFile'];
	// $leave_year = 

	$date = DateTime::createFromFormat("Y-m-d", $from_date);
	$leave_year = $date->format("Y");



	$date1 = date_create($from_date);
	$date2 = date_create($to_date);
	$diff = date_diff($date1, $date2);
	$day_count = $diff->format("%a");


	$is_approved = "pending";

	if ($day_type==="full") {
		$day_count = $day_count+1;
	}
	if($day_type==="half") {
		if($day_count==0) {
			$day_count = 0.5;
		}else{
			$day_count = ($day_count+1)/2;
		}		
	}
	if ($leave_type_id==4) {
		$day_count = 1;
		$day_type = "full";
	}


	$created_at = date('Y-m-d h:i:s');
	$updated_at = date('Y-m-d h:i:s');


	$query = $conn->prepare("INSERT INTO employee_leave(emp_id,from_date,to_date,leave_type_id,reason,is_approved,day_type,day_count,leave_year,created_at,updated_at) values(:emp_id,:from_date,:to_date,:leave_type_id,:reason,:is_approved,:day_type,:day_count,:leave_year,:created_at,:updated_at)");
	$query->bindParam(':emp_id',$emp_id);
	$query->bindParam(':from_date',$from_date);
	$query->bindParam(':to_date',$to_date);
	$query->bindParam(':leave_type_id',$leave_type_id);
	$query->bindParam(':reason',$reason);
	$query->bindParam(':is_approved',$is_approved);
	$query->bindParam(':day_type',$day_type);
	$query->bindParam(':day_count',$day_count);
	$query->bindParam(':leave_year',$leave_year);
	$query->bindParam(':created_at',$created_at);
	$query->bindParam(':updated_at',$updated_at);
	if($query->execute()){
		
		$employeeLeaveLastId = $conn->lastInsertId();

		if (!empty($_FILES['attachedFile'])) {
		    $imgName = $_FILES['attachedFile']['name'];
			$imgFullName = date('ymdhis').''.$imgName;
			$img_tmp_name = $_FILES['attachedFile']['tmp_name'];
			$path = "../upload/leaveAttachment/".$imgFullName;
			if(move_uploaded_file($img_tmp_name, $path)){
				
				$query = $conn->prepare("UPDATE employee_leave SET 
											attached_file = :attached_file where id = :id ");
				$query->bindParam(':attached_file',$imgFullName);
				$query->bindParam(':id',$employeeLeaveLastId);
				if($query->execute()){
					$_SESSION['amsg'] = '<div class="alert alert-success alert-dismissible myAlertBox">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					Added successfully.
					</div>';
					header("location:../employeeLeaveList.php");
				}
			}
		}
		$_SESSION['amsg'] = '<div class="alert alert-success alert-dismissible myAlertBox">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		Added successfully.
		</div>';
		header("location:../employeeLeaveList.php");
	}else{
		$_SESSION['amsg'] = '<div class="alert alert-danger alert-dismissible myAlertBox">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		Something went wrong.
		</div>';
		header("location:../employeeLeaveList.php");			    			
	}
}else{
	header("location:../login.php");
}





?>