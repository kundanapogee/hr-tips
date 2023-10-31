<div id="myModalAddLeave" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
               <div class="modal-dialog">
                  <div class="modal-content">
                     <form class="custom-validation" action="backend/employeeLeaveAdd.php" method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                           <h5 class="modal-title" id="myModalLabel">Employee Leave Add</h5>
                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="row">
                                    <div class="col-md-6">
                                       <div class="mb-3">
                                          <label for="" class="form-label">Employee Name</label>
                                          <select class="form-control form-select" name="emp_id" required>
                                             <option selected disabled> --Select-- </option>
                                             <?php
                                             // echo $employeeRow;
                                                if(isset($employeeRowMain)){
                                                    if ($employeeRowMain>0) {
                                                       foreach ($employeeResultMain as $value) {
                                                        $employee_id = $value['id'];
                                                        $title = $value['title'];
                                                        $employee_name = $value['full_name'];
                                                        $empFullName = $title." ".$employee_name;
                                                        ?>
                                                         <option value="<?php if(!empty($employee_id)){ echo $employee_id; } ?>" >
                                                            <?php if(!empty($empFullName)){ echo $empFullName; } ?>
                                                         </option>
                                                         <?php
                                                        }
                                                    }
                                                }
                                                ?>
                                           </select>
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="mb-3">
                                          <label for="" class="form-label">Leave Type</label>
                                          <select class="form-control form-select" name="leave_type_id" required>
                                            <option  selected disabled> --Select-- </option>
                                            <?php
                                                if(isset($leaveTypeRowMain)){
                                                    if ($leaveTypeRowMain>0) {
                                                       foreach ($leaveTypeResultMain as $value) {
                                                        $leave_type_id = $value['id'];
                                                        $leave_type_name = $value['leave_type_name'];
                                                        ?>
                                                         <option value="<?php if(!empty($leave_type_id)){ echo $leave_type_id; } ?>" >
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
                                             placeholder="Start Date"   required>
                                             <!-- min="<?php // echo date('Y-m-d'); ?>" -->
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="mb-3">
                                          <label for="" class="form-label">To Date</label>
                                          <input type="date" class="form-control" name="to_date"
                                             placeholder="End Date"  required>
                                             <!-- min="<?php // echo date('Y-m-d'); ?>" -->
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                     <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Day Type</label>
                                            <!-- <select class="form-control form-select" name="day_type" required>
                                                <option  selected disabled> --Select-- </option>
                                                <option value="half"> Half</option>
                                                <option value="full"> Full</option>                                            
                                            </select> -->
                                            <div class="leaveRadio mb-1">                                              
                                              <input type="radio" name="day_type" value="full" id="radio-2" class="radio-button" required checked />
                                              <label for="radio-2" class="radio-button-click-target">
                                                <span class="radio-button-circle"></span>Full
                                              </label>
                                              <input type="radio" name="day_type" value="half" id="radio-1" class="radio-button" required />
                                              <label for="radio-1" class="radio-button-click-target">
                                                <span class="radio-button-circle"></span>Half
                                              </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="mb-3">
                                          <label for="" class="form-label">Attached File</label>
                                          <input type="file" class="form-control" name="attachedFile"
                                             placeholder="Employee ID">
                                       </div>
                                    </div>
                                </div>
                                 <div class="mb-3">
                                    <label for="" class="form-label">Reason</label>
                                    <textarea class="form-control" name="reason" rows="4" required></textarea>
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