<?php 
session_start();

if (isset($_POST['submitFormBtn'])) {
	require '../include/connection.php';

	// $empID = $_POST['emp_id'];
	$empID = $_SESSION['empIDSESS'];
	$leave_type_id = $_POST['leave_type_id'];
	$from_date = $_POST['from_date'];
	$to_date = $_POST['to_date'];
	$day_type = $_POST['day_type'];
	$reason = $_POST['reason'];

	$query = $conn->prepare("SELECT id,title,full_name From employee where id = :empID");
	$query->bindParam(':empID',$empID);
	$query->execute();
	$employeeResult = $query->fetchAll();
	$employeeRow = count($employeeResult);
	if (isset($employeeRow)) {
	  if ($employeeRow>0) {    
	    foreach ($employeeResult as $value) { 
	      $main_title = $value['title'];
	      $main_full_name = $value['full_name'];
	      $complete_name = $main_title." ".$main_full_name;
	    }
	  }
    }


	$query = $conn->prepare("SELECT * From leave_type where id = :leave_type_id");
    $query->bindParam(':leave_type_id',$leave_type_id);
    $query->execute();
    $leaveTypeResult = $query->fetchAll();
    $leaveTypeRow = count($leaveTypeResult);
    if((isset($leaveTypeRow))>0) {
    	foreach ($leaveTypeResult as $value) {
    	   $leaveTypeName = $value['leave_type_name'];
    	   $leaveTypeShortName = $value['short_name'];
    	}
    }

	

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


// hr@apogeegnss.com,

$subject = "Request for leave from ".$complete_name;

// $to = "kundanapogee@gmail.com,apogeepre@gmail.com";

$to = "hr@apogeegnss.com,tanuj@apogeegnss.com,gurdave@apogeegnss.com,jpss1277@gmail.com";

$message = "
<html>
<head>
<title>Leave Email ".$complete_name."</title>
</head>
<body>
<p>E-MAIL FROM AMBAR APPLICATION</p>
<table>
<tr>
<th>Employee Name</th>
<th>".$complete_name."</th>
</tr>
<tr>
<td>From Date</td>
<td>".$from_date."</td>
</tr>
<tr>
<td>To Date</td>
<td>".$to_date."</td>
</tr>
<tr>
<td>Leave Type Name</td>
<td>".$leaveTypeName."</td>
</tr>
<tr>
<td>Day Type</td>
<td>".$day_type."</td>
</tr>
<tr>
<td>Day Count</td>
<td>".$day_count."</td>
</tr>
<tr>
<td>Reason</td>
<td>".$reason."</td>
</tr>
</table>
</body>
</html>
";



$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: <webmaster@example.com>' . "\r\n";
// $headers .= 'Cc: myboss@example.com' . "\r\n";

if(mail($to,$subject,$message,$headers)){
    $query = $conn->prepare("INSERT INTO employee_leave(emp_id,from_date,to_date,leave_type_id,reason,is_approved,day_type,day_count,leave_year,created_at,updated_at) values(:emp_id,:from_date,:to_date,:leave_type_id,:reason,:is_approved,:day_type,:day_count,:leave_year,:created_at,:updated_at)");
	$query->bindParam(':emp_id',$empID);
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
			$path = "../admin/upload/leaveAttachment/".$imgFullName;
			if(move_uploaded_file($img_tmp_name, $path)){
				
				$query = $conn->prepare("UPDATE employee_leave SET 
											attached_file = :attached_file where id = :id ");
				$query->bindParam(':attached_file',$imgFullName);
				$query->bindParam(':id',$employeeLeaveLastId);
				if($query->execute()){					
					$_SESSION['msg'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
	                                                <i class="fas fa-smile-beam me-1"></i>
	                                                Leave Added successfully.
	                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	                                            </div>';
					header("location:../leave-list-by-employee.php");
				}
			}
		}
		$_SESSION['msg'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
	                                                <i class="fas fa-smile-beam me-1"></i>
	                                                Leave Added successfully.
	                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	                                            </div>';
		header("location:../leave-list-by-employee.php");
	}else{
		$_SESSION['msg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
	                                                <i class="fas fa-sad-tear me-1"></i>
	                                                 Something went wrong.
	                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	                                            </div>';
		header("location:../leave-list-by-employee.php");			    			
	}
  }else{
		$_SESSION['msg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
	                                                <i class="fas fa-sad-tear me-1"></i>
	                                                 Mail Not sent. Please try again.
	                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	                                            </div>';
		header("location:../leave-list-by-employee.php");
	}
}else{
	header("location:../login.php");
}





?>