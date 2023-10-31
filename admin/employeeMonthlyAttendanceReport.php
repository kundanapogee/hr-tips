<?php
include 'header.php';

if (empty($_GET['select_monthly_attendance'])) {
     $_SESSION['amsg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <i class="mdi mdi-block-helper me-2"></i>
                                                 Select Month and year.
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>';
    header("location:reportDate.php"); 
    die();
}


$select_monthly_attendance = $_GET['select_monthly_attendance'];


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
                        <h4 class="mb-sm-0 font-size-18">Employee Attendance Report</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                <li class="breadcrumb-item active">Employee Attendance Report</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">   
                <div class="col-lg-12">
                    <div class="card">

                        <?php

                            // echo "<pre>";
                            // print_r($employeeAttenResult);
                            // echo "</pre>";


                        // echo $select_monthly_attendance;
                            $select_monthly_attendance1 = explode("-",$select_monthly_attendance);
                           $select_year = $select_monthly_attendance1[0];
                           $select_month = $select_monthly_attendance1[1];

                        // die();

                        ?>
                        <!-- <div class="card-head">
                            <div class="px-3">
                                <div class="mt-3">
                                   <p class="text-muted mb-2">Search your result according to this fields.</p>
                                   <div class="row">
                                      <div class="col-md-4">
                                         <div class="row">                                            
                                            <div class="col-md-5 text-right">
                                               <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl"><i class="bx bx-plus font-size-16 align-middle me-2"></i> Add Employee</button>

                                              
                                            </div>      
                                         </div>                        
                                      </div>
                                   </div>                                    
                                </div>
                             </div>
                        </div> -->
                        <div class="card-body pt-2">
                            <div class="row"> <input type="button" onclick="exportCSVExcel()" value="Export as Excel" /> </div>
                            <?php
                                $totalDay = cal_days_in_month(CAL_GREGORIAN,$select_month,$select_year);
                            ?>
                            <div class="table-responsive" style="max-height: 550px;overflow: scroll;">
                                <table id="table-product-list" class="table align-middle table-nowrap table-check" >
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Full Name</th>
                                            <?php
                                                for ($i=1; $i <= $totalDay; $i++) { 
                                                    ?>
                                                    <th><?php echo $i; ?></th>
                                                    <?php 
                                                }
                                            ?>
                                            <th></th>
                                        </tr>
                                    </thead>  
                                    <tbody>
                                        <?php 
                                        $mydate = $select_monthly_attendance.'-01';

                                        // die();
                                        $is_active = 'active'; 
                                        $query = $conn->prepare("SELECT da.id,e.id empID,da.employee_id,da.attendance_date,da.entry_time,da.exit_time,e.title,e.full_name, e.is_active From employee e LEFT JOIN daily_attendance da ON e.id = da.employee_id AND DATE(attendance_date)= :mydate where e.is_active = :is_active");

                                        $query->bindParam(':mydate',$mydate);
                                        $query->bindParam(':is_active',$is_active);
                                        $query->execute();
                                        $employeeAttenResult = $query->fetchAll();
                                        $employeeAttenRow = count($employeeAttenResult);                                         

                                        if (isset($employeeAttenRow)) {
                                          if ($employeeAttenRow>0) {
                                            $sr_no = 1;
                                            foreach ($employeeAttenResult as $value) {
                                              $employee_id = $value['empID'];
                                              $attendance_date = $value['attendance_date'];
                                              $empTitle = $value['title'];
                                              $entry_time = $value['entry_time'];
                                              $exit_time = $value['exit_time'];
                                              $empFullName = $value['full_name'];
                                              $completeFullName = $empTitle." ".$empFullName;
                                              ?>
                                              <tr>
                                                <td><?php echo $sr_no; ?></td>
                                                <td><?php echo $completeFullName; ?></td> 
                                              <?php
                                              for($j=1;$j<=$totalDay;$j++){
                                                // echo "<br>";
                                                // $mydate = date('Y-m-').$j;
                                                $mydate = $select_monthly_attendance."-".$j;
                                                // die();
                                                $query = $conn->prepare("SELECT id,employee_id,attendance_date,entry_time,exit_time,total_time,entry_distance,exit_distance From daily_attendance where DATE(attendance_date)= :mydate and employee_id = :employee_id");
                                                $query->bindParam(':mydate',$mydate);
                                                $query->bindParam(':employee_id',$employee_id);
                                                $query->execute();
                                                $employeeAttenResult = $query->fetchAll();
                                                $employeeAttenRow = count($employeeAttenResult);
                                                if (!empty($employeeAttenResult[0]['attendance_date'])) {
                                                    $attendance_date = $employeeAttenResult[0]['attendance_date'];
                                                }else{
                                                    $attendance_date = "---";
                                                }
                                                if (!empty($employeeAttenResult[0]['entry_time'])) {
                                                    $entry_time = $employeeAttenResult[0]['entry_time'];
                                                }else{
                                                    $entry_time = "---";
                                                }
                                                if (!empty($employeeAttenResult[0]['exit_time'])) {
                                                    $exit_time = $employeeAttenResult[0]['exit_time'];
                                                }else{
                                                    $exit_time = "---";
                                                }

                                                if (!empty($employeeAttenResult[0]['total_time'])) {
                                                    $total_time = $employeeAttenResult[0]['total_time'];
                                                }else{
                                                    $total_time = "---";
                                                }
                                                if (!empty($employeeAttenResult[0]['entry_distance'])) {
                                                    $entry_distance_string = floatval($employeeAttenResult[0]['entry_distance']);
                                                    $entry_distance = number_format($entry_distance_string, 2, '.', '');
                                                }else{
                                                    $entry_distance = "---";
                                                }

                                                if (!empty($employeeAttenResult[0]['exit_distance'])) {
                                                    $exit_distance_string = floatval($employeeAttenResult[0]['exit_distance']);
                                                    $exit_distance = number_format($exit_distance_string, 2, '.', '');
                                                }else{
                                                    $exit_distance = "---";
                                                }

                                                if ($j<=$totalDay) {
                                                    ?>                                                
                                                    <td>
                                                        <!-- <p class="mb-0">DT: <?php if (isset($attendance_date)) { echo $attendance_date; } ?></p> -->
                                                        <p class="mb-0">In: <?php if (isset($entry_time)) { echo $entry_time; } ?></p>
                                                        <p class="mb-0">Dis. In: <?php if (isset($entry_distance)) { echo $entry_distance; } ?></p>
                                                        <p class="mb-0">Out: <?php if (isset($exit_time)) { echo $exit_time; } ?></p>
                                                        <p class="mb-0">Dis. Out: <?php if (isset($exit_distance)) { echo $exit_distance; } ?></p>
                                                        <p class="mb-0">TT: <?php if (isset($total_time)) { echo $total_time; } ?></p>
                                                    </td> 
                                                <?php
                                                }else{
                                                    ?>                                                
                                                    <td>
                                                        <p class="mb-0">...</p>
                                                    </td> 
                                                    <?php
                                                }
                                                
                                                }
                                              ?>
                                              </tr>
                                            <?php
                                            $sr_no = $sr_no+1;
                                        }
                                    }
                                }
                                ?>         

                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->




<?php

include 'footer.php';

?> 
<script
    src="https://cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>
<script>
function exportCSVExcel() {
        $('#table-product-list').table2excel({
            exclude: ".no-export",
            filename: "employee_attendance.xls",
            fileext: ".xls",
            exclude_links: true,
            exclude_inputs: true
        });
    }
</script>