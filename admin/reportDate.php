<?php

include 'header.php';

$is_active = 'active';
$query = $conn->prepare("SELECT * From employee where is_active=:is_active order by id desc");
$query->bindParam(':is_active',$is_active);
$query->execute();
$employeeResult = $query->fetchAll();
$employeeRow = count($employeeResult);

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
                        <h4 class="mb-sm-0 font-size-18">Employee List</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                <li class="breadcrumb-item active">Employee List</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">   
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-head p-3 pb-0"> 
                            <p>All employee monthly report.</p>
                        </div>
                        <div class="card-body pt-0">
                            <form action="employeeMonthlyAttendanceReport.php" method="get">
                              <div class="mb-3 mt-3">
                                <label for="email" class="form-label">Select Month:</label>
                                <input type="month" class="form-control" placeholder="Enter email" name="select_monthly_attendance">
                              </div>
                              <button type="submit" class="btn btn-primary w-100">Submit</button>
                            </form>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div> <!-- container-fluid -->
    </div>
</div>
<!-- End Page-content -->




<?php

include 'footer.php';

?> 


<script src="assets/js/pages/form-validation.init.js"></script>
<script src="assets/libs/parsleyjs/parsley.min.js"></script>


