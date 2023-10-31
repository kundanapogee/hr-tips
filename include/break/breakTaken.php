<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script> -->

<div class="modal myModel" id="modelTakingBreakAdd">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bgColorBlack">
        <h4 class="modal-title">Take Break</h4>
        <button type="button" class="btn-close text-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div>
          <div>
            <span class="latitudeText font10"></span>
            <span class="longitudeText font10"></span>
          </div>
          <form action="backend/breakTakenAdd.php" method="post" enctype="multipart/form-data">
            <div class="col-md-12 d-none">
              <div class="mb-2">
                <label for="emp_id" class="form-label">EMP ID:</label>
                <input type="text" class="form-control" name="emp_id" value="<?php echo $empID; ?>">
              </div>
            </div>  
            <div class="col-md-12"> 
              <div class="mb-3">
                <label for="pwd" class="form-label">Reason:</label>
                <textarea class="form-control" name="from_reason" placeholder="Type reason"></textarea>
              </div> 
            </div> 
            <div class="col-md-12">
              <button type="submit" class="btn btn-success waves-effect waves-light btn-sm w-100 py-2" name="submitFormBtn">Taking Break</button>
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



