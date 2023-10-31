<?php

include 'header.php';

$is_active = "active";
$query = $conn->prepare("SELECT id,full_name,title From employee where is_active = :is_active order by id desc");
$query->bindParam(':is_active',$is_active);
$query->execute();
$employeeListResult = $query->fetchAll();
$employeeListRow = count($employeeListResult);

$today_date = date('Y-m-d');

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
                                            <!-- <th class="align-middle"></th> -->
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


                             <!--   <br>
                               <p class="text-muted">Drag and drop your event or click in the calendar</p>
                               <div class="external-event fc-event bg-success" data-class="bg-success">
                                  <i class="mdi mdi-checkbox-blank-circle font-size-11 me-2"></i>New Event Planning
                               </div>
                               <div class="external-event fc-event bg-info" data-class="bg-info">
                                  <i class="mdi mdi-checkbox-blank-circle font-size-11 me-2"></i>Meeting
                               </div>
                               <div class="external-event fc-event bg-warning" data-class="bg-warning">
                                  <i class="mdi mdi-checkbox-blank-circle font-size-11 me-2"></i>Generating Reports
                               </div>
                               <div class="external-event fc-event bg-danger" data-class="bg-danger">
                                  <i class="mdi mdi-checkbox-blank-circle font-size-11 me-2"></i>Create New theme
                               </div> -->
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
                                <div>
                                    <!-- <form method='post' action='#'> -->
                                    <div class="row">  
                                        <div class="col-sm-4 align-self-end">
                                            <!-- <div class="mb-3">
                                                <input type='submit' class="btn btn-primary" value='Update Lunch' name='lunch_updated_btn'>
                                            </div> -->
                                        </div> 
                                        <div class="col-sm-4"></div>                                                     
                                        <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label class="form-label">Search by date :</label>
                                                <input type="date" class="form-control" value="<?php if(!empty($today_date)){ echo $today_date; } ?>" id="dateSelect" name="dateSelect" onchange="changeDateLunchList()">
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="table-responsive">                                        
                                        <table class="table align-middle table-nowrap table-check">
                                            <thead class="table-light">
                                                <tr>
                                                    <th style="width: 20px;" class="align-middle">
                                                        <div class="form-check font-size-16">
                                                            <input class="form-check-input" type="checkbox" id="checkAll">
                                                            <label class="form-check-label" for="checkAll"></label>
                                                        </div>
                                                        <!-- <input type="checkbox" value="<?php if(!empty($id)){ echo $id; } ?>"class="checkBoxList"> -->
                                                    </th>
                                                    <th class="align-middle">Employee Name</th>
                                                    <th class="align-middle">Entry</th>
                                                    <th class="align-middle">Distance</th>
                                                    <th class="align-middle">Date</th>
                                                    <!-- <th class="align-middle">Action</th> -->
                                                </tr>
                                            </thead>
                                            <tbody id="employeeListByDate">
                                                <?php 
                                                if (isset($employeeListRow)) {
                                                   if ($employeeListRow>0) {
                                                       foreach ($employeeListResult as $value) {
                                                        $employeeID = $value['id'];
                                                        $employeeTitle = $value['title'];
                                                        $employeeName = $value['full_name'];

                                                        $employeeFullName = $employeeTitle." ".$employeeName;

                                                        $query = $conn->prepare("SELECT * from daily_attendance where employee_id = :employeeID and attendance_date = :attendance_date");
                                                        $query->bindParam(':employeeID',$employeeID);
                                                        $query->bindParam(':attendance_date',$today_date);
                                                        $query->execute();
                                                        $empDailyAttResult = $query->fetchAll();
                                                        $empDailyAttRow = count($empDailyAttResult);
                                                        // die();
                                                        if ($empDailyAttRow>0) {
                                                           foreach ($empDailyAttResult as $value) {
                                                                $dailyAttandanceEmpID = $value['employee_id'];
                                                                $entry_time = $value['entry_time'];
                                                                $entry_distance = $value['entry_distance'];
                                                                // echo $count = strlen($entry_time);
                                                                // if($count>2){
                                                                //    echo $entry_time;
                                                                //    echo "<br>";
                                                                // }else{
                                                                //    echo $entry_time = "Hello";
                                                                //    echo "<br>";
                                                                // }      
                                                                $exit_time = $value['exit_time'];
                                                                $remark = $value['remark'];
                                                                $entry_latitude = $value['entry_latitude'];
                                                                $entry_longitude = $value['entry_longitude'];
                                                                $exit_latitude = $value['exit_latitude'];
                                                                $exit_longitude = $value['exit_longitude'];
                                                                $device_type = $value['device_type'];
                                                            }
                                                        }else{
                                                            $entry_time = "";
                                                            $entry_distance = "";
                                                        }
                                                        // $entry_time;
                                                ?>
                                                <tr>
                                                    <td>
                                                        <div class="form-check font-size-16">
                                                            <input class="form-check-input" name="lunch_taken_id[]" type="checkbox" id="orderidcheck01" value="<?php if(!empty($employeeID)){ echo $employeeID; } ?>"
                                                            <?php 
                                                                if(isset($dailyAttandanceEmpID)){
                                                                    if($dailyAttandanceEmpID==$employeeID){echo "checked"; }
                                                                }
                                                            ?>
                                                            >
                                                            <label class="form-check-label" for="orderidcheck01"></label>
                                                        </div>
                                                    </td>
                                                    <td><a href="javascript: void(0);" class="text-body fw-bold"><?php if(!empty($employeeFullName)){ echo $employeeFullName; } ?></a> </td>

                                                    <td><?php if(!empty($entry_time)){ echo $entry_time;  }  ?> </td>
                                                    <td><?php if(!empty($entry_distance)){ echo $entry_distance;  }  ?> </td>
                                                    <td><?php if(isset($today_date)) { echo $today_date; } ?></td>
                                                </tr>

                                                        <?php
                                                        

                                                       }
                                                   }
                                                }                                                        
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- </form> -->
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
    function changeDateLunchList(){
        var attendanceDate = $("#dateSelect").val();
        $.ajax({
        url: "include/attendance/dailyAttendanceEmpListByDate.php", 
        type : 'POST',
        data : {attendanceDate:attendanceDate},
        success: function(result){   
            console.log(result);   
            // $("#employeeListByDate").html();
            $("#employeeListByDate").html(result);
        }});
    }
</script>