<?php

include 'header.php';


$query = $conn->prepare("SELECT * From designation order by id desc");
$query->execute();
$designationResult = $query->fetchAll();
$designationRow = count($designationResult);


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
                        <h4 class="mb-sm-0 font-size-18">Designation List</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                <li class="breadcrumb-item active">Designation List</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#myModalAddDesignation" class="btn btn-primary waves-effect waves-light" title="Add Designation">Add Designation</a>
                            </div>

                            <!-- <h4 class="card-title">Here all list of employee</h4>
                            <p class="card-title-desc">The Buttons extension for DataTables
                                provides a common set of options, API methods and styling to display
                                buttons on a page that will interact with a DataTable. The core library
                                provides the based framework upon which plug-ins can built.
                            </p> -->
                            <div>
                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Designation</th>
                                            <th></th>
                                        </tr>
                                    </thead>  
                                    <tbody>
                                        <?php 
                                        if (isset($designationRow)) {
                                          if ($designationRow>0) {
                                            $sr_no = 1;
                                            foreach ($designationResult as $value) {
                                              $id = $value['id'];
                                              $designationName = $value['designation_name'];
                                              ?>
                                              <tr>
                                                <td><?php echo $sr_no; ?></td>
                                                <td><?php echo $designationName; ?></td>
                                                <td>
                                                    <a class="btn far far fa-edit btn btn-success waves-effect waves-light" title="Edit Record"></a>
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



<div id="myModalAddDesignation" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="custom-validation" action="backend/designationAdd.php" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Designation Add</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">                                       
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="" class="form-label">Designation Name</label>
                                <input type="text" class="form-control" name="designation_name"
                                placeholder="Designation Name" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light" name="submitFormBtn">Submit</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>














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