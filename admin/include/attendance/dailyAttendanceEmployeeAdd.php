<div id="modelDailyAttendanceEmployee" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <form class="custom-validation" action="backend/dailyAttendanceEmployeeAdd.php" method="post" enctype="multipart/form-data">
            <div class="modal-header">
               <h5 class="modal-title" id="myModalLabel">Employee Daily Attendance Add</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <div class="row">
                  <div class="col-md-12">
                     <div class="row">
                        <div class="col-md-12">
                           <div class="mb-3">
                              <label for="" class="form-label">Employee Name</label>
                              <select class="form-control form-select" name="emp_id" required>
                                 <option selected disabled> --Select-- </option>
                                 <?php
                                    if(isset($employeeListRow)){
                                        if ($employeeListRow>0) {
                                           foreach ($employeeListResult as $value) {
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
                              <label class="form-label">Date</label>
                              <input type="date" class="form-control" name="attendance_date" max="<?php echo date('Y-m-d'); ?>" placeholder="Full Name" required>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="mb-3">
                              <label class="form-label">Entry Time</label>
                              <input type="time" class="form-control" name="entry_time" placeholder="Full Name" required>
                           </div>
                        </div>
                        <!-- <div class="col-md-6">
                           <div class="mb-3">
                              <label class="form-label">Exit Time</label>
                              <input type="time" class="form-control" name="exit_time" placeholder="Full Name">
                           </div>
                        </div> -->
                        <div class="col-md-6 d-none">
                           <div class="mb-3">
                              <label class="form-label">Entry Latitude</label>
                              <input type="text" class="form-control" name="entry_latitude" id="latitude" placeholder="Latitude">
                           </div>
                        </div>
                        <div class="col-md-6 d-none">
                           <div class="mb-3">
                              <label class="form-label">Entry Longitude</label>
                              <input type="text" class="form-control" name="entry_longitude" id="longitude" placeholder="Longitude">
                           </div>
                        </div>
                        <div class="col-md-12">
                           <div class="mb-3">
                              <label class="form-label">Remark</label>
                              <textarea  class="form-control" name="remark" placeholder="Remark" rows="4"></textarea>
                           </div>
                        </div>
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
</div>