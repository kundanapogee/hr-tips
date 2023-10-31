<?php 
session_start();

if (isset($_POST['submitFormBtn'])) {
	require '../include/connection.php';

	$emp_id = $_POST['emp_id'];
	$amount = $_POST['amount'];
	$subject = $_POST['subject'];
	$description = $_POST['description'];
	$is_paid = 'unpaid';
	$created_at = date('Y-m-d h:i:s');
	$updated_at = date('Y-m-d h:i:s');

	// $attachedFile = $_POST['attachedFile'];

	$query = $conn->prepare("INSERT INTO reimbursement(emp_id,amount,subject,description,is_paid,created_at,updated_at) values(:emp_id,:amount,:subject,:description,:is_paid,:created_at,:updated_at)");
	$query->bindParam(':emp_id',$emp_id);
	$query->bindParam(':amount',$amount);
	$query->bindParam(':subject',$subject);
	$query->bindParam(':description',$description);
	$query->bindParam(':is_paid',$is_paid);
	$query->bindParam(':created_at',$created_at);
	$query->bindParam(':updated_at',$updated_at);
	if($query->execute()){
		
		$reimbursementLastId = $conn->lastInsertId();

		if (!empty($_FILES['attachedFile'])) {
			$fileCount = count($_FILES['attachedFile']['name']);
			if (isset($fileCount)) {
				if ($fileCount>0) {					
					for ($i=0; $i < $fileCount; $i++) { 
						$imgName = $_FILES['attachedFile']['name'][$i];
						$imgFullName = date('ymdhis').''.$imgName;
						$img_tmp_name = $_FILES['attachedFile']['tmp_name'][$i];
						$path = "../upload/reimbursement/".$imgFullName;
						if(move_uploaded_file($img_tmp_name, $path)){
							
							$query = $conn->prepare("INSERT INTO reimbursement_files(reimbursement_id,img_file,created_at) values(:reimbursement_id,:img_file,:created_at)");				
							$query->bindParam(':reimbursement_id',$reimbursementLastId);
							$query->bindParam(':img_file',$imgFullName);
							$query->bindParam(':created_at',$created_at);
							if($query->execute()){
								$_SESSION['amsg'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
								<i class="mdi mdi-check-all me-2"></i> Added Successfully <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> </div>';
								header("location:../reimbursementList.php");
							}
							
						}
					}

				}
			}
		}
		$_SESSION['amsg'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
		<i class="mdi mdi-check-all me-2"></i> Added Successfully <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
		header("location:../reimbursementList.php");
	}else{
		$_SESSION['amsg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
		<i class="mdi mdi-block-helper me-2"></i> Something went wrong <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> </div>';
		header("location:../reimbursementList.php");			    			
	}
}else{
	header("location:../login.php");
}





?>