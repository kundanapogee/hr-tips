<?php 
session_start();

if (isset($_POST['lunch_updated_btn'])) {
	require '../include/connection.php';

		if(isset($_POST['lunch_taken_id'])){

			$dateSelect = $_POST['dateSelect'];

			$query = $conn->prepare("DELETE FROM lunch_taken WHERE lunch_date = :lunch_date");
			$query->bindParam(':lunch_date',$dateSelect);
			$query->execute();


			foreach($_POST['lunch_taken_id'] as $employee_id){
				// $lunch_date = date('Y-m-d');
				$created_at = date('Y-m-d h:i:s');

				$query = $conn->prepare("INSERT INTO lunch_taken(employee_id,lunch_date,created_at) values(:employee_id,:lunch_date,:created_at)");
				$query->bindParam(':employee_id',$employee_id);
				$query->bindParam(':lunch_date',$dateSelect);
				$query->bindParam(':created_at',$created_at);
				$query->execute();          
			}
			$_SESSION['amsg'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
			<i class="mdi mdi-check-all me-2"></i>
			Added Successfully
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>';
            header("location:../lunchTakenList.php");
			?>
			<!-- <meta http-equiv = "refresh" content = "0; url = contactFormQueryList.php" /> -->
			<?php
		}else{
			$_SESSION['amsg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<i class="mdi mdi-block-helper me-2"></i>
			Something went wrong
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>';
			header("location:../lunchTakenList.php");
		}







	
}else{
	header("location:../login.php");
}





?>