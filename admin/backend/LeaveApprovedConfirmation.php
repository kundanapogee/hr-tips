<?php 
session_start();

if (!empty($_POST['dataValueEmpID'])) {
	require '../include/connection.php';

	$dataValueEmpID = $_POST['dataValueEmpID'];
	$is_approved = "approve";
	$updated_at = date('Y-m-d h:i:s');

	$query = $conn->prepare("UPDATE employee_leave SET 
								is_approved = :is_approved,
								updated_at = :updated_at where id = :id ");
	$query->bindParam(':is_approved',$is_approved);
	$query->bindParam(':updated_at',$updated_at);
	$query->bindParam(':id',$dataValueEmpID);
	if($query->execute()){		
		$message = array("status"=>"true","messages"=>"You are great");
		echo json_encode($message);
	}else{
		$message = array("status"=>"false","messages"=>"Something went wrong");
		echo json_encode($message);
	}
	
}else{
	header("location:../login.php");
}





?>