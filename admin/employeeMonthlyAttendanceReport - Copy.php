<?php

include 'header.php';

// $is_active = 'active';
// $query = $conn->prepare("SELECT id,title,full_name From employee where is_active=:is_active order by id desc");
// $query->bindParam(':is_active',$is_active);
// $query->execute();
// $employeeResult = $query->fetchAll();
// $employeeRow = count($employeeResult);








 // $is_active = "active";
 //  $today_date = date('Y-m-d');
 //  $query = $conn->prepare("");
 //  $query->bindParam(':is_active',$is_active);
 //  $query->execute();
 //  $empBirthDayListResult = $query->fetchAll();
 //  $empBirthDayListRow = count($empBirthDayListResult);





// $query = $conn->prepare("SELECT * From religion ");
// $query->execute();
// $religionResult = $query->fetchAll();
// $religionRow = count($religionResult);

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
                                $totalDay = cal_days_in_month(CAL_GREGORIAN,8,2023);
                            ?>
                            <div class="table-responsive" >
                                <table id="table-product-list" class="table align-middle table-nowrap table-check">
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
                                        $mydate = '2023-08-01';
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
                                                $mydate = date('Y-m-').$j;
                                                $query = $conn->prepare("SELECT id,employee_id,attendance_date,entry_time,exit_time From daily_attendance where DATE(attendance_date)= :mydate and employee_id = :employee_id");
                                                $query->bindParam(':mydate',$mydate);
                                                $query->bindParam(':employee_id',$employee_id);
                                                $query->execute();
                                                $employeeAttenResult = $query->fetchAll();
                                                $employeeAttenRow = count($employeeAttenResult);
                                                if (!empty($employeeAttenResult[0]['attendance_date'])) {
                                                    $attendance_date = $employeeAttenResult[0]['attendance_date'];
                                                }else{
                                                    $attendance_date = "--";
                                                }
                                                if (!empty($employeeAttenResult[0]['entry_time'])) {
                                                    $entry_time = $employeeAttenResult[0]['entry_time'];
                                                }else{
                                                    $entry_time = "--";
                                                }
                                                if (!empty($employeeAttenResult[0]['exit_time'])) {
                                                    $exit_time = $employeeAttenResult[0]['exit_time'];
                                                }else{
                                                    $exit_time = "--";
                                                }
                                                if ($j<=date('d')) {
                                                    ?>                                                
                                                    <td>
                                                        <!-- <p class="mb-0">DT: <?php if (isset($attendance_date)) { echo $attendance_date; } ?></p> -->
                                                        <p class="mb-0">IN: <?php if (isset($entry_time)) { echo $entry_time; } ?></p>
                                                        <p class="mb-0">OUT: <?php if (isset($exit_time)) { echo $exit_time; } ?></p>
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
            filename: "download.xls",
            fileext: ".xls",
            exclude_links: true,
            exclude_inputs: true
        });
    }
</script>