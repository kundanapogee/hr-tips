<?php 
session_start();

if (!empty($_POST['dataValueEmpID'])) {
	require '../include/connection.php';

	$dataValueEmpID = $_POST['dataValueEmpID'];
	$is_paid = "paid";
	$updated_at = date('Y-m-d h:i:s');

	$query = $conn->prepare("UPDATE reimbursement SET 
								is_paid = :is_paid,
								updated_at = :updated_at where id = :id ");
	$query->bindParam(':is_paid',$is_paid);
	$query->bindParam(':updated_at',$updated_at);
	$query->bindParam(':id',$dataValueEmpID);
	if($query->execute()){		
		$message = array("status"=>"true","messages"=>"You are great");
		echo json_encode($message);
	}else{
		$message = array("status"=>"false","messages"=>"You are not great");
		echo json_encode($message);
	}
	
}else{
	header("location:../login.php");
}





?>