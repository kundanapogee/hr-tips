       <?php

include 'header.php';


?> 

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                <div class="msgWrap">
                    <?php
                      if (isset($_SESSION['amsg'])) {
                          echo $_SESSION['amsg'];
                          unset($_SESSION['amsg']);
                      }
                    ?>
                </div>                
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Daily Attendance Add</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                                    <li class="breadcrumb-item active">Daily Attendance Add</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

      
                <div class="row">
                    <div class="col-lg-3">
                      <div class="card">
                         <div class="card-body">
                            <div class="d-grid">
                               <a href="#" data-bs-toggle="modal" data-bs-target="#modelDailyAttendanceEmployee" class="btn font-16 btn-primary" title="Add New Event">Daily Attendance Add</a>
                               <?php
                                include 'include/attendance/dailyAttendanceEmployeeAdd.php';
                               ?>
                            </div>
                            
                            <div id="external-events" class="mt-2">
                                <p class="text-muted my-3">Today employee leave.</p>
                                <table class="table align-middle table-nowrap mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="align-middle">Sr. No</th>
                                            <th class="align-middle">Emp. Name</th>                                            
                                        </tr>
                                    </thead>
                                <?php 
                                    $is_approved = "approve";
                                    // $today_date = date('Y-m-d');
                                    $query = $conn->prepare("SELECT * from employee_leave where now() between from_date and DATE_ADD(to_date, INTERVAL 1 DAY) and is_approved = :is_approved");
                                    $query->bindParam(':is_approved',$is_approved);
                                    $query->execute();
                                    $empLeaveTodayResult = $query->fetchAll();
                                    $empLeaveTodayRow = count($empLeaveTodayResult);

                                    if ($empLeaveTodayRow>0) {
                                      $sr_no = 1;
                                      foreach($empLeaveTodayResult as $value){
                                        $emp_id = $value['emp_id'];
                                        $reason = $value['reason'];

                                        $query = $conn->prepare("SELECT id,full_name,title From employee where id = :emp_id");
                                        $query->bindParam(':emp_id',$emp_id);
                                        $query->execute();
                                        $employeeListLeaveResult = $query->fetchAll();
                                        $employeeListLeaveRow = count($employeeListLeaveResult);
                                        if ($employeeListLeaveRow) {
                                          $empFullName = $employeeListLeaveResult[0]['full_name'];
                                          $empFullName = strtok($empFullName, " ");
                                        ?>                                    
                                        <tr>
                                            <td>
                                                <?php if (!empty($sr_no)) { echo $sr_no; } ?>
                                            </td>
                                            <td><?php if(!empty($empFullName)){ echo $empFullName; } ?></td>
                                        </tr>
                                        <?php
                                        }
                                        $sr_no = $sr_no + 1;
                                      }                                              
                                    }
                                ?>
                                </table>
                            </div>
                            <div class="row justify-content-center mt-5">
                               <img src="assets/images/verification-img.png" alt="" class="img-fluid d-block">
                            </div>
                         </div>
                      </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 table-responsive">                                        
                                        <table id="datatable" class="table align-middle table-nowrap table-hover mb-0" data-page-length='20'>
                                            <thead>
                                                <tr>
                                                   <th class="align-middle">Employee Name</th>
                                                    <th class="align-middle">Date</th>
                                                    <th class="align-middle">Entry</th>
                                                    <th class="align-middle">Exit</th>
                                                    <th class="align-middle">Entry Remark</th>
                                                    <th class="align-middle">Exit Remark</th>
                                                </tr>
                                            </thead>
                                            <tbody >
                                                <?php
                                                $query = $conn->prepare("SELECT * from daily_attendance order by id desc");
                                                $query->execute();
                                                $empDailyAttResult = $query->fetchAll();
                                                $empDailyAttRow = count($empDailyAttResult);
                                                if ($empDailyAttRow>0) {
                                                   foreach ($empDailyAttResult as $value) {
                                                    $daily_attendance_id = $value['id'];
                                                    $employee_id = $value['employee_id'];
                                                    $attendance_date = $value['attendance_date'];
                                                    $entry_time = $value['entry_time'];
                                                    $entry_distance = $value['entry_distance'];
                                                    $exit_time = $value['exit_time'];
                                                    $exit_distance = $value['exit_distance'];
                                                    $remark = $value['remark'];
                                                    $exit_remark = $value['exit_remark'];
                                                    $entry_latitude = $value['entry_latitude'];
                                                    $entry_longitude = $value['entry_longitude'];
                                                    $exit_latitude = $value['exit_latitude'];
                                                    $exit_longitude = $value['exit_longitude'];
                                                    $total_time = $value['total_time'];
                                                    $device_type = $value['device_type'];

                                                    $attendance_date = date("d M Y", strtotime($attendance_date));

                                                    if (!empty($entry_distance)) {
                                                      $entry_distance_string = floatval($value['entry_distance']);
                                                      $entry_distance = number_format($entry_distance_string, 2, '.', '');
                                                    }else{
                                                        $entry_distance = "---";
                                                    }                                                  
                                                    if (!empty($exit_distance)) {
                                                      $exit_distance_string = floatval($value['exit_distance']);
                                                      $exit_distance = number_format($exit_distance_string, 2, '.', '');
                                                    }else{
                                                        $exit_distance = "---";
                                                    }
                                                    if (!empty($entry_time)) {
                                                      $entry_time = substr($entry_time,0,5)." ".substr($entry_time,9,9);                
                                                    }else{
                                                        $entry_time = "---";
                                                    }
                                                    if (!empty($exit_time)) {
                                                      $exit_time = substr($exit_time,0,5)." ".substr($exit_time,9,9);                
                                                    }else{
                                                        $exit_time = "---";
                                                    }

                                                    $query = $conn->prepare("SELECT id,full_name,title From employee where id = :employee_id");
                                                    $query->bindParam(':employee_id',$employee_id);
                                                    $query->execute();
                                                    $employeeListResult = $query->fetchAll();
                                                    $employeeListRow = count($employeeListResult);
                                                    if ($employeeListRow>0) {
                                                        $empTitle = $employeeListResult[0]['title'];
                                                        $empFullName = $employeeListResult[0]['full_name'];
                                                        $empCompleteName = $empTitle." ".$empFullName;
                                                    }


                                                ?>
                                                <tr>                                                   
                                                    <td><a href="javascript: void(0);" class="text-body fw-bold"><?php if(!empty($empCompleteName)){ echo $empCompleteName; } ?></a> </td>
                                                    <td class="text-capitalize">
                                                        <p class="mb-0"> <?php if(!empty($attendance_date)){ echo $attendance_date;  }  ?> </p>
                                                        <small class="text-muted"><?php if(!empty($total_time)){ echo $total_time;  }  ?></small>
                                                    </td>
                                                    <td class="text-capitalize">
                                                        <p class="mb-0"> <?php if(!empty($entry_time)){ echo $entry_time;  }  ?> </p>
                                                        <small class="text-muted"><?php if(!empty($entry_distance)){ echo $entry_distance;  }  ?></small>
                                                    </td>
                                                    <td class="text-capitalize">
                                                        <p class="mb-0"> <?php if(!empty($exit_time)){ echo $exit_time;  }  ?> </p>
                                                        <small class="text-muted"><?php if(!empty($exit_distance)){ echo $exit_distance;  }  ?></small>
                                                    </td>
                                                    <td>
                                                        <?php
                                                            if (!empty($remark)) {
                                                                ?>
                                                        <a class="text-info" data-bs-toggle="modal" data-bs-target=".bs-example-modal-sm_entry_remark<?php echo $daily_attendance_id; ?>">Remark</a>
                                                                <?php
                                                            }else{
                                                                echo "---";
                                                            }
                                                        ?>                                                        
                                                        <div class="modal fade bs-example-modal-sm_entry_remark<?php echo $daily_attendance_id; ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                           <div class="modal-dialog modal-sm modal-dialog-centered">
                                                               <div class="modal-content">
                                                                   <div class="modal-body">
                                                                       <h6 style="padding-bottom: 5px;border-bottom: 1px solid #6a6868;display: initial;"><span class="text-muted"><?php if(!empty($attendance_date)){ echo $attendance_date;  }  ?></span> > <span class="text-info"><?php if(!empty($empCompleteName)){ echo $empCompleteName; } ?></span></h6>
                                                                       <div>
                                                                           <p class="mb-0 mt-3" style="white-space: initial;">
                                                                           <?php if(!empty($remark)){ echo $remark;  }  ?>                            
                                                                           </p>
                                                                       </div>
                                                                   </div>
                                                               </div>
                                                           </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <?php
                                                            if (!empty($exit_remark)) {
                                                                ?>
                                                            <a class="text-info" data-bs-toggle="modal" data-bs-target=".bs-example-modal-sm_exit_remark<?php echo $daily_attendance_id; ?>">Remark</a>
                                                                <?php
                                                            }else{
                                                                echo "---";
                                                            }
                                                        ?>
                                                        <div class="modal fade bs-example-modal-sm_exit_remark<?php echo $daily_attendance_id; ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                           <div class="modal-dialog modal-sm modal-dialog-centered">
                                                               <div class="modal-content">
                                                                   <div class="modal-body">
                                                                       <h6 style="padding-bottom: 5px;border-bottom: 1px solid #6a6868;display: initial;"><span class="text-muted"><?php if(!empty($attendance_date)){ echo $attendance_date;  }  ?></span> > <span class="text-info"><?php if(!empty($empCompleteName)){ echo $empCompleteName; } ?></span></h6>
                                                                       <div>
                                                                           <p class="mb-0 mt-3" style="white-space: initial;">
                                                                           <?php if(!empty($exit_remark)){ echo $exit_remark;  }  ?>                            
                                                                           </p>
                                                                       </div>
                                                                   </div>
                                                               </div>
                                                           </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                                        <?php
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
                <!-- end row -->
                
            </div>
        </div>
        <!-- End Page-content -->





<?php
    include 'footer.php';
?>     



<script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<!-- <script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script> -->
<!-- <script src="assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script> -->
<!-- <script src="assets/libs/jszip/jszip.min.js"></script> -->
<!-- <script src="assets/libs/pdfmake/build/pdfmake.min.js"></script> -->
<!-- <script src="assets/libs/pdfmake/build/vfs_fonts.js"></script> -->
<!-- <script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script> -->
<!-- <script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script> -->
<!-- <script src="assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script> -->
<script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
<script src="assets/js/pages/datatables.init.js"></script> 



<script src="assets/js/pages/form-validation.init.js"></script>
<script src="assets/libs/parsleyjs/parsley.min.js"></script>
<script src="assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

<script>
      let userLocation = navigator.geolocation;
         if(userLocation) {
            userLocation.getCurrentPosition(success);
         } else {
            "The geolocation API is not supported by your browser.";
         }
      function success(data) {
         let lat = data.coords.latitude;
         let long = data.coords.longitude;
         $("#latitude").val(lat);
         $("#longitude").val(long);
      }
   </script>






<script>
    $('#datatable').DataTable({
    "ordering": false
});
</script>