<?php



$query = $conn->prepare("SELECT * From religion ");
$query->execute();
$religionResultSide = $query->fetchAll();
$religionRowSide = count($religionResultSide);

$query = $conn->prepare("SELECT * From designation ");
$query->execute();
$designationResultSide = $query->fetchAll();
$designationRowSide = count($designationResultSide);


$query = $conn->prepare("SELECT * From employee_type");
$query->execute();
$employeeTypeResultSide = $query->fetchAll();
$employeeTypeRowSide = count($employeeTypeResultSide);

$query = $conn->prepare("SELECT * From work_type ");
$query->execute();
$workTypeResultSide = $query->fetchAll();
$workTypeRowSide = count($workTypeResultSide);
?>


<div class="modal" id="modelEditEmpProfile">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Profile</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form id="employeeEditForm" action="backend/employeeProfileEdit.php" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div>             
            <div class="row">
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label">Profile Picture</label>
                        <input type="file" class="form-control" name="profile_img" >
                    </div>
                </div>
                <!-- <div class="col-md-3">
                    <div class="mb-3">
                        <label for="" class="form-label">Employee ID</label>
                        <input type="text" class="form-control" name="emp_id"
                            placeholder="Employee ID" >
                    </div>
                </div> -->
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <select class="form-control" name="title" >
                            <option selected disabled>Choose...</option>
                            <option value="Mr." <?php if($title == 'Mr.'){ echo "selected"; } ?> >Mr</option>
                            <option value="Mrs." <?php if($title == 'Mrs.'){ echo "selected"; } ?>>Mrs</option>
                            <option value="Miss." <?php if($title == 'Miss.'){ echo "selected"; } ?>>Miss</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" class="form-control" name="full_name" placeholder="Full Name" value="<?php if(isset($full_name)){echo $full_name; } ?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label">Mobile No</label>
                        <input type="text" class="form-control" name="mobile_no" placeholder="Mobile No" value="<?php if(isset($mobile_no)){echo $mobile_no; } ?>"/>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label">Emergency Mobile No</label>
                        <input type="text" class="form-control" name="emergency_mobile_no" placeholder="Emergency Mobile No" value="<?php if(isset($emergency_mobile_no)){echo $emergency_mobile_no; } ?>" />                                              
                    </div>
                </div>
                <!-- <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email"
                            placeholder="Email" >
                    </div>
                </div> -->
                <!-- <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="text" class="form-control" name="password"
                            placeholder="Password"  data-parsley-min="6">
                    </div>
                </div> -->
                <!-- <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label">Employee Type</label>
                        <select class="form-control" name="employee_type" >
                            <option selected disabled value="">Choose...</option>
                            <?php
                            if (isset($employeeTypeRowSide)) {
                              if ($employeeTypeRowSide>0) {
                                foreach ($employeeTypeResultSide as $value) {
                                  $employee_type_id = $value['id'];          
                                  $employee_type_name = $value['employee_type_name']; 
                                  if (($employee_type_id == '3')||($employee_type_id == '4')){
                                  ?>
                                    <option value="<?php echo $employee_type_id ?>"><?php echo $employee_type_name ?></option>
                                      <?php
                                  }
                                }
                              }
                            }
                            ?> 
                        </select>  
                    </div>
                </div> -->
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label">Blood Group</label>
                        <input type="text" class="form-control" name="blood_group"
                            placeholder="Blood Group" value="<?php if(isset($blood_group)){echo $blood_group; } ?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control" name="address"
                            placeholder="Address" value="<?php if(isset($address)){echo $address; } ?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label">Designation</label>
                        <select class="form-control" name="designation" >
                            <option selected disabled value="">Choose...</option>
                            <?php
                              if (isset($designationRowSide)) {
                                if ($designationRowSide>0) {
                                  foreach ($designationResultSide as $value) {
                                    $deg_id = $value['id'];          
                                    $designation_name = $value['designation_name']; 
                                    ?>
                                    <option value="<?php echo $designation_id ?>" <?php if($deg_id == $designation_id){ echo "selected"; } ?> ><?php echo $designation_name ?></option>
                                    <?php
                                  }
                                }
                              }
                            ?>   
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label">DOJ</label>
                        <input type="date" class="form-control" name="doj"
                            placeholder="DOJ" value="<?php if(isset($doj)){echo $doj; } ?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label">DOB</label>
                        <input type="date" class="form-control" name="dob"
                            placeholder="DOB" value="<?php if(isset($dob)){echo $dob; } ?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label">Marital Status</label>
                        <select class="form-control" name="marital_status" >
                            <option selected disabled>Choose...</option>
                            <option value="married" <?php if($marital_status == 'married'){ echo "selected"; } ?> >Married</option>
                            <option value="unmarried" <?php if($marital_status == 'unmarried'){ echo "selected"; } ?> >Unmarried</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label">Gender</label>
                        <select class="form-control" name="gender" >
                            <option selected disabled>Choose...</option>
                            <option value="male" <?php if($gender == 'male'){ echo "selected"; } ?> >Male</option>
                            <option value="female" <?php if($gender == 'female'){ echo "selected"; } ?> >Female</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label">Religion</label>
                        <select class="form-control" name="religion" >
                            <option selected disabled>Choose...</option>
                            <?php
                            if (isset($religionRowSide)) {
                              if ($religionRowSide>0) {
                                foreach ($religionResultSide as $value) {
                                  $rel_id = $value['id'];          
                                  $religion_name = $value['religion_name']; 
                                  ?>
                                  <option value="<?php echo $rel_id ?>" <?php if($rel_id == $religion_id){ echo "selected"; } ?> ><?php echo $religion_name ?></option>
                                  <?php
                                }
                              }
                            }
                            ?>                                                    
                        </select>
                    </div>
                </div>                    
                <!-- <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label">Is Active</label>
                        <select class="form-control" name="is_active">
                            <option selected disabled>Choose...</option>
                            <option value="active">Active</option>
                            <option value="deactive">Deactive</option>
                        </select>
                    </div>
                </div> -->

                <!-- <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label">Work Type</label>
                        <select class="form-control" name="work_type">
                            <option selected disabled>Choose...</option>
                            <?php
                            if (isset($workTypeRowSide)) {
                              if ($workTypeRowSide>0) {
                                foreach ($workTypeResultSide as $value) {
                                  $work_type_id = $value['id'];          
                                  $work_type_name = $value['work_type_name']; 
                                  ?>
                                  <option value="<?php echo $work_type_id ?>"><?php echo $work_type_name ?></option>
                                  <?php
                                }
                              }
                            }
                            ?>    
                        </select>
                    </div>
                </div> -->
            </div>              
          </div>
        </div>
        <div class="modal-footer w-100 justify-content-between">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button class="btn btn-success" type="submit" name="submitFormBtn">Submit form</button>
          <!-- <div class="row">
            <div class="col-md-6 col-6">
              <button type="button" class="btn btn-secondary waves-effect text-start" data-bs-dismiss="modal">Close</button>
            </div>
             <div class="col-md-6 col-6">
              <button class="btn btn-primary" type="submit" name="submitFormBtn">Submit form</button>
            </div>
          </div> -->
        </div>
      </form>
    </div>
  </div>
</div>










