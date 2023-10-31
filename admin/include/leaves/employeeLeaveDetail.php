 <!-- <div id="myModalLeaveDetail<?php if(!empty($id)){ echo $id; } ?><?php if(!empty($id)){ echo $id; } ?>" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"> -->
            <div class="modal fade bs-example-modal-lg-leaveDetail<?php if(!empty($id)){ echo $id; } ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
               <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                     <form class="custom-validation" action="backend/employeeLeaveAdd.php" method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                           <h5 class="modal-title" id="myModalLabel">Employee Leave Detail</h5>
                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="employeeProfileDetail">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <img class="profilePic" src="upload/users/<?php echo $profileImg; ?>">
                                        </div>
                                        <div class="col-md-9">
                                            <div>
                                                <p class="mb-1"><strong>Employee Name:</strong></p>
                                                <p><?php if(isset($employeeFullName)) { echo $employeeFullName; } ?></p>
                                            </div>
                                            <!-- <div>
                                                <p class="mb-1"><strong>User Name:</strong></p>
                                                <p><?php if (isset($username)) { echo $username; } ?></p>
                                            </div>  -->                           
                                            <div>
                                                <?php
                                                if (isset($is_approved)) { 
                                                    if($is_approved=='approve'){ 
                                                        ?>
                                                         <p class="badge text-capitalize rounded-pill text-bg-success font14"><i><?php if (isset($is_approved)) { echo $is_approved; } ?></i></p>
                                                        <?php
                                                    }elseif($is_approved=='disapprove'){
                                                        ?>
                                                         <p class="badge text-capitalize rounded-pill text-bg-danger font14"><i><?php if (isset($is_approved)) { echo $is_approved; } ?></i></p>
                                                        <?php
                                                    }else{
                                                        ?>
                                                         <p class="badge text-capitalize rounded-pill text-bg-warning font14"><i><?php if (isset($is_approved)) { echo $is_approved; } ?></i></p>
                                                        <?php
                                                    }
                                                }

                                                ?>
                                            </div>
                                            <div>
                                                <?php
                                                    if(!empty($attached_file)) {
                                                        ?>

                                                <a href="<?php echo "upload/leaveAttachment/".$attached_file?>" class="btn btn-primary" download>Download <i class="bx bx-download align-baseline ms-1"></i></a>
                                                        <?php
                                                    }
                                                ?>                                                
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="row mt-4">                      
                                        <div class="col-md-3 ">
                                            <div>
                                                <p class="mb-1"><strong>From Date:</strong></p>
                                                <p><?php if (isset($from_date)) { echo $from_date; } ?></p>
                                            </div>
                                        </div>
                                        <div class="col-md-3 ">
                                            <div>
                                                <p class="mb-1"><strong>To Date:</strong></p>
                                                <p><?php if (isset($to_date)) { echo $to_date; } ?></p>
                                            </div>
                                        </div>
                                        <div class="col-md-3 ">
                                            <div>
                                                <p class="mb-1"><strong>Leave Type:</strong></p>
                                                <p><?php if (isset($leaveTypeName)) { echo $leaveTypeName; } ?></p>
                                            </div>
                                        </div>
                                        <div class="col-md-3 ">
                                            <div>
                                                <p class="mb-1"><strong>Day Type:</strong></p>
                                                <p class="text-capitalize"><?php if (isset($day_type)) { echo $day_type; } ?></p>
                                            </div>
                                        </div>


                                        <div class="col-md-12 ">
                                            <div>
                                                <p class="mb-1"><strong>Reason:</strong></p>
                                                <p><?php if (isset($reason)) { echo $reason; } ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              </div>
                           </div>
                        </div>
                        <div class="modal-footer" style="justify-content: start;">
                            <div class="row w-100">
                                <div class="col-md-6">
                                    <?php
                                        if ($is_approved=="pending") {
                                            ?>
                                            <!-- <button type="button" class="btn btn-light waves-effect waves-light" data-value="<?php echo $id; ?>">Disapproved</button> -->

                                            <button type="button" class="btn btn-danger waves-effect waves-light disApproveLeaveBtn" data-value="<?php echo $id; ?>" id="disApproveBtn">Disapprove</button>

                                            <?php
                                        }
                                    ?>
                                </div>
                                <div class="col-md-6" style="text-align: right;">
                                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                                    <?php
                                        if (isset($is_approved)) {
                                            if ($is_approved=="approve") {
                                                ?>
                                                <button type="button" class="btn btn-light waves-effect waves-light" data-value="<?php echo $id; ?>" id="approvedBtn">Approved</button>
                                                <?php
                                            }elseif ($is_approved=="disapprove") {
                                                ?>
                                                <button type="button" class="btn btn-light waves-effect waves-light" data-value="<?php echo $id; ?>">Disapproved</button>
                                                <?php
                                            }else{
                                                ?>
                                                <button type="button" class="btn btn-success waves-effect waves-light approveLeaveBtn" data-value="<?php echo $id; ?>" id="approveBtn">Approve</button>
                                                <?php
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>