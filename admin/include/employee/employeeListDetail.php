<div class="modal fade bs-example-modal-xl<?php if(!empty($id)){ echo $id; } ?>" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myExtraLargeModalLabel">Employee Detail</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="employeeProfileDetail">
                    <div class="row">
                        <div class="col-md-2 col-md-2">
                            <img class="profilePic" src="upload/users/<?php echo $img; ?>">
                        </div>
                        <div class="col-md-6 col-md-6">
                            <div class="headingText">
                                <h2><?php if (isset($complete_name)) { echo $complete_name; } ?></h2>  
                                <h4 class=""><?php if (isset($username)) { echo $username; } ?></h4>

                                <?php
                                if (isset($is_active)) { 
                                    if($is_active=='active'){ 
                                        ?>
                                         <p class="badge rounded-pill text-bg-success mt-2 font14"><i><?php if (isset($is_active)) { echo $is_active; } ?></i></p>
                                        <?php
                                    }else{
                                        ?>
                                         <p class="badge rounded-pill text-bg-danger mt-2 font14"><i><?php if (isset($is_active)) { echo $is_active; } ?></i></p>
                                        <?php
                                    }
                                }

                                ?>
                               
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">                      
                        <div class="col-md-3 ">
                            <div>
                                <p class="mb-1"><strong>Mobile No:</strong></p>
                                <p><?php if (isset($mobile_no)) { echo $mobile_no; } ?></p>
                            </div>
                        </div>
                        <div class="col-md-3 ">
                            <div>
                                <p class="mb-1"><strong>Email:</strong></p>
                                <p><?php if (isset($email)) { echo $email; } ?></p>
                            </div>
                        </div>
                        <div class="col-md-3 ">
                            <div>
                                <p class="mb-1"><strong>Emergency Mobile No:</strong></p>
                                <p><?php if (isset($emergency_mobile_no)) { echo $emergency_mobile_no; } ?></p>
                            </div>
                        </div>
                        <div class="col-md-3 ">
                            <div>
                                <p class="mb-1"><strong>Employee Type:</strong></p>
                                <p><?php if (isset($employeeTypeName)) { echo $employeeTypeName; } ?></p>
                            </div>
                        </div>
                        <div class="col-md-3 ">
                            <div>
                                <p class="mb-1"><strong>Blood Group:</strong></p>
                                <p><?php if (isset($blood_group)) { echo $blood_group; } ?></p>
                            </div>
                        </div>
                        <div class="col-md-3 ">
                            <div>
                                <p class="mb-1"><strong>Address:</strong></p>
                                <p><?php if (isset($address)) { echo $address; } ?></p>
                            </div>
                        </div>
                        <div class="col-md-3 ">
                            <div>
                                <p class="mb-1"><strong>Date of Joining:</strong></p>
                                <p><?php if (isset($doj)) { echo $doj; } ?></p>
                            </div>
                        </div>
                        <div class="col-md-3 ">
                            <div>
                                <p class="mb-1"><strong>Date of Birth:</strong></p>
                                <p><?php if (isset($dob)) { echo $dob; } ?></p>
                            </div>
                        </div>
                        <div class="col-md-3 ">
                            <div>
                                <p class="mb-1"><strong>Marital Status:</strong></p>
                                <p class="text-capitalize"><?php if (isset($marital_status)) { echo $marital_status; } ?></p>
                            </div>
                        </div>
                        <div class="col-md-3 ">
                            <div>
                                <p class="mb-1"><strong>Gender:</strong></p>
                                <p class="text-capitalize"><?php if (isset($gender)) { echo $gender; } ?></p>
                            </div>
                        </div>
                        <div class="col-md-3 ">
                            <div>
                                <p class="mb-1"><strong>Religion:</strong></p>
                                <p><?php if (isset($religionName)) { echo $religionName; } ?></p>
                            </div>
                        </div>
                        <div class="col-md-3 ">
                            <div>
                                <p class="mb-1"><strong>Work Type:</strong></p>
                                <p><?php if (isset($workTypeName)) { echo $workTypeName; } ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>