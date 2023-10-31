<?php 
session_start();

if (isset($_POST['submitFormBtn'])) {
require '../include/connection.php';

	// echo $_FILES['profile_img']['name'];

	// echo "string";

	// print_r($_FILES['profile_img']);

	// die();

$empID = $_SESSION['empIDSESS'];
$title = $_POST['title'];
$full_name = $_POST['full_name'];
$mobile_no = $_POST['mobile_no'];
$emergency_mobile_no = $_POST['emergency_mobile_no'];
$blood_group = $_POST['blood_group'];
$address = $_POST['address'];
$designation = $_POST['designation'];
$doj = $_POST['doj'];
$dob = $_POST['dob'];
$marital_status = $_POST['marital_status'];
$gender = $_POST['gender'];
$religion = $_POST['religion'];
$updated_at = date('Y-m-d h:i:s');

$query = $conn->prepare("SELECT * From employee where id = :empID");
$query->bindParam(':empID',$empID);
$query->execute();
$result = $query->fetchAll();
$file_name = $result[0]['img'];
$url = "../admin/upload/users/".$file_name;



if(file_exists($url)) {
	unlink($url);
}

// if(!empty($file_name)) {
// 	unlink($url);
// 	echo "Not Empty";
// 	$emptyImg = "";
// 	$query = $conn->prepare("UPDATE employee SET 
// 									img = :img WHERE id = :empID");
// 	$query->bindParam(':img',$emptyImg);
// 	$query->bindParam(':empID',$empID);
// 	$query->execute();
// }else{
// 	echo "empty";
// }


// die();


	if (!empty($_FILES['profile_img'])) {
	    $imgName = $_FILES['profile_img']['name'];
		$imgFullName = date('ymdhis').''.$imgName;
		$img_tmp_name = $_FILES['profile_img']['tmp_name'];
		$path = "../admin/upload/users/".$imgFullName;
		if(move_uploaded_file($img_tmp_name, $path)){		
			
			$query = $conn->prepare("UPDATE employee SET 
									img = :img,
									title = :title,
									full_name = :full_name,
									mobile_no = :mobile_no,
									emergency_mobile_no = :emergency_mobile_no,
									blood_group = :blood_group,
									address = :address,
									designation = :designation,
									doj = :doj,
									dob = :dob,
									marital_status = :marital_status,
									gender = :gender,
									religion = :religion,
									updated_at = :updated_at WHERE id = :empID");
			$query->bindParam(':img',$imgFullName);
			$query->bindParam(':title',$title);
			$query->bindParam(':full_name',$full_name);
			$query->bindParam(':mobile_no',$mobile_no);
			$query->bindParam(':emergency_mobile_no',$emergency_mobile_no);
			$query->bindParam(':blood_group',$blood_group);
			$query->bindParam(':address',$address);
			$query->bindParam(':designation',$designation);
			$query->bindParam(':doj',$doj);
			$query->bindParam(':dob',$dob);
			$query->bindParam(':marital_status',$marital_status);
			$query->bindParam(':gender',$gender);
			$query->bindParam(':religion',$religion);
			$query->bindParam(':updated_at',$updated_at);
			$query->bindParam(':empID',$empID);
			if($query->execute()){
	            $_SESSION['msg'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <i class="fas fa-smile-beam me-1"></i>
                                                	Updated Successfully
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>';
		    	header("location:../employeeProfile.php");
		  	}else{		    	
                $_SESSION['msg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
	                                                <i class="fas fa-sad-tear me-1"></i>
	                                                 Something went wrong.
	                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	                                            </div>';
		    	header("location:../employeeProfile.php");			    			
		  	}
		}else{

			$query = $conn->prepare("UPDATE employee SET 
									title = :title,
									full_name = :full_name,
									mobile_no = :mobile_no,
									emergency_mobile_no = :emergency_mobile_no,
									blood_group = :blood_group,
									address = :address,
									designation = :designation,
									doj = :doj,
									dob = :dob,
									marital_status = :marital_status,
									gender = :gender,
									religion = :religion,
									updated_at = :updated_at WHERE id = :empID");
			$query->bindParam(':title',$title);
			$query->bindParam(':full_name',$full_name);
			$query->bindParam(':mobile_no',$mobile_no);
			$query->bindParam(':emergency_mobile_no',$emergency_mobile_no);
			$query->bindParam(':blood_group',$blood_group);
			$query->bindParam(':address',$address);
			$query->bindParam(':designation',$designation);
			$query->bindParam(':doj',$doj);
			$query->bindParam(':dob',$dob);
			$query->bindParam(':marital_status',$marital_status);
			$query->bindParam(':gender',$gender);
			$query->bindParam(':religion',$religion);
			$query->bindParam(':updated_at',$updated_at);
			$query->bindParam(':empID',$empID);
			if($query->execute()){				
	            $_SESSION['msg'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <i class="fas fa-smile-beam me-1"></i>
                                                	Updated Successfully
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>';
			    header("location:../employeeProfile.php");	
			}
		}
	}else{
		header("location:../login.php");
	}
}else{
	header("location:../login.php");
}





?>