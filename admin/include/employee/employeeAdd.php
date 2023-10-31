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


<div class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
<div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="myExtraLargeModalLabel">Employee Add</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
           <div>
            <form class="custom-validation" action="backend/employeeAdd.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Profile Picture</label>
                            <input type="file" class="form-control" name="profile_img" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="" class="form-label">Employee ID</label>
                            <input type="text" class="form-control" name="emp_id"
                                placeholder="Employee ID" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <select class="form-select" name="title" required>
                                <option selected disabled>Choose...</option>
                                <option value="Mr.">Mr</option>
                                <option value="Mrs.">Mrs</option>
                                <option value="Miss.">Miss</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control" name="full_name"
                                placeholder="Full Name" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Mobile No</label>
                            <input type="text" class="form-control" name="mobile_no" required
                            data-parsley-length="[10,10]" data-parsley-type="digits"
                            placeholder="Mobile No" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Emergency Mobile No</label>
                            <input type="text" class="form-control" name="emergency_mobile_no" required
                            data-parsley-length="[10,10]" data-parsley-type="digits"
                            placeholder="Emergency Mobile No" />                                              
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email"
                                placeholder="Email" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="text" class="form-control" name="password"
                                placeholder="Password" required data-parsley-min="6">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Employee Type</label>
                            <select class="form-select" name="employee_type" required>
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
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Blood Group</label>
                            <input type="text" class="form-control" name="blood_group"
                                placeholder="Blood Group" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" class="form-control" name="address"
                                placeholder="Address" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Designation</label>
                            <select class="form-select" name="designation" required>
                                <option selected disabled value="">Choose...</option>
                                <?php
                                if (isset($designationRowSide)) {
                                  if ($designationRowSide>0) {
                                    foreach ($designationResultSide as $value) {
                                      $designation_id = $value['id'];          
                                      $designation_name = $value['designation_name']; 
                                      ?>
                                      <option value="<?php echo $designation_id ?>"><?php echo $designation_name ?></option>
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
                                placeholder="DOJ" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label">DOB</label>
                            <input type="date" class="form-control" name="dob"
                                placeholder="DOB" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Marital Status</label>
                            <select class="form-select" name="marital_status" required>
                                <option selected disabled>Choose...</option>
                                <option value="married">Married</option>
                                <option value="unmarried">Unmarried</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Gender</label>
                            <select class="form-select" name="gender" required>
                                <option selected disabled>Choose...</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Religion</label>
                            <select class="form-select" name="religion" required>
                                <option selected disabled>Choose...</option>
                                <?php
                                if (isset($religionRowSide)) {
                                  if ($religionRowSide>0) {
                                    foreach ($religionResultSide as $value) {
                                      $religion_id = $value['id'];          
                                      $religion_name = $value['religion_name']; 
                                      ?>
                                      <option value="<?php echo $religion_id ?>"><?php echo $religion_name ?></option>
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
                            <label class="form-label">Is Active</label>
                            <select class="form-select" name="is_active" required>
                                <option selected disabled>Choose...</option>
                                <option value="active">Active</option>
                                <option value="deactive">Deactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label">Work Type</label>
                            <select class="form-select" name="work_type" required>
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
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit" name="submitFormBtn">Submit form</button>
                </div>
            </form>
           </div>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div>