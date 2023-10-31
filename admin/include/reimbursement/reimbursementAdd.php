<div id="modeAddEmployeeReimbursement" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <form class="custom-validation" action="backend/employeeReimbursementAdd.php" method="post" enctype="multipart/form-data">
            <div class="modal-header">
               <h5 class="modal-title" id="myModalLabel">Employee Reimbursement Add</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <div class="row">
                  <div class="col-md-12">
                     <div class="row">
                        <div class="col-md-6">
                             <div class="mb-3">
                                 <label class="form-label">Employee Name</label>
                                 <select class="form-control form-select" name="emp_id" required>
                                    <option selected disabled> --Select-- </option>
                                    <?php
                                       $query = $conn->prepare("SELECT id,title,full_name From employee order by id desc");
                                       $query->execute();
                                       $employeeResultModel = $query->fetchAll();
                                       $employeeRowModel = count($employeeResultModel);
                                       if(isset($employeeRowModel)){
                                           if ($employeeRowModel>0) {
                                              foreach ($employeeResultModel as $value) {
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
                              <label for="" class="form-label">Amount</label>
                              <input type="text" class="form-control" name="amount" placeholder="Amount" required>
                           </div>
                        </div>
                        <div class="col-md-12">
                           <div class="mb-3">
                              <label for="" class="form-label">Attached File</label>
                              <input type="file" class="form-control" name="attachedFile[]"
                                 placeholder="Employee ID" accept="image/*,application/pdf" multiple>
                           </div>
                        </div>
                        <div class="col-md-12">
                           <div class="mb-3">
                              <label for="" class="form-label">Subject</label>
                              <input type="text" class="form-control" name="subject"
                                 placeholder="Subject" required>
                           </div>
                        </div>
                        <div class="col-md-12">
                           <div class="mb-3">
                              <label for="" class="form-label">Description</label>
                              <textarea class="form-control" name="description" rows="4" placeholder="Description" required></textarea>
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