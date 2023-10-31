<?php 
session_start();

if (!empty($_POST['lunchDate'])) {
	require '../connection.php';

	$lunchDate = $_POST['lunchDate'];

	$is_active = 'active';
	$query = $conn->prepare("SELECT id,full_name,title,emp_id From employee where is_active = :is_active");
	$query->bindParam(':is_active',$is_active);
	$query->execute();
	$employeeResult = $query->fetchAll();
	$employeeRow = count($employeeResult);
	$new = [];
	if (isset($employeeRow)) {
		if ($employeeRow>0) {
			foreach ($employeeResult as $value) {
				$employeeID = $value['id'];
				$empLunchEmpID = $value['emp_id'];
                $employeeTitle = $value['title'];
                $employeeName = $value['full_name'];
                $employeeFullName = $employeeTitle." ".$employeeName;

                $query = $conn->prepare("SELECT * from employee where id = :empLunchEmpID");
                $query->bindParam(':empLunchEmpID',$empLunchEmpID);
                $query->execute();
                $empMainResult = $query->fetchAll();
                $empMainRow = count($empMainResult);
                if (isset($empMainRow )) {
                    if ($empMainRow>0) {
                      $empMainFullName =  $empMainResult[0]['full_name'];
                    }
                }

				$query = $conn->prepare("SELECT * from lunch_taken where employee_id = :employeeID and lunch_date = :lunch_date");
			    $query->bindParam(':employeeID',$employeeID);
			    $query->bindParam(':lunch_date',$lunchDate);
			    $query->execute();
			    $lunchTakenEmpResult = $query->fetchAll();
			    // $new[] = $lunchTakenEmpResult;
			    $lunchTakenEmpRow = count($lunchTakenEmpResult);
			    if ($lunchTakenEmpRow>0) {
			       foreach ($lunchTakenEmpResult as $value) {
			            $lunchEmployeeID = $value['employee_id'];
			        }
			    }


			echo'<tr>
			    <td>
			        <div class="form-check font-size-16">
			            <input class="form-check-input" name="lunch_taken_id[]" type="checkbox" id="orderidcheck01" value="'.$employeeID.'" ';if(isset($lunchEmployeeID)){ if($lunchEmployeeID==$employeeID){ echo "checked"; } } echo '>
			            <label class="form-check-label" for="orderidcheck01"></label>
			        </div>
			    </td>
			    <td><a href="javascript: void(0);" class="text-body fw-bold">'.$employeeFullName.'</a>
			    <div>
			        <small>';if(!empty($empMainFullName)){ echo "(".$empMainFullName.")"; } echo '</small>
			    </div>
			     </td>
			    <td>'.$lunchDate.'</td>
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