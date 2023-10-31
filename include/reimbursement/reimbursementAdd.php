<div class="modal myModel" id="modelReimbursementAdd">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header bgColorBlack">
              <h4 class="modal-title">Reimbursement</h4>
              <button type="button" class="btn-close text-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <div>
                <form action="backend/reimbursementAdd.php" id="reimbursementForm" method="post" enctype="multipart/form-data">
                  <div class="row">
                    <!-- <div class="col-md-6 d-none">
                      <div class="mb-2">
                        <label class="form-label">Employee ID:</label>
                        <input type="text" class="form-control" name="emp_id" value="<?php if (isset($empID)) { echo $empID; } ?>">
                      </div>
                    </div> -->
                    <div class="col-md-6">
                      <div class="mb-2">
                        <label class="form-label">Amount:</label>
                        <input type="text" class="form-control" name="amount">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-2">
                        <label class="form-label">Atteched File:</label>
                        <input type="file" class="form-control" name="attachedFile[]" multiple="multiple">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="mb-2">
                        <label class="form-label">Subject:</label>
                        <input type="text" class="form-control" name="subject">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="mb-2">
                        <label class="form-label">Message:</label>
                        <textarea class="form-control" placeholder="Type message" name="description"></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="mt-2">
                    <button type="submit" name="submitFormBtn" class="btn btn-success waves-effect waves-light btn-sm w-100 py-2">Submit</button>
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