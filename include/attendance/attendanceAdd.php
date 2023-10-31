<div class="modal myModel" id="modelAttendanceAdd">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bgColorBlack">
        <h4 class="modal-title">Attendance In</h4>
        <button type="button" class="btn-close text-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div>
          <div>
            <span class="latitudeText font10"></span>
            <span class="longitudeText font10"></span>
          </div>
          <form action="backend/dailyAttendanceEmpAdd.php" method="post" enctype="multipart/form-data">
            <div class="col-md-12 d-none">
              <div class="mb-2">
                <label for="emp_id" class="form-label">EMP ID:</label>
                <input type="text" class="form-control" name="emp_id" value="<?php echo $empID; ?>">
              </div>
            </div>  

            <div class="col-md-12">
               <div class="mb-2">
                  <label class="form-label">Attendance Status</label>
                  <select class="form-control" name="attendance_status">
                    <option value="present">Present</option>
                    <option value="wfh">WFH</option>
                  </select>
               </div>
            </div>
            <div class="col-md-12 d-none">
               <div class="mb-2">
                  <label class="form-label">Entry Latitude</label>
                  <input type="text" class="form-control" name="entry_latitude" id="latitude" placeholder="Latitude">
               </div>
            </div>
            <div class="col-md-12 d-none">
               <div class="mb-2">
                  <label class="form-label">Entry Longitude</label>
                  <input type="text" class="form-control" name="entry_longitude" id="longitude" placeholder="Longitude">
               </div>
            </div>  
            <div class="col-md-12"> 
              <div class="mb-3">
                <label for="pwd" class="form-label">Remark:</label>
                <textarea class="form-control" name="remark" placeholder="Type remark"></textarea>
              </div> 
            </div> 
            <div class="col-md-12">
              <button type="submit" class="btn btn-success waves-effect waves-light btn-sm w-100 py-2" name="submitFormBtn">Attendance In</button>
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



