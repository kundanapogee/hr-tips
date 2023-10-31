<?php

include 'header.php';
// $query = $conn->prepare("SELECT * From employee");
$is_active = 'active';
$query = $conn->prepare("SELECT id,full_name,title,emp_id From employee where is_active = :is_active");
$query->bindParam(':is_active',$is_active);
$query->execute();
$employeeListLunchResult = $query->fetchAll();
$employeeListLunchRow = count($employeeListLunchResult);

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
                            <h4 class="mb-sm-0 font-size-18">Lunch Taken Add</h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                                    <li class="breadcrumb-item active">Lunch Taken Add</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

      
                <div class="row">
                    <div class="col-lg-4">
                      <div class="card">
                         <div class="card-body">
                            <div id="external-events" class="mt-2">
                                <p class="text-muted my-3">Total lunch taken by date.</p>
                                <div class="row">
                                    <?php 
                                    $query = $conn->prepare("SELECT employee_id,lunch_date, COUNT(employee_id) as totalLunch from lunch_taken where MONTH(lunch_date) = 9
                                               and YEAR(lunch_date) = YEAR(now()) GROUP BY lunch_date");
                                        // $query = $conn->prepare("SELECT employee_id,lunch_date, COUNT(employee_id) as totalLunch from lunch_taken where MONTH(lunch_date) = MONTH(now())
                                        //        and YEAR(lunch_date) = YEAR(now()) GROUP BY lunch_date");  
                                        $query->execute();
                                        $lunchTakenByDateResult = $query->fetchAll(); 
                                        $lunchTakenByDateRow = count($lunchTakenByDateResult);
                                        if ($lunchTakenByDateRow>0) {
                                           foreach ($lunchTakenByDateResult as $value) {
                                                $totalLunch = $value['totalLunch'];
                                                $lunch_date = date_format(date_create($value['lunch_date']),"d M");
                                                ?>                                    
                                                <div class="col-md-4 px-2">
                                                  <div style="box-shadow: 2px 2px 6px #ccc;padding: 10px;border-radius: 10px;margin-bottom: 14px;">
                                                      <p class="mb-1 "><strong><?php if(isset($lunch_date)){ echo $lunch_date; } ?></strong></p>
                                                      <p class="mb-0"><strong>Total:</strong> <?php if(isset($totalLunch)){ echo $totalLunch; } ?></p>
                                                  </div>
                                                </div>
                                                <?php
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                         </div>
                      </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">       
                                <div>
                                    <form method='post' action='backend/employeeLunchTakenAdd.php'>
                                    <div class="row">  
                                        <div class="col-sm-4 align-self-end">
                                            <div class="mb-3">
                                                <input type='submit' class="btn btn-primary" value='Update Lunch' name='lunch_updated_btn'>
                                            </div>
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
                                                    <th class="align-middle">Date</th>
                                                    <!-- <th class="align-middle">Action</th> -->
                                                </tr>
                                            </thead>
                                            <tbody id="lunchListByDate">
                                                <?php 
                                                if (isset($employeeListLunchRow)) {
                                                   if ($employeeListLunchRow>0) {
                                                       foreach ($employeeListLunchResult as $value) {
                                                        $employeeID = $value['id'];
                                                        $empLunchEmpID = $value['emp_id'];
                                                        $employeeName = $value['full_name'];

                                                        $query = $conn->prepare("SELECT * from lunch_taken where employee_id = :employeeID and lunch_date = :lunch_date");
                                                        $query->bindParam(':employeeID',$employeeID);
                                                        $query->bindParam(':lunch_date',$today_date);
                                                        $query->execute();
                                                        $lunchTakenEmpResult = $query->fetchAll();
                                                        $lunchTakenEmpRow = count($lunchTakenEmpResult);
                                                        if ($lunchTakenEmpRow>0) {
                                                           foreach ($lunchTakenEmpResult as $value) {
                                                                $lunchEmployeeID = $value['employee_id'];
                                                            }
                                                        }
                                                ?>
                                                <tr>
                                                    <td>
                                                        <div class="form-check font-size-16">
                                                            <input class="form-check-input" name="lunch_taken_id[]" type="checkbox" id="orderidcheck01" value="<?php if(!empty($employeeID)){ echo $employeeID; } ?>"
                                                            <?php 
                                                                if(isset($lunchEmployeeID)){
                                                                    if($lunchEmployeeID==$employeeID){echo "checked"; }
                                                                }
                                                            ?>
                                                            >
                                                            <label class="form-check-label" for="orderidcheck01"></label>
                                                        </div>
                                                    </td>
                                                    <td><a href="javascript: void(0);" class="text-body fw-bold"><?php if(!empty($employeeName)){ echo $employeeName; } ?></a>       
                                                    </td>
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
                                    </form>
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
    function changeDateLunchList(){
        var lunchDate = $("#dateSelect").val();
        $.ajax({
        url: "include/lunch/lunchTakenListByDate.php", 
        type : 'POST',
        data : {lunchDate:lunchDate},
        success: function(result){   
            console.log(result);   
            // $("#lunchListByDate").html();
            $("#lunchListByDate").html(result);
        }});
    }
</script>