<?php 
ob_start();
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// date_default_timezone_set('Asia/Kolkata');
// echo date('d-m-Y H:i');

if (isset($_POST['submitFormBtn'])) {
	require '../include/connection.php';


	$emp_id = $_POST['emp_id'];
	$attendance_date = date('Y-m-d');
	$exit_time = $date = date('h:i:s A');
	$exit_remark = $_POST['exit_remark'];

	// echo $exit_longitude = $_POST['exit_latitude'];
	// echo "<br>";
	// echo $exit_longitude = $_POST['exit_longitude'];

	if ((empty($_POST['exit_latitude'])) || (empty($_POST['exit_longitude']))) {
		$_SESSION['msg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
	                                                <i class="fas fa-sad-tear me-1"></i>
	                                                 Please allow your location.
	                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	                                            </div>';
		header("location:../attendanceList.php");
	}



	// $query = $conn->prepare("SELECT * from break_time_in_out where employee_id = :employee_id and break_date = :break_date and to_time IS NULL OR to_time = ' ' order by id desc limit 1");

	$query = $conn->prepare("SELECT * from break_time_in_out where employee_id = :employee_id and break_date = :break_date order by id desc limit 1");
	$query->bindParam(':employee_id',$emp_id);
	$query->bindParam(':break_date',$attendance_date);
	$query->execute();
	$todayAttResult = $query->fetchAll();
	$todayAttRow = count($todayAttResult);
	if($todayAttRow>0){
		$to_time = $todayAttResult[0]['to_time'];
		if (empty($to_time)) {
			$_SESSION['msg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
	                                                <i class="fas fa-sad-tear me-1"></i>
	                                                 You have break out but not break in. Please break in before then attendance out.
	                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	                                            </div>';
		  header("location:../attendanceList.php");
		  die();
		}
	}








	$query = $conn->prepare("SELECT * from daily_attendance where employee_id = :employeeID and attendance_date = :attendance_date");
	$query->bindParam(':employeeID',$emp_id);
	$query->bindParam(':attendance_date',$attendance_date);
	$query->execute();
	$todayAttResult = $query->fetchAll();
	$todayAttRow = count($todayAttResult);
	if (isset($todayAttRow)) {
		if ($todayAttRow>0) {
			$entry_time = $todayAttResult[0]['entry_time'];

			$end_time = new DateTime($entry_time);
      $start_time = new DateTime($exit_time);
      $timediff = $end_time->diff($start_time);
      $total_time = $timediff->format('%h:%i:%s');
      	// echo $total_time;

		}
	}


	$exit_device_detail = $_SERVER['HTTP_USER_AGENT'];

  $ua = strtolower($_SERVER["HTTP_USER_AGENT"]);
	$isMob = is_numeric(strpos($ua, "mobile"));
	$isTab = is_numeric(strpos($ua, "tablet"));
	$isDesk = !$isMob && !$isTab;
	$isDesk
	  ? $exit_device_type = "Desktop device"
	  : $exit_device_type = "Mobile device";
	  // echo $exit_device_type;

    $exit_ipaddress = getenv("REMOTE_ADDR");



  $office_latitude = 28.619686;
  $office_longitude = 77.3807433;


  $exit_latitude = $_POST['exit_latitude'];
	$exit_longitude = $_POST['exit_longitude'];



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
$exit_distance_km = distance($exit_latitude, $exit_longitude, $office_latitude, $office_longitude, "K");
// echo distance(28.619686, 77.3807433, 28.579519, 77.439529, "N") . " Nautical Miles<br>";







$query = $conn->prepare("SELECT id, SEC_TO_TIME(SUM(TIME_TO_SEC(total_time))) AS total_time from break_time_in_out where employee_id = :employee_id and break_date = :break_date GROUP BY break_date");
$query->bindParam(':employee_id',$emp_id);
$query->bindParam(':break_date',$attendance_date);
$query->execute();
$breakTimeResult = $query->fetchAll();

if (!empty($breakTimeResult[0]['total_time'])) {
	$break_time = $breakTimeResult[0]['total_time'];
}else{
	$break_time = 0;
}



	$query = $conn->prepare("SELECT * from daily_attendance where employee_id = :employee_id and attendance_date = :attendance_date");
  $query->bindParam(':employee_id',$emp_id);
  $query->bindParam(':attendance_date',$attendance_date);
  $query->execute();
  $empDailyAttResult = $query->fetchAll();
  $empDailyAttRow = count($empDailyAttResult);

    if(isset($empDailyAttRow)) {
    	if ($empDailyAttRow>0) { 
	    	$query = $conn->prepare("UPDATE daily_attendance SET 
	    														exit_time = :exit_time,
	    														exit_remark = :exit_remark,
	    														exit_latitude = :exit_latitude,
	    														exit_longitude = :exit_longitude,
	    														exit_distance = :exit_distance,
	    														exit_device_detail = :exit_device_detail,
	    														exit_device_type = :exit_device_type,
	    														exit_ipaddress = :exit_ipaddress,
	    														break_time = :break_time,
	    														total_time = :total_time
	    														WHERE employee_id = :employee_id and attendance_date = :attendance_date");
				$query->bindParam(':exit_time',$exit_time);
				$query->bindParam(':exit_remark',$exit_remark);
				$query->bindParam(':exit_latitude',$exit_latitude);
				$query->bindParam(':exit_longitude',$exit_longitude);
				$query->bindParam(':exit_distance',$exit_distance_km);
				$query->bindParam(':exit_device_detail',$exit_device_detail);
				$query->bindParam(':exit_device_type',$exit_device_type);
				$query->bindParam(':exit_ipaddress',$exit_ipaddress);				
				$query->bindParam(':break_time',$break_time);
				$query->bindParam(':total_time',$total_time);
				$query->bindParam(':employee_id',$emp_id);
				$query->bindParam(':attendance_date',$attendance_date);
				if($query->execute()){		
		    	$_SESSION['msg'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                  <i class="fas fa-smile-beam me-1"></i>
                                   Attendance completed.
                                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>';
				  header("location:../attendanceList.php");
				}else{
					$_SESSION['msg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
		                            <i class="fas fa-sad-tear me-1"></i>
		                             Something went wrong
		                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		                        </div>';	
				} 
		}   
  }

	
}else{
	header("location:../login.php");
}





?>