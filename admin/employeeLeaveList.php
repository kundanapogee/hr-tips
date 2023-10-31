<?php
   include 'header.php';
   
   $is_active = 'active';
   $query = $conn->prepare("SELECT id,title,full_name,is_active From employee where is_active = :is_active");
   $query->bindParam(':is_active',$is_active);
   $query->execute();
   $employeeResultMain = $query->fetchAll();
   $employeeRowMain = count($employeeResultMain);
   
   $query = $conn->prepare("SELECT id,leave_type_name From leave_type ");
   $query->execute();
   $leaveTypeResultMain = $query->fetchAll();
   $leaveTypeRowMain = count($leaveTypeResultMain);

   $query = $conn->prepare("SELECT * From employee_leave order by id desc");
   $query->execute();
   $employeeLeaveResult = $query->fetchAll();
   $employeeLeaveRow = count($employeeLeaveResult);
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
               <h4 class="mb-sm-0 font-size-18">Employee Leave List</h4>
               <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                     <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                     <li class="breadcrumb-item active">Employee Leave List</li>
                  </ol>
               </div>
            </div>
         </div>
      </div>
      <!-- end page title -->
      <div class="row">
         <div class="col-12">
            <div class="row">
               <div class="col-lg-3">
                  <div class="card">
                     <div class="card-body">
                        <div class="d-grid">
                           <!-- <button class="btn font-16 btn-primary" id="myModalAddEvent"><i class="mdi mdi-plus-circle-outline"></i> Create New Event</button> -->
                           <a href="#" data-bs-toggle="modal" data-bs-target="#myModalAddLeave" class="btn font-16 btn-primary" title="Add New Leave">Add New Leave </a>

                           <?php
                            include 'include/leaves/employeeLeaveAdd.php';
                            include 'include/leaves/employeeLeaveTakenList.php';
                           ?>
                        </div>  
                     </div>
                  </div>
               </div>
               <!-- end col-->

               <div class="col-lg-9">
                  <div class="card">
                     <div class="card-body">
                        <div class="mt-1">
                           <div class="d-flex flex-wrap">
                              <h5 class="font-size-16 me-3">Recent Leave</h5>
                              <div class="ms-auto">
                                 <a href="javascript: void(0);" class="fw-medium text-reset">View All</a>
                              </div>
                           </div>
                           <div class="table-responsive mt-2">
                                <div class="row">
                                    <div class="col-12">                                            
                                        <table id="datatable-buttons" class="table align-middle table-nowrap table-hover mb-0" data-page-length='20'>
                                            <thead>
                                            <tr>
                                                <th>Sr. No.</th>
                                                <th>Emp. Name</th>
                                                <th>From Date</th>
                                                <th>Day</th>
                                                <th>Type</th>
                                                <th>Status</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            if (isset($employeeLeaveRow)) {
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
                                                    $day_count = $value['day_count'];
                                                    $reason = $value['reason'];


                                                    $query = $conn->prepare("SELECT img,title,full_name,username From employee where id = :emp_id");
                                                    $query->bindParam(':emp_id',$emp_id);
                                                    $query->execute();
                                                    $employeeResult = $query->fetchAll();
                                                    $employeeRow = count($employeeResult);
                                                    if((isset($employeeRow))>0){
                                                      $profileImg = $employeeResult[0]['img'];
                                                      $username = $employeeResult[0]['username'];
                                                      $title = $employeeResult[0]['title'];
                                                      $employeeName = $employeeResult[0]['full_name'];
                                                      $employeeFullName = $title." ".$employeeName;
                                                    }

                                                    $query = $conn->prepare("SELECT * From leave_type where id = :leave_type_id");
                                                    $query->bindParam(':leave_type_id',$leave_type_id);
                                                    $query->execute();
                                                    $leaveTypeResult = $query->fetchAll();
                                                    $leaveTypeRow = count($leaveTypeResult);
                                                    if((isset($leaveTypeRow))>0) {
                                                      $leaveTypeName = $leaveTypeResult[0]['leave_type_name'];
                                                      $leaveTypeShortName = $leaveTypeResult[0]['short_name'];
                                                    }


                                                ?>
                                                <tr>
                                                    <td><?php echo $sr_no; ?></td>
                                                    <td><?php if(isset($employeeFullName)) { echo $employeeFullName; } ?></td>
                                                    <td><?php if(isset($from_date)) { echo $from_date; } ?></td>
                                                    <!-- <td><?php if(isset($to_date)) { echo $to_date; } ?></td> -->
                                                    <!-- <td><?php if(isset($leaveTypeName)) { echo $leaveTypeName; } ?></td> -->
                                                    <td class="text-capitalize"><?php if(isset($day_type)) { echo $day_type." "; } ?> </td>
                                                    <td><?php if(isset($leaveTypeShortName)) { echo $leaveTypeShortName; } ?></td>

                                                    <td>
                                                        <?php 
                                                        if(isset($employeeName)) { 
                                                            if ($is_approved=="approve") {
                                                                ?>
                                                                <span class="badge badge-pill badge-soft-success font-size-12">Approved</span>
                                                                <?php
                                                            }elseif ($is_approved=="disapprove") {
                                                                ?>
                                                                <span class="badge badge-pill badge-soft-danger font-size-12">Disapproved</span>
                                                                <?php
                                                            }else{
                                                                ?>
                                                                <span class="badge badge-pill badge-soft-warning font-size-12">Pending</span>
                                                                <?php
                                                            } 
                                                        } 
                                                        ?>  
                                                    </td>                                                            
                                                    <td>
                                                        <!-- <a href="#" data-bs-toggle="modal" data-bs-target="#myModalEditLeave<?php if(!empty($id)){ echo $id; } ?>" class="badge badge-pill badge-soft-success font-size-14">
                                                            <i class="fas fa-edit"></i>
                                                        </a> -->

                                                        <a href="#" data-bs-toggle="modal" data-bs-target=".myModalEditLeave<?php if(!empty($id)){ echo $id; } ?>" title="Add New Leave"><span class="badge badge-pill badge-soft-success font-size-14"><i class="fas fa-edit"></i> </span> </a>

                                                        <?php
                                                          include 'include/leaves/employeeLeaveEdit.php';
                                                        ?>
                                                        <a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg-leaveDetail<?php if(!empty($id)){ echo $id; } ?>" ><span class="badge badge-pill badge-soft-primary font-size-14"><i class="far fa-list-alt"></i></span></a>
                                                    </td>
                                                </tr>
                                                
                                                   
                                                <?php

                                                include 'include/leaves/employeeLeaveDetail.php';
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

               <!-- end col -->
            </div>


            <div style='clear:both'></div>

         </div>
      </div>
   </div>
   <!-- container-fluid -->
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
    $(document).on("click", ".approveLeaveBtn", function(event) {
        let dataValueEmpID = $(this).attr('data-value');
        let redirectUrl = $(this).attr('data-url');
        event.preventDefault();   
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: !0,
                confirmButtonText: "Yes, approve it!",
                cancelButtonText: "No, cancel!",
                confirmButtonClass: "btn btn-success mt-2",
                cancelButtonClass: "btn btn-danger ms-2 mt-2",
                buttonsStyling: !1
            }).then(function(t) {
                t.value ? approveConfirmation() : '';
                function approveConfirmation(){ 
                    $.ajax({
                    url: "backend/LeaveApprovedConfirmation.php", 
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
                            $("#approveBtn").hide();
                            $("#disApproveBtn").hide();
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





<script>
    $(document).on("click", ".disApproveLeaveBtn", function(event) {
        let dataValueEmpID = $(this).attr('data-value');
        let redirectUrl = $(this).attr('data-url');
        event.preventDefault();   
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: !0,
                confirmButtonText: "Yes, disapprove it!",
                cancelButtonText: "No, cancel!",
                confirmButtonClass: "btn btn-success mt-2",
                cancelButtonClass: "btn btn-danger ms-2 mt-2",
                buttonsStyling: !1
            }).then(function(t) {
                t.value ? disApproveConfirmation() : '';
                function disApproveConfirmation(){ 
                    $.ajax({
                    url: "backend/LeaveDisapprovedConfirmation.php", 
                    type : 'POST',
                    data : {dataValueEmpID:dataValueEmpID},
                    success: function(result){                        
                        const resultObj = JSON.parse(result);
                        var status = resultObj.status;
                        if (status === "true"){
                            Swal.fire(
                              'Ye Achha Baat Nhi hai!',
                              'You clicked the button!',
                              'success'
                            )
                            $("#approveBtn").hide();
                            $("#disApproveBtn").hide();
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