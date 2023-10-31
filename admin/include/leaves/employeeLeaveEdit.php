<div  class="modal fade myModalEditLeave<?php if(!empty($id)){ echo $id; } ?>" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
               <div class="modal-dialog">
                  <div class="modal-content">
                     <form class="custom-validation" action="backend/employeeLeaveEdit.php" method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                           <h5 class="modal-title" id="myModalLabel">Employee Leave Edit</h5>
                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                           <div class="row">
                              <div class="col-md-12">                                 
                                 <div class="row">
                                     
                                    <div class="col-md-12 d-none">
                                       <div class="mb-3">
                                          <label for="" class="form-label">Employee Leave ID</label>
                                          <input type="text" class="form-control" name="emp_leave_id"
                                          placeholder="Employee Leave ID" value="<?php if(isset($id)){ echo $id; } ?>"   required>
                                             <!-- min="<?php // echo date('Y-m-d'); ?>" -->
                                       </div>
                                    </div>
                                    <div class="col-md-12">
                                       <h5 class="text-success"><?php if(isset($employeeFullName)) { echo $employeeFullName; } ?></h5>
                                    </div>                                   
                                    <!-- <div class="col-md-6">
                                       <div class="mb-3">
                                          <label for="" class="form-label">Employee Name</label>
                                          <select class="form-control form-select" name="emp_id" required>
                                             <option selected disabled> --Select-- </option>
                                             <?php
                                                if(isset($employeeRowMain)){
                                                    if ($employeeRowMain>0) {
                                                       foreach ($employeeResultMain as $value) {
                                                        $employee_id = $value['id'];
                                                        $title = $value['title'];
                                                        $employee_name = $value['full_name'];
                                                        $empFullName = $title." ".$employee_name;
                                                        ?>
                                                         <option value="<?php if(!empty($employee_id)){ echo $employee_id; } ?>"  <?php if($employee_id==$emp_id){ echo "selected"; } ?>  >
                                                            <?php if(!empty($empFullName)){ echo $empFullName; } ?>
                                                         </option>
                                                         <?php
                                                        }
                                                    }
                                                }
                                                ?>
                                           </select>
                                       </div>
                                    </div> -->
                                    <div class="col-md-12">
                                       <div class="mb-3">
                                          <label for="" class="form-label">Leave Type</label>
                                          <select class="form-control form-select" name="leave_type_id" required onchange="getLeaveID(this.value)">
                                            <option  selected disabled> --Select-- </option>
                                            <?php
                                                if(isset($leaveTypeRowMain)){
                                                    if ($leaveTypeRowMain>0) {
                                                       foreach ($leaveTypeResultMain as $value) {
                                                        $leaveTypeID = $value['id'];
                                                        $leave_type_name = $value['leave_type_name'];
                                                        ?>
                                                         <option value="<?php if(!empty($leaveTypeID)){ echo $leaveTypeID; } ?>" <?php if($leaveTypeID==$leave_type_id){ echo "selected"; } ?> >
                                                            <?php if(!empty($leave_type_name)){ echo $leave_type_name; } ?>
                                                         </option>
                                                        <?php
                                                        }
                                                    }
                                                }
                                            ?>
                                          </select>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-md-6">
                                       <div class="mb-3">
                                          <label for="" class="form-label">From Date</label>
                                          <input type="date" class="form-control" name="from_date"
                                             placeholder="Start Date" value="<?php if(isset($from_date)){ echo $from_date; } ?>"   required>
                                             <!-- min="<?php // echo date('Y-m-d'); ?>" -->
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="mb-3">
                                          <label for="" class="form-label">To Date</label>
                                          <input type="date" class="form-control" name="to_date"
                                             placeholder="End Date" value="<?php if(isset($from_date)){ echo $from_date; } ?>" required>
                                             <!-- min="<?php // echo date('Y-m-d'); ?>" -->
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row" id="dayTypeDiv">
                                     <div class="col-md-6">
                                        <div class="mb-3">
                                          <label for="" class="form-label">Day Type</label>
                                          <select class="form-control form-select" name="day_type" required>
                                            <option  selected disabled> --Select-- </option>
                                            <option value="full" <?php if($day_type=='full'){ echo "selected"; }?> > Full </option>
                                            <option value="half" <?php if($day_type=='half'){ echo "selected"; }?> > Half </option>
                                          </select>                                           
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-6">
                                       <div class="mb-3">
                                          <label for="" class="form-label">Attached File</label>
                                          <input type="file" class="form-control" name="attachedFile"
                                             placeholder="Employee ID">
                                       </div>
                                    </div> -->
                                </div>
                                 <div class="mb-3">
                                    <label for="" class="form-label">Reason</label>
                                    <textarea class="form-control" name="reason" rows="4" required><?php if(isset($reason)){ echo $reason; } ?></textarea>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="modal-footer">
                           <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                           <button type="submit" class="btn btn-primary waves-effect waves-light" name="submitFormBtn">Submit</button>
                        </div>
                     </form>
                  </div>
                  <!-- /.modal-content -->
               </div>
               <!-- /.modal-dialog -->
            </div>







