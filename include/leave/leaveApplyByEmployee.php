<?php

// $query = $conn->prepare("SELECT * From leave_type");
// $query->execute();
// $leaveTypeListResult = $query->fetchAll();
// $leaveTypeListRow = count($leaveTypeListResult);

// if (isset($leaveTypeListRow)) {
//   if ($leaveTypeListResult[0]['short_name']='SL'){
//     $short_name = $leaveTypeListResult[0]['short_name'];
//     $query = $conn->prepare("SELECT * From leave_type where short_name = :short_name");
//     $query->bindParam(':short_name',$short_name);
//     $query->execute();
//     $leaveTypeResult = $query->fetchAll();
//     $leaveTypeRow = count($leaveTypeResult);
//     if((isset($leaveTypeRow))>0) {
//       foreach ($leaveTypeResult as $value) {
//          $leaveTypeID = $value['id'];
//          $leaveTypeName = $value['leave_type_name'];
//          $shortName = $value['short_name'];
//          $paidLeave = $value['total_leave'];
//       }
//     }
//     $is_approved = "approve";
//     $leave_year = date('Y');
//     $query = $conn->prepare("SELECT * From employee_leave where leave_type_id = :leave_type_id and emp_id = :emp_id and is_approved = :is_approved and leave_year = :leave_year");
//     $query->bindParam(':leave_type_id',$leaveTypeID);
//     $query->bindParam(':emp_id',$empID);
//     $query->bindParam(':is_approved',$is_approved);
//     $query->bindParam(':leave_year',$leave_year);
//     $query->execute();
//     $employeeLeaveResult = $query->fetchAll();
//     $employeeLeaveRow = count($employeeLeaveResult);
//     if (isset($employeeLeaveRow)) {
//       $usedLeave = 0;
//       foreach ($employeeLeaveResult as $value) {
//         $usedLeave = $usedLeave + $value['day_count'];                
//       }
//     }
//     // echo $totalLeave = $paidLeave-$usedLeave;
//     echo $shortName;
//     echo ": ".$usedLeave;

//   }



// if ($leaveTypeListResult[0]['short_name']='CL'){
//     $short_name = $leaveTypeListResult[0]['short_name'];
//     $query = $conn->prepare("SELECT * From leave_type where short_name = :short_name");
//     $query->bindParam(':short_name',$short_name);
//     $query->execute();
//     $leaveTypeResult = $query->fetchAll();
//     $leaveTypeRow = count($leaveTypeResult);
//     if((isset($leaveTypeRow))>0) {
//       foreach ($leaveTypeResult as $value) {
//          $leaveTypeID = $value['id'];
//          $leaveTypeName = $value['leave_type_name'];
//          $shortName = $value['short_name'];
//          $paidLeave = $value['total_leave'];
//       }
//     }

//     $is_approved = "approve";
//     $leave_year = date('Y');
//     $query = $conn->prepare("SELECT * From employee_leave where leave_type_id = :leave_type_id and emp_id = :emp_id and is_approved = :is_approved and leave_year = :leave_year");
//     $query->bindParam(':leave_type_id',$leaveTypeID);
//     $query->bindParam(':emp_id',$empID);
//     $query->bindParam(':is_approved',$is_approved);
//     $query->bindParam(':leave_year',$leave_year);
//     $query->execute();
//     $employeeLeaveResult = $query->fetchAll();
//     $employeeLeaveRow = count($employeeLeaveResult);

//     if (isset($employeeLeaveRow)) {
//       $usedLeave = 0;
//       foreach ($employeeLeaveResult as $value) {
//         $usedLeave = $usedLeave + $value['day_count'];                
//       }
//     }

//   echo $shortName;
//   echo ": ".$usedLeave;


// }

// }
?>


<div class="modal myModel" id="modelApplyLeave">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bgColorBlack">
        <h4 class="modal-title">Apply Leave</h4>
        <button type="button" class="btn-close text-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form action="backend/employeeLeaveAdd.php" method="post" enctype="multipart/form-data" id="applyLeave">
          <div>              
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Leave Type:</label>
                    <select class="form-control" name="leave_type_id" onchange="getLeaveID(this.value)">
                      <option selected disabled>Select...</option>
                      <?php
                      if (isset($leaveTypeListRow)) {
                        foreach ($leaveTypeListResult as $value) {
                          $leaveTypeID = $value['id'];
                          $leaveTypeName = $value['leave_type_name'];
                          $shortName = $value['short_name'];
                          ?>
                          <option value="<?php if(isset($leaveTypeID)){ echo $leaveTypeID; } ?>"> 
                            <?php if(isset($leaveTypeName)){ echo $leaveTypeName; } ?> 
                          </option>
                          <?php
                        }
                      }
                      ?>                   
                      <!-- <option>Casual Leave</option>
                      <option>Sick Leave</option>
                      <option>Earning Leave</option>
                      <option>Gate Pass</option> -->
                    </select>
                  </div>
                </div>  
                <div class="col-md-6" id="dayTypeDiv">
                  <div class="mb-3">
                    <label class="form-label">Day Type:</label>
                    <select class="form-control" name="day_type">
                      <option selected disabled>Select...</option>
                      <option value="half">Half</option>
                      <option value="full">Full</option>
                    </select>
                  </div>
                </div>                  
                <div class="col-md-6">                  
                  <div class="mb-3">
                    <label class="form-label">From Date:</label>
                    <input type="date" class="form-control" name="from_date" >
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">To Date:</label>
                    <input type="date" class="form-control" name="to_date" >
                  </div>
                </div>
                
                <div class="col-md-12">
                  <div class="mb-3">
                    <label class="form-label">Attached File:</label>
                    <input type="file" class="form-control" name="attachedFile">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="mb-3">
                    <label class="form-label">Reason:</label>
                    <textarea class="form-control" name="reason"></textarea>
                  </div>
                </div>  
                <div class="col-md-12">
                  <div class="mb-3">
                    <button type="submit" class="btn btn-success waves-effect waves-light btn-sm w-100 py-2" name="submitFormBtn">Apply Leave</button>
                  </div>
                </div>         
              </div>               
          </div>
        </form>
        <div>
         
        </div>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
      </div> -->
    </div>
  </div>
</div> 