<?php
  include 'header.php';

  include 'profileHeader.php';

$is_active = 'active';
$empID = $_SESSION['empIDSESS'];
$query = $conn->prepare("SELECT * From employee where is_active=:is_active and id = :empID order by id desc");
$query->bindParam(':is_active',$is_active);
$query->bindParam(':empID',$empID);
$query->execute();
$employeeResult = $query->fetchAll();
$employeeRow = count($employeeResult);
if (isset($employeeRow)) {
  if ($employeeRow>0) {
    foreach ($employeeResult as $value) {
      $id = $value['id'];
      $img = $value['img'];
      $emp_id = $value['emp_id'];
      $title = $value['title'];
      $full_name = $value['full_name'];
      $complete_name = $title." ".$full_name;
      $designation_id = $value['designation'];
      $email = $value['email'];
      $username = $value['username'];

      $mobile_no = $value['mobile_no'];
      $emergency_mobile_no = $value['emergency_mobile_no'];
      $employee_type_id = $value['employee_type'];
      $blood_group = $value['blood_group'];
      $address = $value['address'];
      $doj = $value['doj'];
      $dob = $value['dob'];
      $marital_status = $value['marital_status'];
      $gender = $value['gender'];
      $religion_id = $value['religion'];
      $is_active = $value['is_active'];
      $work_type_id = $value['work_type'];

      $query = $conn->prepare("SELECT designation_name From designation where id = :designation_id");
      $query->bindParam(':designation_id',$designation_id);
      $query->execute();
      $designationResult = $query->fetchAll();
      $designationRow = count($designationResult);
      if((!empty($designationRow))>0) {
          $designationName = $designationResult[0]['designation_name'];
      }

      $query = $conn->prepare("SELECT employee_type_name From employee_type where id = :employee_type_id");
      $query->bindParam(':employee_type_id',$employee_type_id);
      $query->execute();
      $employeeTypeResult = $query->fetchAll();
      $employeeTypeRow = count($employeeTypeResult);
      if((!empty($employeeTypeRow))>0) {
          $employeeTypeName = $employeeTypeResult[0]['employee_type_name'];
      }

      $query = $conn->prepare("SELECT work_type_name From work_type where id = :work_type_id");
      $query->bindParam(':work_type_id',$work_type_id);
      $query->execute();
      $workTypeResult = $query->fetchAll();
      $workTypeRow = count($workTypeResult);
      if((!empty($workTypeRow))>0) {
          $workTypeName = $workTypeResult[0]['work_type_name'];
      }

      $query = $conn->prepare("SELECT religion_name From religion where id = :religion_id");
      $query->bindParam(':religion_id',$religion_id);
      $query->execute();
      $religionResult = $query->fetchAll();
      $religionRow = count($religionResult);
      if((!empty($religionRow))>0) {
          $religionName = $religionResult[0]['religion_name'];
      }

    }
  }
}


// $query = $conn->prepare("SELECT * From leave_type");
// $query->execute();
// $leaveTypeListResult = $query->fetchAll();
// $leaveTypeListRow = count($leaveTypeListResult);

?>





