<?php

include 'header.php';

$query = $conn->prepare("SELECT * From reimbursement order by id desc");
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
                            <h4 class="mb-sm-0 font-size-18">Reimbursement Add</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                                    <li class="breadcrumb-item active">Reimbursement Add</li>
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
                               <a href="#" data-bs-toggle="modal" data-bs-target="#modeAddEmployeeReimbursement" class="btn font-16 btn-primary" title="Add New Event">Add Reimbursement</a>
                               <?php
                                include 'include/reimbursement/reimbursementAdd.php';
                               ?>
                            </div>
                            
                            <div id="external-events" class="mt-2">
                                <p class="text-muted my-3">Today lunch taken by employee.</p>
                                <?php 
                                $query = $conn->prepare("SELECT DISTINCT employee_id from lunch_taken where lunch_date = :lunch_date");
                                $query->bindParam(':lunch_date',$today_date);
                                $query->execute();
                                $lunchTakenEmpResultSide = $query->fetchAll();
                                $lunchTakenEmpRowSide = count($lunchTakenEmpResultSide);
                                if ($lunchTakenEmpRowSide>0) {
                                   foreach ($lunchTakenEmpResultSide as $value) {
                                        $lunchEmployeeIDSide = $value['employee_id'];

                                        $query = $conn->prepare("SELECT * From employee_list_lunch where id=:lunchEmployeeIDSide");
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
                                        <div class="external-event fc-event bg-success mx-0 px-2 text-white" data-class="bg-success">
                                          <i class="mdi mdi-checkbox-blank-circle font-size-11 me-2"></i>
                                          <?php if(isset($employeeListLunchSideFullName)){ echo $employeeListLunchSideFullName; } ?>
                                        </div>
                                        <?php
                                    }
                                }
                            ?>
                             <!-- <br>
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
                            <div class="mt-1">
                               <!-- <div class="d-flex flex-wrap">
                                  <h5 class="font-size-16 me-3">Recent Reimbursement</h5>
                                  <div class="ms-auto">
                                     <a href="javascript: void(0);" class="fw-medium text-reset">View All</a>
                                  </div>
                               </div> -->
                               <div class="table-responsive mt-2">
                                    <div class="row">
                                        <div class="col-12">                                            
                                            <table id="datatable-buttons" class="table align-middle table-nowrap table-hover mb-0">
                                                <thead>
                                                <tr>
                                                    <th>Sr. No.</th>
                                                    <th>Employee</th>
                                                    <th>Amount</th>
                                                    <th>Is Paid</th>
                                                    <th>Date</th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                if (isset($employeeListLunchRow)) {
                                                  if ($employeeListLunchRow>0) {
                                                    $sr_no = 1;
                                                    foreach ($employeeListLunchResult as $value) {
                                                        $id = $value['id'];
                                                        $emp_id = $value['emp_id'];
                                                        $amount = $value['amount'];
                                                        $subject = $value['subject'];
                                                        $description = $value['description'];
                                                        $is_paid = $value['is_paid'];
                                                        $created_at = $value['created_at'];

                                                        $query = $conn->prepare("SELECT img,title,full_name From employee where id = :emp_id");
                                                        $query->bindParam(':emp_id',$emp_id);
                                                        $query->execute();
                                                        $employeeResult = $query->fetchAll();
                                                        $employeeRow = count($employeeResult);

                                                        if((isset($employeeRow))>0){
                                                          $profileImg = $employeeResult[0]['img'];
                                                          $title = $employeeResult[0]['title'];
                                                          $employeeName = $employeeResult[0]['full_name'];
                                                          $employeeFullName = $title." ".$employeeName;
                                                        }

                                                        $query = $conn->prepare("SELECT id,reimbursement_id,img_file From reimbursement_files where reimbursement_id = :reimbursement_id");
                                                        $query->bindParam(':reimbursement_id',$id);
                                                        $query->execute();
                                                        $reimbursementFileResult = $query->fetchAll();
                                                        $reimbursementFileRow = count($reimbursementFileResult);



                                                    ?>
                                                    <tr>
                                                        <td><?php echo $sr_no; ?></td>
                                                        <td><?php if(isset($employeeFullName)) { echo $employeeFullName; } ?></td>
                                                        <td><i class="fas fa-rupee-sign"></i> <?php if(isset($amount)) { echo $amount; } ?></td>
                                                        <td>
                                                        <?php 
                                                            if(isset($is_paid)) { 
                                                                if ($is_paid=="paid") {
                                                                    ?>
                                                                    <span class="badge badge-pill badge-soft-success font-size-12">Paid</span>
                                                                    <?php
                                                                }else{
                                                                    ?>
                                                                    <span class="badge badge-pill badge-soft-danger font-size-12">Unpaid</span>
                                                                    <?php
                                                                } 
                                                            } 
                                                        ?>  
                                                        </td>
                                                        <td><?php if(isset($created_at)) { echo $created_at; } ?></td> 
                                                        <td>
                                                            <button type="button" class="btn btn-primary far fa-list-alt waves-effect" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg-leaveDetail<?php if(!empty($id)){ echo $id; } ?>"></button>
                                                        </td>
                                                    </tr> 
                                                       
                                                    <?php
                                                    include 'include/reimbursement/reimbursementDetail.php';
                                                    $sr_no = $sr_no + 1;

                                                    }
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
<script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="assets/libs/jszip/jszip.min.js"></script>
<script src="assets/libs/pdfmake/build/pdfmake.min.js"></script>
<script src="assets/libs/pdfmake/build/vfs_fonts.js"></script>
<script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
<script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
<script src="assets/js/pages/datatables.init.js"></script>    

<script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>     

<script src="assets/js/pages/form-validation.init.js"></script>
<script src="assets/libs/parsleyjs/parsley.min.js"></script>


<!-- <script src="assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script> -->


<script>
    $(document).on("click", ".approveLeaveBtn", function(event) {
        let dataValueEmpID = $(this).attr('data-value');
        // alert(dataValueEmpID);
        // let redirectUrl = $(this).attr('data-url');
        event.preventDefault();   
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: !0,
                confirmButtonText: "Yes, paid it!",
                cancelButtonText: "No, cancel!",
                confirmButtonClass: "btn btn-success mt-2",
                cancelButtonClass: "btn btn-danger ms-2 mt-2",
                buttonsStyling: !1
            }).then(function(t) {
                t.value ? approveConfirmation() : '';
                function approveConfirmation(){ 
                    $.ajax({
                    url: "backend/reimbursementPaidConfirmation.php", 
                    type : 'POST',
                    data : {dataValueEmpID:dataValueEmpID},
                    success: function(result){                        
                        const resultObj = JSON.parse(result);
                        var status = resultObj.status;
                        if (status === "true"){
                            Swal.fire(
                              'Good job!',
                              'You clicked the button!',
                              'success'
                            )
                            // $("#paidBtn").Show();
                            // $("#disApproveBtn").hide();
                        }else{
                            Swal.fire(
                              'Kuchh to gadbad hai Daya!',
                              'You clicked the button!',
                              'success'
                            )
                        }
                    }});
                 }
                //  t.dismiss == Swal.DismissReason.cancel && Swal.fire({
                //     title: "Cancelled",
                //     text: "",
                //     icon: "error"
                // })
            })
        }); 
</script>