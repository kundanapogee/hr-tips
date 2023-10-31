<?php 
session_start();

if (isset($_POST['submitFormBtn'])) {
	require '../include/connection.php';

	if ((empty($_POST['entry_latitude'])) ||($_POST['entry_longitude'])) {
		$_SESSION['msg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
	                                                <i class="fas fa-sad-tear me-1"></i>
	                                                 Please allow your location.
	                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	                                            </div>';
		header("location:../attendanceList.php");
	}

	$emp_id = $_POST['emp_id'];
	// echo "<br>";
	$attendance_date = $date = date('Y-m-d');;

	// echo "<br>";
	echo $entry_time = $date = date('h:i:s A');;
	// $exit_time = $_POST['exit_time'];


// die();


	// echo "<br>";
	$attendance_status = $_POST['attendance_status'];
	$remark = $_POST['remark'];

// die();

	$query = $conn->prepare("SELECT * from daily_attendance where employee_id = :employee_id and attendance_date = :attendance_date");
    $query->bindParam(':employee_id',$emp_id);
    $query->bindParam(':attendance_date',$attendance_date);
    $query->execute();
    $empDailyAttResult = $query->fetchAll();
    $empDailyAttRow = count($empDailyAttResult);
    if(isset($empDailyAttRow)) {
    	if ($empDailyAttRow>0) {    	
	    	$_SESSION['msg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
	                                                <i class="fas fa-sad-tear me-1"></i>
	                                                 Attendance already marked today.
	                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	                                            </div>';
			 header("location:../attendanceList.php");
		die();  
		}   
   }


// die();

	// $attendance_date = $_POST['attendance_date'];

	$device_detail = $_SERVER['HTTP_USER_AGENT'];

    $ua = strtolower($_SERVER["HTTP_USER_AGENT"]);
	$isMob = is_numeric(strpos($ua, "mobile"));
	$isTab = is_numeric(strpos($ua, "tablet"));
	$isDesk = !$isMob && !$isTab;
	$isDesk
	  ? $deviceType = "Desktop device"
	  : $deviceType = "Mobile device";
	  // echo $deviceType;

    $ipaddress = getenv("REMOTE_ADDR");



$office_code = 'noida';
$query = $conn->prepare("SELECT * from office_detail where office_code = :office_code order by id desc");
$query->bindParam(':office_code',$office_code);
$query->execute();
$officeCodeResult = $query->fetchAll();
$officeCodeRow = count($officeCodeResult);
if(isset($officeCodeRow)) {
   if ($officeCodeRow>0) {
       foreach ($officeCodeResult as $value) {
           $office_latitude = $value['latitude'];
           // echo "<br>";
           $office_longitude = $value['longitude'];
       }
   }
}



  // $office_latitude = 28.619686;
  // $office_longitude = 77.3807433;


  $entry_latitude = $_POST['entry_latitude'];
	$entry_longitude = $_POST['entry_longitude'];



   // $entry_latitude = 28.579519;
	// $entry_longitude = 77.439529;


function distance($lat1, $lon1, $lat2, $lon2, $unit) {
  if (($lat1 == $lat2) && ($lon1 == $lon2)) {
    return 0;
  }
  else {
    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $unit = strtoupper($unit);

    if ($unit == "K") {
      return ($miles * 1.609344);
    } else if ($unit == "N") {
      return ($miles * 0.8684);
    } else {
      return $miles;
    }
  }
}

// echo distance(28.619686, 77.3807433, 28.579519, 77.439529, "M") . " Miles<br>";
$entry_distance_km = distance($entry_latitude, $entry_longitude, $office_latitude, $office_longitude, "K");
// echo distance(28.619686, 77.3807433, 28.579519, 77.439529, "N") . " Nautical Miles<br>";




// die();
	


	// $exit_latitude = "12371673";
	// $exit_longitude = "12371673";

	$created_at = date('Y-m-d h:i:s');




	$query = $conn->prepare("INSERT INTO daily_attendance(employee_id,attendance_status,attendance_date,entry_time,remark,entry_latitude,entry_longitude,entry_distance,device_detail,device_type,ipaddress,created_at) values(:employee_id,:attendance_status,:attendance_date,:entry_time,:remark,:entry_latitude,:entry_longitude,:entry_distance,:device_detail,:device_type,:ipaddress,:created_at)");
	$query->bindParam(':employee_id',$emp_id);
	$query->bindParam(':attendance_status',$attendance_status);
	$query->bindParam(':attendance_date',$attendance_date);
	$query->bindParam(':entry_time',$entry_time);
	$query->bindParam(':remark',$remark);
	$query->bindParam(':entry_latitude',$entry_latitude);
	$query->bindParam(':entry_longitude',$entry_longitude);
	$query->bindParam(':entry_distance',$entry_distance_km);
	$query->bindParam(':device_detail',$device_detail);
	$query->bindParam(':device_type',$deviceType);
	$query->bindParam(':ipaddress',$ipaddress);
	$query->bindParam(':created_at',$created_at);
	if($query->execute()){		
		$_SESSION['msg'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <i class="fas fa-smile-beam me-1"></i>
                                                	Added Successfully
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>';
		header("location:../attendanceList.php");
	}else{
		$_SESSION['msg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <i class="fas fa-sad-tear me-1"></i>
                                                 Something went wrong
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>';
		header("location:../attendanceList.php");			    			
	}
}else{
	header("location:../login.php");
}





?>