<section class="commonBox sectionPadding pt-md-4">
  <div class="container">
    <div class="alertWrap">
      <?php
      if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
      }
      ?>
    </div>
    <div class="row">
      <div class="col-md-6 col-6">
        <a href="#"  data-bs-toggle="modal" data-bs-target="#modelEditEmpProfile" class="btn btn-success waves-effect waves-light btn-sm"><i class="fas fa-user-edit"></i> Edit <i class="mdi mdi-arrow-right ms-1"></i></a>
        <!-- <a href="leaveBalance.php"  class="btn btn-info waves-effect waves-light btn-sm text-white">Balance <i class="mdi mdi-arrow-right ms-1"></i></a> -->
      </div>
      <div class="col-md-6 col-6 text-end">
        <a href="changePasswordCalender.php" class="btn btn-primary waves-effect waves-light btn-sm"><i class="fas fa-key"></i> Change Password <i class="mdi mdi-arrow-right ms-1"></i></a>
      </div>

      <?php 
        include 'include/profile/editEmployeeProfile.php';
      ?>

    </div>

    

    <div class="row mt-4">
      <div class="col-md-12 col-12 mb-4">
        <div class="box">
          <div class="row">
            <div class="col-md-3 col-sm-6 col-12">
              <div>
                <p class="mb-0"><strong>Employee ID</strong></p>
                <p><small><?php if(isset($emp_id)){echo $emp_id; } ?></small></p>
              </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
              <div>
                <p class="mb-0"><strong>Full Name</strong></p>
                <p><small><?php if(isset($complete_name)){echo $complete_name; } ?></small></p>
              </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
              <div>
                <p class="mb-0"><strong>Mobile No</strong></p>
                <p><small><?php if(isset($mobile_no)){echo $mobile_no; } ?></small></p>
              </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
              <div>
                <p class="mb-0"><strong>Emergency Mobile No</strong></p>
                <p><small><?php if(isset($emergency_mobile_no)){echo $emergency_mobile_no; } ?></small></p>
              </div>
            </div>
           <!--  <div class="col-md-3 col-sm-6 col-12">
              <div>
                <p class="mb-0"><strong>Designat</strong></p>
                <p><small><?php if(isset($employeeTypeName)){echo $employeeTypeName; } ?></small></p>
              </div>
            </div> -->
            <div class="col-md-3 col-sm-6 col-12">
              <div>
                <p class="mb-0"><strong>Email</strong></p>
                <p><small><?php if(isset($email)){echo $email; } ?></small></p>
              </div>
            </div>
            <!-- <div class="col-md-3 col-sm-6 col-12">
              <div>
                <p class="mb-0"><strong>Employee Type</strong></p>
                <p><small><?php if(isset($employeeTypeName)){echo $employeeTypeName; } ?></small></p>
              </div>
            </div> -->
            <div class="col-md-3 col-sm-6 col-12">
              <div>
                <p class="mb-0"><strong>Blood Group</strong></p>
                <p><small><?php if(isset($blood_group)){echo $blood_group; } ?></small></p>
              </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
              <div>
                <p class="mb-0"><strong>Address</strong></p>
                <p><small><?php if(isset($address)){echo $address; } ?></small></p>
              </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
              <div>
                <p class="mb-0"><strong>Designation</strong></p>
                <p><small><?php if(isset($designationName)){echo $designationName; } ?></small></p>
              </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
              <div>
                <p class="mb-0"><strong>DOJ</strong></p>
                <p><small><?php if(isset($doj)){echo $doj; } ?></small></p>
              </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
              <div>
                <p class="mb-0"><strong>DOB</strong></p>
                <p><small><?php if(isset($dob)){echo $dob; } ?></small></p>
              </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
              <div>
                <p class="mb-0"><strong>Marital Status</strong></p>
                <p class="text-capitalize"><small><?php if(isset($marital_status)){echo $marital_status; } ?></small></p>
              </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
              <div>
                <p class="mb-0"><strong>Gender</strong></p>
                <p><small><?php if(isset($gender)){echo $gender; } ?></small></p>
              </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
              <div>
                <p class="mb-0"><strong>Religion</strong></p>
                <p><small><?php if(isset($religionName)){echo $religionName; } ?></small></p>
              </div>
            </div>
            <!-- <div class="col-md-3 col-sm-6 col-12">
              <div>
                <p class="mb-0"><strong>Is Active</strong></p>
                <?php
                  if (isset($is_active)) { 
                      if($is_active=='active'){ 
                          ?>
                           <p class="badge rounded-pill text-bg-success mt-2 font14 font-weight-normal"><i><?php if (isset($is_active)) { echo $is_active; } ?></i></p>
                          <?php
                      }else{
                          ?>
                           <p class="badge rounded-pill text-bg-danger mt-2 font14 font-weight-normal"><i><?php if (isset($is_active)) { echo $is_active; } ?></i></p>
                          <?php
                      }
                  }

                  ?>
              </div>
            </div> -->
            <div class="col-md-3 col-sm-6 col-12">
              <div>
                <p class="mb-0"><strong>Work Type</strong></p>
                <p><small><?php if(isset($workTypeName)){echo $workTypeName; } ?></small></p>
              </div>
            </div>
            

          </div>
        </div>
      </div>







    </div>
  </div>
</section>



<?php
  include 'footer.php';
?>

<script>
  $(document).ready(function(){
      $("#employeeEditForm").validate({
        rules :{
          title: {
            required: true,
          },
          full_name: {
            required: true, 
          },
          mobile_no: {
            required: true,
          },
          emergency_mobile_no: {
            required: true, 
          },
          email: {
            required: true, 
          },
          employee_type: {
            required: true, 
          },
          blood_group: {
            required: true, 
          },
          address: {
            required: true, 
          },
          designation: {
            required: true, 
          },
          doj: {
            required: true, 
          },
          dob: {
            required: true, 
          },
          marital_status: {
            required: true, 
          },
          gender: {
            required: true, 
          },
          religion: {
            required: true, 
          },
          work_type: {
            required: true, 
          },
        }
        
      });
  });
</script>
