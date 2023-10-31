<?php 
session_start();

if ((isset($_POST['dataValueEmpID'])) && (!empty($_POST['dataValueEmpID']))) {

	require '../include/connection.php';

	$emp_id = $_POST['dataValueEmpID'];
	$is_active = 'deactive';
	$updated_at = date('Y-m-d h:i:s');
	$query = $conn->prepare("UPDATE employee SET 
						is_active = :is_active,
						updated_at = :updated_at where id = :emp_id");
	$query->bindParam(':is_active',$is_active);
	$query->bindParam(':updated_at',$updated_at);
	$query->bindParam(':emp_id',$emp_id);

	if($query->execute()){
		$message = array("status"=>"true","messages"=>"You are great");
		echo json_encode($message);
	}else{
		$message = array("status"=>"false","messages"=>"You are great");
		echo json_encode($message);			    			
	}
}else{
	header("location:../login.php");
}





?>