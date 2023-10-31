<?php
  $date1 = date("Y-m-d");
?>

<div class="modal myModel" id="modelLunchTaken">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bgColorBlack">
              <h4 class="modal-title">Lunch Taken </h4>
              <button type="button" class="btn-close text-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <div>
                <form action="backend/employeeLunchTakenAdd.php" id="lunchTakenFormEmp" method="post" enctype="multipart/form-data">
                  <!-- <div class="col-md-12 d-none">
                    <div class="mb-2">
                      <label for="emp_id" class="form-label">EMP ID:</label>
                      <input type="text" class="form-control" name="emp_id" value="<?php echo $empID; ?>">
                    </div>
                  </div> -->
                  <div class="col-md-12">
                     <div class="mb-2">
                        <label class="form-label">Lunch Date</label>                          
                        <input type="date" class="form-control" name="dateSelect" value="<?php echo date('Y-m-d'); ?>" min="<?php echo date('Y-m-d', strtotime('-2 day', strtotime($date1))); ?>" max="<?php echo date('Y-m-d'); ?>">
                     </div>
                  </div>
                  <div class="col-md-12">
                    <button type="submit" class="btn btn-success waves-effect waves-light btn-sm w-100 py-2" name="submitFormBtn">Lunch Taken</button>
                  </div>          
                </form>
              </div>              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>     



