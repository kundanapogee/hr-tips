<?php

include 'header.php';

$is_active = 'active';
$query = $conn->prepare("SELECT * From employee where is_active=:is_active order by id desc");
$query->bindParam(':is_active',$is_active);
$query->execute();
$employeeResult = $query->fetchAll();
$employeeRow = count($employeeResult);

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
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-head">
                            <div class="px-3">
                                <div class="mt-3">
                                   <!-- <p class="text-muted mb-2">Search your result according to this fields.</p> -->
                                   <div class="row">                                                                
                                      
                                      <div class="col-md-4">
                                         <div class="row">                                            
                                            <div class="col-md-5 text-right">
                                               <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl"><i class="bx bx-plus font-size-16 align-middle me-2"></i> Add Employee</button>

                                               <?php
                                                include 'include/employee/employeeAdd.php';
                                               ?>
                                            </div>      
                                         </div>                        
                                      </div>
                                   </div>                                    
                                </div>
                             </div>
                        </div>
                        <div class="card-body pt-2">
                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table align-middle table-nowrap table-check">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Full Name</th>
                                            <th>Designation</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th>Work Type</th>
                                            <th></th>
                                        </tr>
                                    </thead>  
                                    <tbody>
                                        <?php 
                                        if (isset($employeeRow)) {
                                          if ($employeeRow>0) {
                                            $sr_no = 1;
                                            foreach ($employeeResult as $value) {
                                              $id = $value['id'];
                                              $img = $value['img'];
                                              $title = $value['title'];
                                              $full_name = $value['full_name'];
                                              $complete_name = $title." ".$full_name;
                                              $designation_id = $value['designation'];
                                              $email = $value['email'];
                                              $username = $value['username'];

                                              $mobile_no = $value['mobile_no'];
                                              $emergency_mobile_no = $value['emergency_mobile_no'];
                                              $employee_type_id = $value['employee_type'];
                                              $blood_group = $value['blood_group'];
                                              $address = $value['address'];
                                              $doj = $value['doj'];
                                              $dob = $value['dob'];
                                              $marital_status = $value['marital_status'];
                                              $gender = $value['gender'];
                                              $religion_id = $value['religion'];
                                              $is_active = $value['is_active'];
                                              $work_type_id = $value['work_type'];

                                              $query = $conn->prepare("SELECT designation_name From designation where id = :designation_id");
                                              $query->bindParam(':designation_id',$designation_id);
                                              $query->execute();
                                              $designationResult = $query->fetchAll();
                                              $designationRow = count($designationResult);
                                              if((!empty($designationRow))>0) {
                                                  $designationName = $designationResult[0]['designation_name'];
                                              }

                                              $query = $conn->prepare("SELECT employee_type_name From employee_type where id = :employee_type_id");
                                              $query->bindParam(':employee_type_id',$employee_type_id);
                                              $query->execute();
                                              $employeeTypeResult = $query->fetchAll();
                                              $employeeTypeRow = count($employeeTypeResult);
                                              if((!empty($employeeTypeRow))>0) {
                                                  $employeeTypeName = $employeeTypeResult[0]['employee_type_name'];
                                              }

                                              $query = $conn->prepare("SELECT work_type_name From work_type where id = :work_type_id");
                                              $query->bindParam(':work_type_id',$work_type_id);
                                              $query->execute();
                                              $workTypeResult = $query->fetchAll();
                                              $workTypeRow = count($workTypeResult);
                                              if((!empty($workTypeRow))>0) {
                                                  $workTypeName = $workTypeResult[0]['work_type_name'];
                                              }

                                              $query = $conn->prepare("SELECT religion_name From religion where id = :religion_id");
                                              $query->bindParam(':religion_id',$religion_id);
                                              $query->execute();
                                              $religionResult = $query->fetchAll();
                                              $religionRow = count($religionResult);
                                              if((!empty($religionRow))>0) {
                                                  $religionName = $religionResult[0]['religion_name'];
                                              }

                                              ?>
                                              <tr>
                                                <td><?php echo $sr_no; ?></td>
                                                <td><?php echo $complete_name; ?></td>
                                                <td><?php echo $designationName; ?></td>
                                                <td><?php echo $email; ?></td>
                                                <td><?php echo $mobile_no; ?></td>
                                                <td class="text-capitalize"><?php echo $workTypeName; ?></td>
                                                <td>
                                                    
                                                    <!-- <i class="fas fa-user-slash"></i> -->


                                                    <!-- <a href="#" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg-leaveDetail<?php if(!empty($id)){ echo $id; } ?>" ><span class="badge badge-pill badge-soft-primary font-size-14"><i class="far fa-list-alt"></i></span></a> -->

                                                    <a data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl<?php if(!empty($id)){ echo $id; } ?>" title="Employee Detail"><span class="badge badge-pill badge-soft-primary font-size-14"><i class="far fa-list-alt"></i></span></a>

                                                    <a data-value="<?php if(!empty($id)){ echo $id; } ?>" href="#" class="employeeDeactive" title="Deactivate Employee"><span class="badge badge-pill badge-soft-danger font-size-14"><i class="fas fa-user-slash"></i> </span> </a>

                                                    <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>


                                                    <?php 
                                                    include 'include/employee/employeeListDetail.php';
                                                    ?>
                                                </td>
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



<script src="assets/js/pages/form-validation.init.js"></script>
<script src="assets/libs/parsleyjs/parsley.min.js"></script>



<script>
    $(document).on("click", ".employeeDeactive", function(event) {
        let dataValueEmpID = $(this).attr('data-value');

        // alert(dataValueEmpID);
        // let redirectUrl = $(this).attr('data-url');
        // let redirectUrl = $(this).attr('href');
        // alert(redirectUrl);
        event.preventDefault();   
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: !0,
                confirmButtonText: "Yes, deactivate it!",
                cancelButtonText: "No, cancel!",
                confirmButtonClass: "btn btn-success mt-2",
                cancelButtonClass: "btn btn-danger ms-2 mt-2",
                buttonsStyling: !1
            }).then(function(t) {
                t.value ? employeeDeactivate() : '';
                function employeeDeactivate(){ 
                    $.ajax({
                    url: "backend/employeeDeactivate.php", 
                    type : 'POST',
                    data : {dataValueEmpID:dataValueEmpID},
                    success: function(result){                        
                        const resultObj = JSON.parse(result);
                        var status = resultObj.status;
                        // alert(status);
                        // console.log(resultObj);
                        if (status == "true"){
                            Swal.fire(
                              'Deactivate successfully!',
                              'You clicked the button!',
                              'success'
                            )
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