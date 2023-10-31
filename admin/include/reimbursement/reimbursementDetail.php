

 <!-- <div id="myModalLeaveDetail<?php if(!empty($id)){ echo $id; } ?><?php if(!empty($id)){ echo $id; } ?>" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"> -->
            <div class="modal fade bs-example-modal-lg-leaveDetail<?php if(!empty($id)){ echo $id; } ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
               <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                     <form class="custom-validation" action="backend/employeeLeaveAdd.php" method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                           <h5 class="modal-title" id="myModalLabel">Reimbursement Detail</h5>
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
                                            <div>
                                                <p class="mb-1"><strong>User Name:</strong></p>
                                                <p><?php if (isset($username)) { echo $username; } ?></p>
                                            </div>   
                                            <div class="d-flex flex-wrap">
                                                <?php
                                                    if(isset($reimbursementFileRow)) {
                                                        if ($reimbursementFileRow>0) {
                                                           foreach ($reimbursementFileResult as $value) {
                                                            $attached_file = $value['img_file'];
                                                            $extaintion = pathinfo($attached_file, PATHINFO_EXTENSION);
                                                            if ($extaintion=='pdf') {
                                                                ?>
                                                                <div class="border" style="width:100px;margin-bottom: 15px;text-align: center;">
                                                                    <iframe class="mb-1"
                                                                    src="<?php echo "upload/reimbursement/".$attached_file;?>#toolbar=0&navpanes=0&scrollbar=0"
                                                                    frameBorder="0"
                                                                    scrolling="auto"
                                                                    height="116"
                                                                    width="100"
                                                                    ></iframe>   
                                                                    <a href="<?php echo "upload/reimbursement/".$attached_file;?>" class="btn btn-primary px-1 py-1 font-size-12" download="">Download <i class="bx bx-download align-baseline ms-1"></i></a>
                                                                </div>                                    
                                                                <?php
                                                            }else{
                                                                ?>
                                                                <div style="width:100px;margin-bottom: 15px;text-align: center;">
                                                                    <img class="img-thumbnail border mb-1" src="<?php echo "upload/reimbursement/".$attached_file;?>" style="width: 100px;height: 122px;object-fit: cover;margin-right:10px;">
                                                                     <a href="<?php echo "upload/reimbursement/".$attached_file;?>" class="btn btn-primary px-1 py-1 font-size-12" download="">Download <i class="bx bx-download align-baseline ms-1"></i></a>
                                                                </div>
                                                                <?php
                                                            }
                                                           }
                                                        }
                                                    }
                                                ?>                                                
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="row mt-4">                      
                                        <div class="col-md-6">
                                            <div>
                                                <p class="mb-1"><strong>Subject:</strong></p>
                                                <p><?php if (isset($subject)) { echo $subject; } ?></p>
                                            </div>
                                        </div>
                                        <div class="col-md-3 ">
                                            <div>
                                                <p class="mb-1"><strong>Amount:</strong></p>
                                                <p><i class="fas fa-rupee-sign"></i> 
                                                    <?php if (isset($amount)) { echo $amount; } ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-3 ">
                                            <div>
                                                <p class="mb-1"><strong>Created Date:</strong></p>
                                                <p><?php if (isset($created_at)) { echo $created_at; } ?></p>
                                            </div>
                                        </div>
                                        <div class="col-md-12 ">
                                            <div>
                                                <p class="mb-1"><strong>Description:</strong></p>
                                                <p><?php if (isset($description)) { echo $description; } ?></p>
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
                                        // if ($is_paid=="pending") {
                                            ?>
                                            <!-- <button type="button" class="btn btn-danger waves-effect waves-light disApproveLeaveBtn" data-value="<?php echo $id; ?>" id="disApproveBtn">Unpaid</button> -->
                                            <?php
                                        // }
                                    ?>
                                </div>
                                <div class="col-md-6" style="text-align: right;">
                                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                                    <?php
                                        if (isset($is_paid)) {
                                            if ($is_paid=="paid") {
                                                ?>
                                                <button type="button" class="btn btn-light waves-effect waves-light" data-value="<?php echo $id; ?>" id="paidBtn">Already Paid</button>
                                                <?php
                                            }else{
                                                ?>
                                                <button type="button" class="btn btn-success waves-effect waves-light approveLeaveBtn" data-value="<?php echo $id; ?>" data-value="<?php echo $id; ?>">Paid</button>
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