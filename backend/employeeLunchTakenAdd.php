<?php 
session_start();

if (isset($_POST['submitFormBtn'])) {
	require '../include/connection.php';

			$empID = $_SESSION['empIDSESS'];
			$dateSelect = $_POST['dateSelect'];

			$query = $conn->prepare("SELECT * FROM lunch_taken WHERE lunch_date = :lunch_date && employee_id = :empID");
			$query->bindParam(':lunch_date',$dateSelect);
			$query->bindParam(':empID',$empID);
			$query->execute();
			$result = $query->fetchAll();
			$row = count($result);			
			if ($row>0) {
				$_SESSION['msg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
		                                                <i class="fas fa-sad-tear me-1"></i>
		                                                 Already added.
		                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		                                            </div>';
					header("location:../lunchTakenList.php");
			}else{			
				$created_at = date('Y-m-d h:i:s');

				$query = $conn->prepare("INSERT INTO lunch_taken(employee_id,lunch_date,created_at) values(:employee_id,:lunch_date,:created_at)");
				$query->bindParam(':employee_id',$empID);
				$query->bindParam(':lunch_date',$dateSelect);
				$query->bindParam(':created_at',$created_at);
				if($query->execute()){ 
					// die();
					$_SESSION['msg'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
		                                                <i class="fas fa-smile-beam me-1"></i>
		                                                Added Successfully.
		                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		                                            </div>';

		            header("location:../lunchTakenList.php");
				}else{
					$_SESSION['msg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
		                                                <i class="fas fa-sad-tear me-1"></i>
		                                                 Something went wrong.
		                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		                                            </div>';
					header("location:../lunchTakenList.php");
				}

			}

	
}else{
	header("location:../login.php");
}





?>