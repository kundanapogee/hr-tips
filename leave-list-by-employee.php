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
      <div class="col-md-6 col-8">
        <a href="#"  data-bs-toggle="modal" data-bs-target="#modelApplyLeave" class="btn btn-success waves-effect waves-light btn-sm">Apply Leave <i class="mdi mdi-arrow-right ms-1"></i></a>
        <a href="leaveBalance.php"  class="btn btn-info waves-effect waves-light btn-sm text-white">Balance <i class="mdi mdi-arrow-right ms-1"></i></a>
      </div>
      <div class="col-md-6 col-4 text-end">
        <a href="leaveAppliedCalender.php" class="btn btn-primary waves-effect waves-light btn-sm">Calender <i class="mdi mdi-arrow-right ms-1"></i></a>
      </div>

      <?php 
        include 'include/leave/leaveApplyByEmployee.php';
      ?>

    </div>

    

    <div class="row mt-4">
      <div class="col-md-12 col-12 mb-4">
        <div class="box">
          <div class="">
            <div class="tableWrap table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Leave Type </th>
                    <th>Status </th>
                    <th>From Date</th>
                    <th>To Date</th>
                    <th>Day Type  </th>
                    <th style="min-width: 90px;">Date</th>                    
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                $leave_year = date('Y');
                $query = $conn->prepare("SELECT * From employee_leave where emp_id = :emp_id and leave_year = :leave_year order by id desc ");
                $query->bindParam(':emp_id',$empID);
                $query->bindParam(':leave_year',$leave_year);
                $query->execute();
                $employeeLeaveResult = $query->fetchAll();
                $employeeLeaveRow = count($employeeLeaveResult);

                if ($employeeLeaveRow>0) {
                  $sr_no = 1;
                  foreach ($employeeLeaveResult as $value) {
                    $id = $value['id'];
                    $emp_id = $value['emp_id'];
                    $from_date = $value['from_date'];
                    $to_date = $value['to_date'];
                    $leave_type_id = $value['leave_type_id'];
                    $attached_file = $value['attached_file'];
                    $reason = $value['reason'];
                    $is_approved = $value['is_approved'];
                    $day_type = $value['day_type'];
                    $updated_at = $value['updated_at'];
                    $day_count = $value['day_count'];

                    $query = $conn->prepare("SELECT * From leave_type where id = :leave_type_id");
                    $query->bindParam(':leave_type_id',$leave_type_id);
                    $query->execute();
                    $leaveTypeResult = $query->fetchAll();
                    $leaveTypeRow = count($leaveTypeResult);
                    if((isset($leaveTypeRow))>0) {
                      $leaveTypeName = $leaveTypeResult[0]['leave_type_name'];
                    }


                  ?>
                <tr>
                  <td><?php if(isset($sr_no)){ echo $sr_no; } ?></td>
                  <td><?php if(isset($leaveTypeName)){ echo $leaveTypeName; } ?></td>
                  <td>
                    <?php 
                      if (isset($is_approved)) {
                        if ($is_approved=='approve') {
                         ?>
                         <span class="badge badge-pill badge-soft-success font-size-11">Approved</span>
                         <?php
                        }elseif($is_approved=='disapprove'){
                          ?>
                          <span class="badge badge-pill badge-soft-danger font-size-11">Disapproved</span>
                         <?php
                        }else{
                          ?>
                         <span class="badge badge-pill badge-soft-warning font-size-11">Pending</span>
                         <?php
                        }
                      }
                    ?>       
                  </td>
                  <td><?php if(isset($from_date)){ echo $from_date; } ?></td>
                  <td><?php if(isset($to_date)){ echo $to_date; } ?></td>
                  <td class="text-capitalize"><?php if(isset($day_type)){ echo $day_type; } ?> Day</td>
                  <td><?php if(isset($updated_at)){ echo $updated_at; } ?></td>
                   
                  <td>
                    <a href="#" class="btn btn-primary" style="padding: 2px 6px;border-radius: 3px;" data-bs-toggle="modal" data-bs-target="#attendanceDetailEmp<?php echo $id; ?>"><i class="fas fa-list"></i></a>
                    <?php
                    include 'include/leave/leaveDetailEmpDetail.php';
                    ?>

                    <!-- <a href="attendanceMapLocation.php?id=<?php if(isset($id)){ echo $id; } ?>" class="btn btn-primary" style="padding: 2px 6px;border-radius: 3px;"><i class="fas fa-map-marked-alt"></i></a>                                    -->
                  </td>                
                </tr>
                <?php
                  $sr_no = $sr_no+1;
                  }                    
                }
                ?>
                </tbody>
              </table>
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
  function getLeaveID(leaveID){
    if (leaveID==4){
      $("#dayTypeDiv").hide();
    }else{
      $("#dayTypeDiv").show();
    }
  }
</script>


<script>
  $(document).ready(function(){
      $("#applyLeave").validate({
        rules :{
          leave_type_id: {
                required: true,
            },
          day_type: {
                required: true, 
            },
            from_date: {
                required: true, 
            },
            to_date: {
                required: true, 
            },
            reason: {
                required: true, 
            }
        },
        messages :{ 
          leave_type_id: {
            required:  "Please select leave type.",
          },
          day_type: {
            required: "Please select day type.", 
          },
          from_date: {
            required: "Please select date.", 
          },
          day_type: {
            required: "Please select date.", 
          },
          reason: {
            required: "Please type reason.", 
          },
        }
      });
  });
</script>