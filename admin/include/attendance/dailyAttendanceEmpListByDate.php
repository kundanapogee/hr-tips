<?php 
session_start();

if (!empty($_POST['attendanceDate'])) {
	require '../connection.php';

	$attendanceDate = $_POST['attendanceDate'];

	$query = $conn->prepare("SELECT id,full_name,title From employee");
	$query->execute();
	$employeeResult = $query->fetchAll();
	$employeeRow = count($employeeResult);
	// $new = [];
	if (isset($employeeRow)) {
		if ($employeeRow>0) {
			foreach ($employeeResult as $value) {
				$employeeID = $value['id'];
                $employeeTitle = $value['title'];
                $employeeName = $value['full_name'];
                $employeeFullName = $employeeTitle." ".$employeeName;

				$query = $conn->prepare("SELECT * from daily_attendance where employee_id = :employeeID and attendance_date = :attendance_date");
			    $query->bindParam(':employeeID',$employeeID);
			    $query->bindParam(':attendance_date',$attendanceDate);
			    $query->execute();
			    $attendanceDateEmpResult = $query->fetchAll();
			    // $new[] = $attendanceDateEmpResult;
			    $attendanceDateEmpRow = count($attendanceDateEmpResult);
			    if ($attendanceDateEmpRow>0) {
			       foreach ($attendanceDateEmpResult as $value) {
			            $dailyAttendanceEmpID = $value['employee_id'];
			            $empEntry_time = $value['entry_time'];
			        }
			    }else{
			    	$empEntry_time = "";
			    }


			echo'<tr>
			    <td>
			        <div class="form-check font-size-16">
			            <input class="form-check-input" name="lunch_taken_id[]" type="checkbox" id="orderidcheck01" value="'.$employeeID.'" ';if(isset($dailyAttendanceEmpID)){ if($dailyAttendanceEmpID==$employeeID){ echo "checked"; } } echo '>
			            <label class="form-check-label" for="orderidcheck01"></label>
			        </div>
			    </td>
			    <td><a href="javascript: void(0);" class="text-body fw-bold">'.$employeeFullName.'</a> </td>
			    <td><a href="javascript: void(0);" class="text-body fw-bold">';if(isset($empEntry_time)){echo $empEntry_time; } echo '</a> </td>
			    
			    <td>'.$attendanceDate.'</td>
			</tr>';
							
			}
		}
	}

	// if($query->execute()){		
	// 	$message = array("status"=>"true","messages"=>"You are great");
	// 	echo json_encode($message);
	// }else{
	// 	$message = array("status"=>"false","messages"=>"You are not great");
	// 	echo json_encode($message);
	// }
	
}else{
	header("location:../login.php");
}

// echo "<pre>";
// print_r($new);
// die;


	

?>