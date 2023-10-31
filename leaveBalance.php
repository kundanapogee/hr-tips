<?php
  include 'header.php';

  include 'profileHeader.php';


$query = $conn->prepare("SELECT * From leave_type");
$query->execute();
$leaveTypeListResult = $query->fetchAll();
$leaveTypeListRow = count($leaveTypeListResult);

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
        <a href="#"  data-bs-toggle="modal" data-bs-target="#modelApplyLeave" class="btn btn-success waves-effect waves-light btn-sm">Apply Leave <i class="mdi mdi-arrow-right ms-1"></i></a>
      </div>
      <div class="col-md-6 col-6 text-end">
        <a href="leaveAppliedCalender.php" class="btn btn-primary waves-effect waves-light btn-sm">View Calender <i class="mdi mdi-arrow-right ms-1"></i></a>
      </div>

      <?php 
        include 'include/leave/leaveApplyByEmployee.php';
      ?>

    </div>

    

    <div class="row mt-4">



      
      <?php

        $query = $conn->prepare("SELECT * From leave_type");
        $query->execute();
        $leaveTypeListResult = $query->fetchAll();
        $leaveTypeListRow = count($leaveTypeListResult);
        
        if (isset($leaveTypeListRow)) {
          if ($leaveTypeListResult[0]['short_name']='SL'){
            $short_name = $leaveTypeListResult[0]['short_name'];
            $query = $conn->prepare("SELECT * From leave_type where short_name = :short_name");
            $query->bindParam(':short_name',$short_name);
            $query->execute();
            $leaveTypeResult = $query->fetchAll();
            $leaveTypeRow = count($leaveTypeResult);
            if((isset($leaveTypeRow))>0) {
              foreach ($leaveTypeResult as $value) {
                 $leaveTypeID = $value['id'];
                 $leaveTypeName = $value['leave_type_name'];
                 $shortName = $value['short_name'];
                 $paidLeave = $value['total_leave'];
              }
            }

            $is_approved = "approve";
            $leave_year = date('Y');
            $query = $conn->prepare("SELECT * From employee_leave where leave_type_id = :leave_type_id and emp_id = :emp_id and is_approved = :is_approved and leave_year = :leave_year");
            $query->bindParam(':leave_type_id',$leaveTypeID);
            $query->bindParam(':emp_id',$empID);
            $query->bindParam(':is_approved',$is_approved);
            $query->bindParam(':leave_year',$leave_year);
            $query->execute();
            $employeeLeaveResult = $query->fetchAll();
            $employeeLeaveRow = count($employeeLeaveResult);
            if (isset($employeeLeaveRow)) {
              $usedLeave = 0;
              foreach ($employeeLeaveResult as $value) {
                $usedLeave = $usedLeave + $value['day_count'];                
              }
            }
            $totalLeave = $paidLeave-$usedLeave;
            ?>
            <div class="col-md-4 col-12 mb-4">
              <div class="box">
                <div class="">
                  <h3 class="fw-bold"><?php if(!empty($leaveTypeName)){ echo $leaveTypeName; } ?></h3>
                </div> 
                <hr>
                <div>
                  <p class="mb-1"><strong>Paid Leave:</strong> <span class="float-end"><?php if(!empty($paidLeave)){ echo $paidLeave; }else{ echo 0;} ?></span></p>
                  <hr>
                  <p class="mb-1"><strong>Used Leave:</strong> <span class="float-end"><?php if(!empty($usedLeave)){ echo $usedLeave; }else{ echo 0;} ?></span></p>
                  <hr>

                  <?php
                    if ($totalLeave>=0) {
                     ?>
                     <p class="mb-1"><strong>Available Leave:</strong> <span class="float-end"><?php if(!empty($totalLeave)){ echo $totalLeave; }else{ echo 0;} ?></span></p>
                     <?php
                    }else{
                      ?>
                      <p class="mb-1"><strong>Unpaid Leave:</strong> <span class="float-end"><?php if(!empty($totalLeave)){ echo $totalLeave; }else{ echo 0;} ?></span></p>
                      <?php
                    }
                  ?>
                  <!-- <p class="mb-1"><strong>Total Leave:</strong> <span class="float-end"><?php // if(!empty($totalLeave)){ echo $totalLeave; }else{ echo 0;} ?></span></p> -->
                  <!-- <p class="mb-1"><strong>Unpaid Leave:</strong> <?php // if(!empty($totalLeave)){ echo $totalLeave; } ?></p> -->
                </div>
              </div>        
            </div>
            <?php
          }

          if ($leaveTypeListResult[0]['short_name']='CL'){
            $short_name = $leaveTypeListResult[0]['short_name'];
            $query = $conn->prepare("SELECT * From leave_type where short_name = :short_name");
            $query->bindParam(':short_name',$short_name);
            $query->execute();
            $leaveTypeResult = $query->fetchAll();
            $leaveTypeRow = count($leaveTypeResult);
            if((isset($leaveTypeRow))>0) {
              foreach ($leaveTypeResult as $value) {
                 $leaveTypeID = $value['id'];
                 $leaveTypeName = $value['leave_type_name'];
                 $shortName = $value['short_name'];
                 $paidLeave = $value['total_leave'];
              }
            }

            $is_approved = "approve";
            $leave_year = date('Y');
            $query = $conn->prepare("SELECT * From employee_leave where leave_type_id = :leave_type_id and emp_id = :emp_id and is_approved = :is_approved and leave_year = :leave_year");
            $query->bindParam(':leave_type_id',$leaveTypeID);
            $query->bindParam(':emp_id',$empID);
            $query->bindParam(':is_approved',$is_approved);
            $query->bindParam(':leave_year',$leave_year);
            $query->execute();
            $employeeLeaveResult = $query->fetchAll();
            $employeeLeaveRow = count($employeeLeaveResult);

            if (isset($employeeLeaveRow)) {
              $usedLeave = 0;
              foreach ($employeeLeaveResult as $value) {
                $usedLeave = $usedLeave + $value['day_count'];                
              }
            }

            $totalLeave = $paidLeave-$usedLeave;

            ?>
            <div class="col-md-4 col-12 mb-4">
              <div class="box">
                <div class="">
                  <h3 class="fw-bold"><?php if(!empty($leaveTypeName)){ echo $leaveTypeName; } ?></h3>
                </div> 
                <hr>
                <div>
                  <p class="mb-1"><strong>Paid Leave:</strong> <span class="float-end"><?php if(!empty($paidLeave)){ echo $paidLeave; }else{ echo 0;} ?></span></p>
                  <hr>
                  <p class="mb-1"><strong>Used Leave:</strong> <span class="float-end"><?php if(!empty($usedLeave)){ echo $usedLeave; }else{ echo 0;} ?></span></p>
                  <hr>

                  <?php
                    if ($totalLeave>=0) {
                     ?>
                     <p class="mb-1"><strong>Available Leave:</strong> <span class="float-end"><?php if(!empty($totalLeave)){ echo $totalLeave; }else{ echo 0;} ?></span></p>
                     <?php
                    }else{
                      ?>
                      <p class="mb-1"><strong>Unpaid Leave:</strong> <span class="float-end"><?php if(!empty($totalLeave)){ echo $totalLeave; }else{ echo 0;} ?></span></p>
                      <?php
                    }
                  ?>
                  <!-- <p class="mb-1"><strong>Total Leave:</strong> <span class="float-end"><?php // if(!empty($totalLeave)){ echo $totalLeave; }else{ echo 0;} ?></span></p> -->
                  <!-- <p class="mb-1"><strong>Unpaid Leave:</strong> <?php // if(!empty($totalLeave)){ echo $totalLeave; } ?></p> -->
                </div>
              </div>        
            </div>
            <?php
          }
          



          if ($leaveTypeListResult[0]['short_name']='EL'){
            $short_name = $leaveTypeListResult[0]['short_name'];
            $query = $conn->prepare("SELECT * From leave_type where short_name = :short_name");
            $query->bindParam(':short_name',$short_name);
            $query->execute();
            $leaveTypeResult = $query->fetchAll();
            $leaveTypeRow = count($leaveTypeResult);
            if((isset($leaveTypeRow))>0) {
              foreach ($leaveTypeResult as $value) {
                 $leaveTypeID = $value['id'];
                 $leaveTypeName = $value['leave_type_name'];
                 $shortName = $value['short_name'];
                 $paidLeave = $value['total_leave'];
              }
            }

            $is_approved = "approve";
            $leave_year = date('Y');
            $query = $conn->prepare("SELECT * From employee_leave where leave_type_id = :leave_type_id and emp_id = :emp_id and is_approved = :is_approved and leave_year = :leave_year");
            $query->bindParam(':leave_type_id',$leaveTypeID);
            $query->bindParam(':emp_id',$empID);
            $query->bindParam(':is_approved',$is_approved);
            $query->bindParam(':leave_year',$leave_year);
            $query->execute();
            $employeeLeaveResult = $query->fetchAll();
            $employeeLeaveRow = count($employeeLeaveResult);

            if (isset($employeeLeaveRow)) {
              $usedLeave = 0;
              foreach ($employeeLeaveResult as $value) {
                $usedLeave = $usedLeave + $value['day_count'];                
              }
            }
            $totalLeave = $paidLeave-$usedLeave;
            ?>
            <div class="col-md-4 col-12 mb-4">
              <div class="box">
                <div class="">
                  <h3 class="fw-bold"><?php if(!empty($leaveTypeName)){ echo $leaveTypeName; } ?></h3>
                </div> 
                <hr>
                <div>
                  <p class="mb-1"><strong>Paid Leave:</strong> <span class="float-end"><?php if(!empty($paidLeave)){ echo $paidLeave; }else{ echo 0;} ?></span></p>
                  <hr>
                  <p class="mb-1"><strong>Used Leave:</strong> <span class="float-end"><?php if(!empty($usedLeave)){ echo $usedLeave; }else{ echo 0;} ?></span></p>
                  <hr>

                  <?php
                    if ($totalLeave>=0) {
                     ?>
                     <p class="mb-1"><strong>Available Leave:</strong> <span class="float-end"><?php if(!empty($totalLeave)){ echo $totalLeave; }else{ echo 0;} ?></span></p>
                     <?php
                    }else{
                      ?>
                      <p class="mb-1"><strong>Unpaid Leave:</strong> <span class="float-end"><?php if(!empty($totalLeave)){ echo $totalLeave; }else{ echo 0;} ?></span></p>
                      <?php
                    }
                  ?>
                </div>
              </div>        
            </div>
            <?php
          }




          if ($leaveTypeListResult[0]['short_name']='STL'){
            $short_name = $leaveTypeListResult[0]['short_name'];
            $query = $conn->prepare("SELECT * From leave_type where short_name = :short_name");
            $query->bindParam(':short_name',$short_name);
            $query->execute();
            $leaveTypeResult = $query->fetchAll();
            $leaveTypeRow = count($leaveTypeResult);
            if((isset($leaveTypeRow))>0) {
              foreach ($leaveTypeResult as $value) {
                 $leaveTypeID = $value['id'];
                 $leaveTypeName = $value['leave_type_name'];
                 $shortName = $value['short_name'];
                 $paidLeave = $value['total_leave'];
              }
            }

            $is_approved = "approve";
            $leave_year = date('Y');
            $query = $conn->prepare("SELECT * From employee_leave where leave_type_id = :leave_type_id and emp_id = :emp_id and is_approved = :is_approved and leave_year = :leave_year and DATE_FORMAT(from_date,'%y-%m') = DATE_FORMAT(NOW(),'%y-%m')");
            $query->bindParam(':leave_type_id',$leaveTypeID);
            $query->bindParam(':emp_id',$empID);
            $query->bindParam(':is_approved',$is_approved);
            $query->bindParam(':leave_year',$leave_year);
            $query->execute();
            $employeeLeaveResult = $query->fetchAll();
            $employeeLeaveRow = count($employeeLeaveResult);

            if (isset($employeeLeaveRow)) {
              $usedLeave = 0;
              foreach ($employeeLeaveResult as $value) {
                $usedLeave = $usedLeave + $value['day_count'];                
              }
            }
            $totalLeave = $paidLeave-$usedLeave;
            ?>
            <div class="col-md-4 col-12 mb-4">
              <div class="box">
                <div class="">
                  <h3 class="fw-bold"><?php if(!empty($leaveTypeName)){ echo $leaveTypeName; } ?></h3>
                </div> 
                <hr>
                <div>
                  <p class="mb-1"><strong>Paid Leave:</strong> <span class="float-end"><?php if(!empty($paidLeave)){ echo $paidLeave; }else{ echo 0;} ?></span></p>
                  <hr>
                  <p class="mb-1"><strong>Used Leave:</strong> <span class="float-end"><?php if(!empty($usedLeave)){ echo $usedLeave; }else{ echo 0;} ?></span></p>
                  <hr>

                  <?php
                    if ($totalLeave>=0) {
                     ?>
                     <p class="mb-1"><strong>Available Leave:</strong> <span class="float-end"><?php if(!empty($totalLeave)){ echo $totalLeave; }else{ echo 0;} ?></span></p>
                     <?php
                    }else{
                      ?>
                      <p class="mb-1"><strong>Unpaid Leave:</strong> <span class="float-end"><?php if(!empty($totalLeave)){ echo $totalLeave; }else{ echo 0;} ?></span></p>
                      <?php
                    }
                  ?>
                </div>
              </div>        
            </div>
            <?php
          }






        }
      ?>

      <!-- <div class="col-md-3 col-12 mb-4">
        <div class="box">
          <div class="">
            <h3 class="fw-bold">Casual Leave</h3>
          </div> 
          <hr>
          <div>
            <p class="mb-1"><strong>Used Leave:</strong> 7</p>
            <p class="mb-1"><strong>Available Leave:</strong> 7</p>
            <p class="mb-1"><strong>Unpaid Leave:</strong> 7</p>
          </div>
        </div>        
      </div>
      <div class="col-md-3 col-12 mb-4">
        <div class="box">
          <div class="">
            <h3 class="fw-bold">Sick Leave</h3>
          </div> 
          <hr>
          <div>
            <p class="mb-1"><strong>Used Leave:</strong> 7</p>
            <p class="mb-1"><strong>Available Leave:</strong> 7</p>
            <p class="mb-1"><strong>Unpaid Leave:</strong> 7</p>
          </div>
        </div>        
      </div>
      <div class="col-md-3 col-12 mb-4">
        <div class="box">
          <div class="">
            <h3 class="fw-bold">Earning Leave</h3>
          </div> 
          <hr>
          <div>
            <p class="mb-1"><strong>Used Leave:</strong> 7</p>
            <p class="mb-1"><strong>Available Leave:</strong> 7</p>
            <p class="mb-1"><strong>Unpaid Leave:</strong> 7</p>
          </div>
        </div>        
      </div>
      <div class="col-md-3 col-12 mb-4">
        <div class="box">
          <div class="">
            <h3 class="fw-bold">Gatepass</h3>
          </div> 
          <hr>
          <div>
            <p class="mb-1"><strong>Used Leave:</strong> 7</p>
            <p class="mb-1"><strong>Available Leave:</strong> 7</p>
            <p class="mb-1"><strong>Unpaid Leave:</strong> 7</p>
          </div>
        </div>        
      </div> -->


    </div>
  </div>
</section>



<?php
  include 'footer.php';
?>