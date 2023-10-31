<div id="external-events" class="mt-2">
   <br>
   <p class="text-muted font-weight-bold">Employee Leaves Taken</p>
   <?php
   $employeeDetail = "";
    if(isset($employeeRowMain)){
        if ($employeeRowMain>0) {
            foreach ($employeeResultMain as $value) {
                $empid = $value['id'];
                $empFullName = $value['full_name'];
                ?>
                <div class="external-event fc-event bg-warning px-2 mx-0" data-class="bg-warning">
                  <i class="mdi mdi-checkbox-blank-circle font-size-11 me-2"></i>
                  <?php if (!empty($empFullName)) { echo $empFullName; } ?>
                </div>
                <?php

                $query = $conn->prepare("SELECT * From leave_type");
                $query->execute();
                $leaveTypeResult = $query->fetchAll();
                $leaveTypeRow = count($leaveTypeResult);
                if((isset($leaveTypeRow))>0) {
                    foreach ($leaveTypeResult as $value) {
                        $leaveTypeidSideMain = $value['id'];
                    
                  // $leaveTypeidSideMain = $leaveTypeResult[0]['id'];
                    $leaveTypeShortName = $value['short_name'];

                    $is_approved = 'approve';
                    $query = $conn->prepare("SELECT emp_id,leave_type_id,is_approved, SUM(day_count) dayCount From employee_leave where emp_id = :empid and leave_type_id = :leaveTypeidSideMain and is_approved = :is_approved");
                    $query->bindParam(':empid',$empid);
                    $query->bindParam(':leaveTypeidSideMain',$leaveTypeidSideMain);
                    $query->bindParam(':is_approved',$is_approved);
                    $query->execute();
                    $employeeLeaveResultSide = $query->fetchAll();
                    $employeeLeaveRowSide = count($employeeLeaveResultSide);

                    if((isset($employeeLeaveRowSide))>0) {
                        foreach ($employeeLeaveResultSide as $value) {
                            // echo " Emp ".$empidSide = $empid;
                            $leaveTypeIDSide = $value['leave_type_id']."";
                            $day_count = $value['dayCount']."";                 
                            // echo "<br>";
                        }                                            
                    } 

                    $employeeDetail .= '<span><i class="text-dark"><b>'.$leaveTypeShortName.'</i></b> : <b>'.$day_count.'</b> &nbsp&nbsp | &nbsp </span>';   
                } 

            }                          

            ?>

        <div class="external-event fc-event bg-success px-2 mx-0 text-white" data-class="bg-warning">
            <?php echo $employeeDetail; ?>
        </div>

            <?php

            $employeeDetail = "";
        
            }
        }
    }
   ?>
</div>
<div class="row justify-content-center mt-5">
   <img src="assets/images/verification-img.png" alt="" class="img-fluid d-block">
</div>