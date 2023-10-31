<?php
include 'header.php';

$is_active = 'active';
$today_date = date('Y-m-d');




?>            



<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Dashboard</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">


                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium">Employee</p>
                                            <h4 class="mb-0">
                                                <?php
                                                $query = $conn->prepare("SELECT id From employee where is_active=:is_active order by id desc ");
                                                $query->bindParam(':is_active',$is_active);
                                                $query->execute();
                                                $employeeResult = $query->fetchAll();
                                                $employeeRow = count($employeeResult);
                                                    if (isset($employeeRow)) {
                                                       echo $employeeRow;
                                                    }
                                                ?>
                                            </h4>
                                        </div>

                                        <div class="flex-shrink-0 align-self-center">
                                            <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                                <span class="avatar-title">
                                                    <i class="bx bx-copy-alt font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <?php
                                $query = $conn->prepare("SELECT DISTINCT employee_id from lunch_taken where lunch_date = :lunch_date");
                                $query->bindParam(':lunch_date',$today_date);
                                $query->execute();
                                $lunchTakenEmpResultToday = $query->fetchAll();
                                $lunchTakenEmpRowToday = count($lunchTakenEmpResultToday);
                            ?>
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium">Lunch Today</p>
                                            <h4 class="mb-0">
                                                <?php
                                                    if (isset($lunchTakenEmpRowToday)) {
                                                       echo $lunchTakenEmpRowToday;
                                                    }
                                                ?>
                                            </h4>
                                        </div>

                                        <div class="flex-shrink-0 align-self-center ">
                                            <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                                <span class="avatar-title rounded-circle bg-primary">
                                                    <i class="bx bx-archive-in font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <?php
                                $query = $conn->prepare("SELECT * from lunch_taken where MONTH(lunch_date) = MONTH(now()) and YEAR(lunch_date) = YEAR(now()) ");
                                $query->execute();
                                $lunchTakenEmpResultMonth = $query->fetchAll();
                                $lunchTakenEmpRowMonth = count($lunchTakenEmpResultMonth);
                            ?>
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium">Monthly Lunch</p>
                                            <h4 class="mb-0">
                                                <?php
                                                    if (isset($lunchTakenEmpRowMonth)) {
                                                       echo $lunchTakenEmpRowMonth;
                                                    }
                                                ?>
                                            </h4>
                                        </div>
                                        <div class="flex-shrink-0 align-self-center">
                                            <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                                <span class="avatar-title rounded-circle bg-primary">
                                                    <i class="bx bx-purchase-tag-alt font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <?php
                                $query = $conn->prepare("SELECT id,employee_id from daily_attendance where date(created_at) = :today_date");
                                $query->bindParam(':today_date',$today_date);
                                $query->execute();
                                $todayAttendanceResult = $query->fetchAll();
                                $todayAttendanceRow = count($todayAttendanceResult);
                            ?>
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium">Today Present</p>
                                            <h4 class="mb-0">
                                                <?php
                                                    if (isset($todayAttendanceRow)) {
                                                       echo $todayAttendanceRow;
                                                    }
                                                ?>
                                            </h4>
                                        </div>
                                        <div class="flex-shrink-0 align-self-center">
                                            <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                                <span class="avatar-title rounded-circle bg-primary">
                                                    <i class="bx bx-purchase-tag-alt font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                </div>



                <div class="col-xl-12">
                    <div class="row">
                        <?php                        
                        $query = $conn->prepare("SELECT id,img,title,full_name,designation From employee where is_active=:is_active order by id desc limit 0, 6 ");
                        $query->bindParam(':is_active',$is_active);
                        $query->execute();
                        $employeeResult = $query->fetchAll();
                        $employeeRow = count($employeeResult);
                        if ($employeeRow>0) {
                            foreach ($employeeResult as $value) {
                                $empID = $value['id'];
                                $emp_full_name = $value['title']." ".$value['full_name'];
                                $emp_img = $value['img'];
                                $emp_full_name = $value['full_name'];
                                $designation_id = $value['designation'];

                                $query = $conn->prepare("SELECT designation_name From designation where id = :designation_id");
                                $query->bindParam(':designation_id',$designation_id);
                                $query->execute();
                                $designationResult = $query->fetchAll();
                                $designationRow = count($designationResult);
                                if((!empty($designationRow))>0) {
                                    $designationName = $designationResult[0]['designation_name'];
                                }


                                $is_approved = "approve";
                                $leave_year = date('Y');
                                $leaveTypeID = 1;
                                $query = $conn->prepare("SELECT id,sum(day_count) sickLeave,leave_type_id,emp_id From employee_leave where leave_type_id = :leave_type_id and emp_id = :emp_id and is_approved = :is_approved and leave_year = :leave_year");
                                $query->bindParam(':leave_type_id',$leaveTypeID);
                                $query->bindParam(':emp_id',$empID);
                                $query->bindParam(':is_approved',$is_approved);
                                $query->bindParam(':leave_year',$leave_year);
                                $query->execute();
                                $employeeLeaveResult = $query->fetchAll();
                                $EmpsickLeave = $employeeLeaveResult[0]['sickLeave'];

                                $leaveTypeID = 2;
                                $query = $conn->prepare("SELECT id,sum(day_count) casualLeave,leave_type_id,emp_id From employee_leave where leave_type_id = :leave_type_id and emp_id = :emp_id and is_approved = :is_approved and leave_year = :leave_year");
                                $query->bindParam(':leave_type_id',$leaveTypeID);
                                $query->bindParam(':emp_id',$empID);
                                $query->bindParam(':is_approved',$is_approved);
                                $query->bindParam(':leave_year',$leave_year);
                                $query->execute();
                                $employeeLeaveResult = $query->fetchAll();
                                $EmpCasualLeave = $employeeLeaveResult[0]['casualLeave'];


                                $leaveTypeID = 3;
                                $query = $conn->prepare("SELECT id,sum(day_count) earnLeave,leave_type_id,emp_id From employee_leave where leave_type_id = :leave_type_id and emp_id = :emp_id and is_approved = :is_approved and leave_year = :leave_year");
                                $query->bindParam(':leave_type_id',$leaveTypeID);
                                $query->bindParam(':emp_id',$empID);
                                $query->bindParam(':is_approved',$is_approved);
                                $query->bindParam(':leave_year',$leave_year);
                                $query->execute();
                                $employeeLeaveResult = $query->fetchAll();
                                $EmpearnLeave = $employeeLeaveResult[0]['earnLeave'];

                                $leaveTypeID = 4;
                                $query = $conn->prepare("SELECT id,sum(day_count) stlLeave,leave_type_id,emp_id From employee_leave where leave_type_id = :leave_type_id and emp_id = :emp_id and is_approved = :is_approved and leave_year = :leave_year and DATE_FORMAT(from_date,'%y-%m') = DATE_FORMAT(NOW(),'%y-%m')");
                                $query->bindParam(':leave_type_id',$leaveTypeID);
                                $query->bindParam(':emp_id',$empID);
                                $query->bindParam(':is_approved',$is_approved);
                                $query->bindParam(':leave_year',$leave_year);
                                $query->execute();
                                $employeeLeaveResult = $query->fetchAll();
                                $EmpstlLeave = $employeeLeaveResult[0]['stlLeave'];
                                ?>
                                <div class="col-xl-4">
                                    <div class="card overflow-hidden">
                                        <a href="employeeDetail.php?emp_id=<?php echo $empID; ?>">
                                            <div class="bg-primary bg-soft">
                                                <div class="row">
                                                    <div class="col-5">
                                                        <div class="avatar-md1 profile-user-wid1 mb-2">
                                                            <?php 
                                                            if (file_exists("upload/users/".$emp_img)){
                                                                   ?>
                                                                   <img src="upload/users/<?php if(isset($emp_img)){ echo $emp_img; } ?>" class="img-thumbnail rounded-circle ms-2 mt-2" style="margin-top: 0%;width: 80px;height: 80px;object-fit: cover;">
                                                                   <?php 
                                                                }else{
                                                                    ?>
                                                                    <img src="upload/users/imgPlaceholder.png" class="img-thumbnail rounded-circle ms-2 mt-2" style="margin-top: 0%;width: 80px;height: 80px;object-fit: cover;">
                                                                    <?php
                                                                }
                                                            ?>                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col-7 align-self-center">
                                                        <div class="text-primary p-3 pt-2 pb-0">
                                                            <h5 class="text-primary text-end"><?php if(isset($emp_full_name)){ echo $emp_full_name; } ?></h5>
                                                            <p class="text-end"><?php if(isset($designationName)){ echo $designationName; } ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card-body pt-0">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="row pt-4">
                                                            <div class="col-3">
                                                                <h5 class="font-size-15">
                                                                    <?php if($EmpCasualLeave>0){ echo $EmpCasualLeave; }else{ echo 0; } ?>
                                                                </h5>
                                                                <p class="text-muted mb-0 text-truncate">Casual Leave</p>
                                                            </div>
                                                            <div class="col-3">
                                                                <h5 class="font-size-15"><?php if($EmpsickLeave>0){ echo $EmpsickLeave; }else{ echo 0; } ?></h5>
                                                                <p class="text-muted mb-0 text-truncate">Sick Leave</p>
                                                            </div>
                                                            <div class="col-3">
                                                                <h5 class="font-size-15"><?php if($EmpearnLeave>0){ echo $EmpearnLeave; }else{ echo 0; } ?></h5>
                                                                <p class="text-muted mb-0 text-truncate">Earning Leave</p>
                                                            </div>
                                                            <div class="col-3">
                                                                <h5 class="font-size-15"><?php if($EmpstlLeave>0){ echo $EmpstlLeave; }else{ echo 0; } ?></h5>
                                                                <p class="text-muted mb-0 text-truncate">Short Leave</p>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <?php
                           }
                        }
                        ?>
                        <div class="contentHideShow">
                            <div>
                               <div class="row">
                                <?php
                                if ($employeeRow>5) {
                                $query = $conn->prepare("SELECT id,img,title,full_name,designation From employee where is_active=:is_active order by id desc LIMIT 50 OFFSET 6");
                                $query->bindParam(':is_active',$is_active);
                                $query->execute();
                                $employeeResult = $query->fetchAll();
                                $empTotalRow = count($employeeResult); 
                                foreach ($employeeResult as $value) {
                                        $empID = $value['id'];
                                        $emp_full_name = $value['title']." ".$value['full_name'];
                                        $emp_img = $value['img'];
                                        $emp_full_name = $value['full_name'];
                                        $designation_id = $value['designation'];

                                        $query = $conn->prepare("SELECT designation_name From designation where id = :designation_id");
                                        $query->bindParam(':designation_id',$designation_id);
                                        $query->execute();
                                        $designationResult = $query->fetchAll();
                                        $designationRow = count($designationResult);
                                        if((!empty($designationRow))>0) {
                                            $designationName = $designationResult[0]['designation_name'];
                                        }


                                        $is_approved = "approve";
                                        $leave_year = date('Y');
                                        $leaveTypeID = 1;
                                        $query = $conn->prepare("SELECT id,sum(day_count) sickLeave,leave_type_id,emp_id From employee_leave where leave_type_id = :leave_type_id and emp_id = :emp_id and is_approved = :is_approved and leave_year = :leave_year");
                                        $query->bindParam(':leave_type_id',$leaveTypeID);
                                        $query->bindParam(':emp_id',$empID);
                                        $query->bindParam(':is_approved',$is_approved);
                                        $query->bindParam(':leave_year',$leave_year);
                                        $query->execute();
                                        $employeeLeaveResult = $query->fetchAll();
                                        $EmpsickLeave = $employeeLeaveResult[0]['sickLeave'];

                                        $leaveTypeID = 2;
                                        $query = $conn->prepare("SELECT id,sum(day_count) casualLeave,leave_type_id,emp_id From employee_leave where leave_type_id = :leave_type_id and emp_id = :emp_id and is_approved = :is_approved and leave_year = :leave_year");
                                        $query->bindParam(':leave_type_id',$leaveTypeID);
                                        $query->bindParam(':emp_id',$empID);
                                        $query->bindParam(':is_approved',$is_approved);
                                        $query->bindParam(':leave_year',$leave_year);
                                        $query->execute();
                                        $employeeLeaveResult = $query->fetchAll();
                                        $EmpCasualLeave = $employeeLeaveResult[0]['casualLeave'];


                                        $leaveTypeID = 3;
                                        $query = $conn->prepare("SELECT id,sum(day_count) earnLeave,leave_type_id,emp_id From employee_leave where leave_type_id = :leave_type_id and emp_id = :emp_id and is_approved = :is_approved and leave_year = :leave_year");
                                        $query->bindParam(':leave_type_id',$leaveTypeID);
                                        $query->bindParam(':emp_id',$empID);
                                        $query->bindParam(':is_approved',$is_approved);
                                        $query->bindParam(':leave_year',$leave_year);
                                        $query->execute();
                                        $employeeLeaveResult = $query->fetchAll();
                                        $EmpearnLeave = $employeeLeaveResult[0]['earnLeave'];

                                        $leaveTypeID = 4;
                                        $query = $conn->prepare("SELECT id,sum(day_count) stlLeave,leave_type_id,emp_id From employee_leave where leave_type_id = :leave_type_id and emp_id = :emp_id and is_approved = :is_approved and leave_year = :leave_year and DATE_FORMAT(from_date,'%y-%m') = DATE_FORMAT(NOW(),'%y-%m')");
                                        $query->bindParam(':leave_type_id',$leaveTypeID);
                                        $query->bindParam(':emp_id',$empID);
                                        $query->bindParam(':is_approved',$is_approved);
                                        $query->bindParam(':leave_year',$leave_year);
                                        $query->execute();
                                        $employeeLeaveResult = $query->fetchAll();
                                        $EmpstlLeave = $employeeLeaveResult[0]['stlLeave'];
                                        ?>
                                        <div class="col-xl-4">
                                            <div class="card overflow-hidden">
                                                <a href="employeeDetail.php?emp_id=<?php echo $empID; ?>">
                                                    <div class="bg-primary bg-soft">
                                                        <div class="row">
                                                            <div class="col-5">
                                                                <div class="avatar-md1 profile-user-wid1 mb-2">
                                                                    <?php 
                                                                    if (file_exists("upload/users/".$emp_img)){
                                                                           ?>
                                                                           <img src="upload/users/<?php if(isset($emp_img)){ echo $emp_img; } ?>" class="img-thumbnail rounded-circle ms-2 mt-2" style="margin-top: 0%;width: 80px;height: 80px;object-fit: cover;">
                                                                           <?php 
                                                                        }else{
                                                                            ?>
                                                                            <img src="upload/users/imgPlaceholder.png" class="img-thumbnail rounded-circle ms-2 mt-2" style="margin-top: 0%;width: 80px;height: 80px;object-fit: cover;">
                                                                            <?php
                                                                        }
                                                                    ?>                                                            
                                                                </div>
                                                            </div>
                                                            <div class="col-7 align-self-center">
                                                                <div class="text-primary p-3 pt-2 pb-0">
                                                                    <h5 class="text-primary text-end"><?php if(isset($emp_full_name)){ echo $emp_full_name; } ?></h5>
                                                                    <p class="text-end"><?php if(isset($designationName)){ echo $designationName; } ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="card-body pt-0">
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="row pt-4">
                                                                    <div class="col-3">
                                                                        <h5 class="font-size-15">
                                                                            <?php if($EmpCasualLeave>0){ echo $EmpCasualLeave; }else{ echo 0; } ?>
                                                                        </h5>
                                                                        <p class="text-muted mb-0 text-truncate">Casual Leave</p>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <h5 class="font-size-15"><?php if($EmpsickLeave>0){ echo $EmpsickLeave; }else{ echo 0; } ?></h5>
                                                                        <p class="text-muted mb-0 text-truncate">Sick Leave</p>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <h5 class="font-size-15"><?php if($EmpearnLeave>0){ echo $EmpearnLeave; }else{ echo 0; } ?></h5>
                                                                        <p class="text-muted mb-0 text-truncate">Earning Leave</p>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <h5 class="font-size-15"><?php if($EmpstlLeave>0){ echo $EmpstlLeave; }else{ echo 0; } ?></h5>
                                                                        <p class="text-muted mb-0 text-truncate">Short Leave</p>
                                                                    </div>
                                                                </div> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>

                                        

                                        <?php
                                   }

                                }
                                ?>
                                </div>
                            </div>
                        </div>
                        <a href="#" class="show_hide font13" data-content="toggle-text">Show More... </a>
                        <br>
                        <br>
                   
                    </div>                    
                </div>                
            </div>
            <!-- end row -->

            <div class="row"> 
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Today Present</h4>
                            <div class="table-responsive">
                                <table class="table align-middle table-nowrap mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="align-middle">Sr. No</th>
                                            <th class="align-middle">Emp. Name</th>
                                            <th class="align-middle">Entry Time</th>
                                            <th class="align-middle">Entry Distance</th>
                                            <th class="align-middle">Entry Remark</th>
                                            <th class="align-middle"></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $is_active = "active";
                                        $today_date = date('Y-m-d');
                                        $query = $conn->prepare("SELECT id, employee_id,entry_time,remark,entry_distance from daily_attendance where attendance_date = :attendance_date");
                                        $query->bindParam(':attendance_date',$today_date);
                                        $query->execute();
                                        $empDailyAttResult = $query->fetchAll();
                                        $empDailyAttRow = count($empDailyAttResult);
                                        if ($empDailyAttRow>0) {
                                            $sr_no = 1;
                                          foreach($empDailyAttResult as $value){
                                            $employee_id = $value['employee_id'];
                                            $entry_time = $value['entry_time'];
                                            $entry_distance = $value['entry_distance'];
                                            $remark = $value['remark'];


                                            if (!empty($entry_distance)) {
                                                $entry_distance_string = floatval($value['entry_distance']);
                                                $entry_distance = number_format($entry_distance_string, 2, '.', '');
                                            } 


                                           

                                            $query = $conn->prepare("SELECT id,full_name,title From employee where is_active = :is_active and id = :employee_id order by id desc");
                                            $query->bindParam(':employee_id',$employee_id);
                                            $query->bindParam(':is_active',$is_active);
                                            $query->execute();
                                            $employeeListResult = $query->fetchAll();
                                            $employeeListRow = count($employeeListResult);

                                            if ($employeeListRow) {
                                              $empFullName = $employeeListResult[0]['full_name'];
                                              $empFullName = strtok($empFullName, " ");

                                              ?> 
                                                <tr>
                                                    <td>
                                                        <?php if (!empty($sr_no)) { echo $sr_no; } ?>
                                                    </td>
                                                    <td><?php if(!empty($empFullName)){ echo $empFullName; } ?></td>
                                                    <td><?php if(!empty($entry_time)){ echo $entry_time; } ?></td>

                                                    <td><?php if(!empty($entry_distance)){ echo $entry_distance; } ?></td>

                                                    <td><?php if(!empty($remark)){ echo $remark; } ?></td>
                                                    <td>
                                                        <!-- <a href="#" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light">
                                                            View Details
                                                        </a> -->
                                                        <a href="employeeDetail.php?emp_id=<?php echo $employee_id; ?>"><span class="badge badge-pill badge-soft-primary font-size-14"><i class="far fa-list-alt"></i></span></a>
                                                    </td>
                                                </tr>

                                              <?php
                                            }
                                            $sr_no = $sr_no + 1;
                                          }                                              
                                        }
                                        ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                            <!-- end table-responsive -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Today Leave</h4>
                            <div class="table-responsive">
                                <table class="table align-middle table-nowrap mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="align-middle">Sr. No</th>
                                            <th class="align-middle">Emp. Name</th>
                                            <!-- <th class="align-middle"></th> -->
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $is_approved = "approve";
                                        $today_date = date('Y-m-d');
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
                                            $employeeListResult = $query->fetchAll();
                                            $employeeListRow = count($employeeListResult);
                                            if ($employeeListRow) {
                                              $empFullName = $employeeListResult[0]['full_name'];
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
                                        
                                    </tbody>
                                </table>
                            </div>
                            <!-- end table-responsive -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Today Lunch</h4>
                            <div class="table-responsive">
                                <table class="table align-middle table-nowrap mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="align-middle">Sr. No</th>
                                            <th class="align-middle">Emp. Name</th>
                                            <!-- <th class="align-middle"></th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = $conn->prepare("SELECT DISTINCT employee_id from lunch_taken where lunch_date = :lunch_date");
                                        $query->bindParam(':lunch_date',$today_date);
                                        $query->execute();
                                        $lunchTakenEmpResultSide = $query->fetchAll();
                                        $lunchTakenEmpRowSide = count($lunchTakenEmpResultSide);
                                        if ($lunchTakenEmpRowSide>0) {
                                            $sr_no = 1;
                                            foreach ($lunchTakenEmpResultSide as $value) {
                                            $lunchEmployeeIDSide = $value['employee_id'];
                                            $query = $conn->prepare("SELECT * From employee where id=:lunchEmployeeIDSide");
                                            $query->bindParam(':lunchEmployeeIDSide',$lunchEmployeeIDSide);
                                            $query->execute();
                                            $employeeListLunchResultSide = $query->fetchAll();
                                            $employeeListLunchRowSide = count($employeeListLunchResultSide);
                                            if (isset($employeeListLunchRowSide)) {
                                                if($employeeListLunchRowSide>0){
                                                    $employeeListLunchSideTitle = $employeeListLunchResultSide[0]['title'];
                                                    $employeeListLunchSideName = $employeeListLunchResultSide[0]['full_name'];
                                                    $employeeListLunchSideFullName = $employeeListLunchSideTitle." ".$employeeListLunchSideName;
                                                }
                                            }

                                              ?> 
                                                <tr>
                                                    <td>
                                                        <?php if (!empty($sr_no)) { echo $sr_no; } ?>
                                                    </td>
                                                    <td><?php if(isset($employeeListLunchSideFullName)){ echo $employeeListLunchSideFullName; } ?></td>
                                                    <!-- <td>
                                                        <a href="#" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light">
                                                            View Details
                                                        </a>
                                                    </td> -->
                                                </tr>

                                              <?php
                                              $sr_no = $sr_no + 1;
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
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->


        









<?php
    include 'footer.php';
?>     


<script>
$(document).ready(function () {
    $(".contentHideShow").hide();
    $(".show_hide").on("click", function () {
        var txt = $(".contentHideShow").is(':visible') ? 'Show More...' : 'Show Less';
        $(".show_hide").text(txt);
        $(this).prev('.contentHideShow').slideToggle(200);
    });
});
</script>
