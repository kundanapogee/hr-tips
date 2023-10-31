<?php 
session_start();

if (isset($_POST['submitFormBtn'])) {
require '../include/connection.php';

	// echo $_FILES['profile_img']['name'];

	// echo "string";

	// print_r($_FILES['profile_img']);

	// die();
	if (!empty($_FILES['profile_img'])) {
	    $imgName = $_FILES['profile_img']['name'];
		$imgFullName = date('ymdhis').''.$imgName;
		// $apkSoftwareFullName = $apkSoftwareName;
		$img_tmp_name = $_FILES['profile_img']['tmp_name'];
		$path = "../upload/users/".$imgFullName;
		if(move_uploaded_file($img_tmp_name, $path)){


			
			$emp_id = $_POST['emp_id'];
			$title = $_POST['title'];
			$full_name = $_POST['full_name'];
			$mobile_no = $_POST['mobile_no'];
			$emergency_mobile_no = $_POST['emergency_mobile_no'];
			$email = strtolower($_POST['email']);

		    $username = substr($email, 0, strpos($email, "@"));


			

		   

		   
			$password = base64_encode($_POST['password']);
			$employee_type = $_POST['employee_type'];
			$blood_group = $_POST['blood_group'];
			$address = $_POST['address'];
			$designation = $_POST['designation'];
			$doj = $_POST['doj'];
			$dob = $_POST['dob'];
			$marital_status = $_POST['marital_status'];
			$gender = $_POST['gender'];
			$religion = $_POST['religion'];
			$is_active = $_POST['is_active'];
			$work_type = $_POST['work_type'];

			$created_at = date('Y-m-d h:i:s');
			$updated_at = date('Y-m-d h:i:s');



			$query = $conn->prepare("SELECT * From employee where email=:email order by id desc");
			$query->bindParam(':email',$email);
			$query->execute();
			$employeeResult = $query->fetchAll();
			$employeeRow = count($employeeResult);
			if (isset($employeeRow)) {
				if($employeeRow>0){
					$_SESSION['amsg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <i class="mdi mdi-block-helper me-2"></i>
                                                 This email is already registered.
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>';
		    		header("location:../employeeAdd_temp.php");
		    		die();
				}
			}


			$query = $conn->prepare("INSERT INTO employee(img,emp_id,title,full_name,mobile_no,emergency_mobile_no,email,username,password,employee_type,blood_group,address,designation,doj,dob,marital_status,gender,religion,is_active,work_type,created_at,updated_at) values(:img,:emp_id,:title,:full_name,:mobile_no,:emergency_mobile_no,:email,:username,:password,:employee_type,:blood_group,:address,:designation,:doj,:dob,:marital_status,:gender,:religion,:is_active,:work_type,:created_at,:updated_at)");
			$query->bindParam(':img',$imgFullName);
			$query->bindParam(':emp_id',$emp_id);
			$query->bindParam(':title',$title);
			$query->bindParam(':full_name',$full_name);
			$query->bindParam(':mobile_no',$mobile_no);
			$query->bindParam(':emergency_mobile_no',$emergency_mobile_no);
			$query->bindParam(':email',$email);
			$query->bindParam(':username',$username);
			$query->bindParam(':password',$password);
			$query->bindParam(':employee_type',$employee_type);
			$query->bindParam(':blood_group',$blood_group);
			$query->bindParam(':address',$address);
			$query->bindParam(':designation',$designation);
			$query->bindParam(':doj',$doj);
			$query->bindParam(':dob',$dob);
			$query->bindParam(':marital_status',$marital_status);
			$query->bindParam(':gender',$gender);
			$query->bindParam(':religion',$religion);
			$query->bindParam(':is_active',$is_active);
			$query->bindParam(':work_type',$work_type);
			$query->bindParam(':created_at',$created_at);
			$query->bindParam(':updated_at',$updated_at);
			if($query->execute()){
				$_SESSION['amsg'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <i class="mdi mdi-check-all me-2"></i>
                                                	Added Successfully
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>';
		    header("location:../employeeAdd_temp.php");
		  }else{
		    $_SESSION['amsg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <i class="mdi mdi-block-helper me-2"></i>
                                                 Something went wrong
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>';
		    header("location:../employeeAdd_temp.php");			    			
		  }
		}else{
			$_SESSION['amsg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <i class="mdi mdi-block-helper me-2"></i>
                                                 Something went wrong
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>';
		    header("location:../employeeAdd_temp.php");	
		}
	}else{
		header("location:../login.php");
	}
}else{
	header("location:../login.php");
}





?>