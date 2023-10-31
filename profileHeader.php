<?php
include 'include/connection.php';

$is_active = 'active';
$empID = $_SESSION['empIDSESS'];
$query = $conn->prepare("SELECT id,img,emp_id,title,full_name,designation From employee where is_active=:is_active && id = :empID");
$query->bindParam(':is_active',$is_active);
$query->bindParam(':empID',$empID);
$query->execute();
$employeeResult = $query->fetchAll();
$employeeRow = count($employeeResult);
if (isset($employeeRow)) {
  if ($employeeRow>0) {    
    foreach ($employeeResult as $value) {      
      $main_img = $value['img'];
      $main_emp_id = $value['emp_id'];
      $main_title = $value['title'];
      $main_full_name = $value['full_name'];
      $main_designation_id = $value['designation'];
      $mainEmpFullName = $main_title." ".$main_full_name;
      $query = $conn->prepare("SELECT designation_name From designation where id = :designation_id");
      $query->bindParam(':designation_id',$main_designation_id);
      $query->execute();
      $designationResult = $query->fetchAll();
      $designationRow = count($designationResult);
      if((isset($designationRow))>0) {
          $mainDesignationName = $designationResult[0]['designation_name'];
      }
      // $img = $value['img'];
      // $img = $value['img'];
      // $img = $value['img'];
      // $img = $value['img'];
      // $img = $value['img'];
    }
  }
}

?>

<section class="profileSection desktopMenu d-none d-sm-block ">
  <div class="container mt-md-3 mt-lg-3 mt-sm-3 px-0">
    <div class="innerWrap">
      <figure class="profileImg mx-auto">
          <img src="admin/upload/users/<?php if (isset($main_img)) { echo $main_img; } ?>">
      </figure>
      <div class="text-center">
        <h5 class="position-relative fw-bolder"><?php if (isset($mainEmpFullName)) { echo $mainEmpFullName; } ?></h5>
        <p class="text-muted mb-0"><?php if (isset($mainDesignationName)) { echo $mainDesignationName; } ?></p>
      </div>
    </div>
  </div>
  <a href="backend/logout.php" class="btn btn-danger logoutDesktop">Logout</a>
</section>




<section class="mobileMenu d-block d-sm-none">
  <div class="container mt-md-3 mt-lg-3 mt-sm-3 px-0">
    <div class="row">
      <div class="col-md-12">
        <nav class="navbar navbar-expand-sm">
          <div class="container-fluid">
            <a class="navbar-brand" href="#">
              <img src="assets/images/logo.png">
            </a>
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="employeeProfile.php">
                  <img class="profileImg" src="admin/upload/users/<?php if(isset($main_img)){ echo $main_img; } ?>">
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="assets/images/ambarqr.png">
                  <img class="imgQR" src="assets/images/ambarqr.png">
                </a>
              </li>
              <li class="nav-item" style="padding-right: 0!important;">
                <a class="nav-link" href="backend/logout.php">                
                  <img class="imgLogout" src="assets/images/logout.png">
                </a>
              </li>
            </ul>
          </div>
        </nav>
      </div>
    </div>
  </div>
</section>