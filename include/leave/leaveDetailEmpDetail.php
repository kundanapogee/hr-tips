

<div class="modal" id="attendanceDetailEmp<?php echo $id; ?>">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><?php if(isset($leaveTypeName)){ echo $leaveTypeName; } ?></h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-2">
            <div class="textBox">
                <p class="mb-1"><strong>From Date:</strong></p>
                <p><?php if (isset($from_date)) { echo  $from_date; } ?></p>
            </div>
          </div>
          <div class="col-md-2">
            <div class="textBox">
                <p class="mb-1"><strong>To Date:</strong></p>
                <p><?php if (isset($to_date)) { echo  $to_date; } ?></p>
            </div>
          </div>
          <div class="col-md-2">
            <div class="textBox">
                <p class="mb-1"><strong>Status:</strong></p>
                <p>
                  <?php 
                      if (isset($is_approved)) {
                        if ($is_approved=='approve') {
                         ?>
                         <span class="badge badge-pill badge-soft-success font-size-11">Approved</span>
                         <?php
                        }elseif($is_approved=='disapprove'){
                          ?>
                          <span class="badge badge-pill badge-soft-danger font-size-11">Disapproved</span>
                         <?php
                        }else{
                          ?>
                         <span class="badge badge-pill badge-soft-warning font-size-11">Pending</span>
                         <?php
                        }
                      }
                    ?>     
                </p>
            </div>
          </div>
          <div class="col-md-2">
            <div class="textBox">
                <p class="mb-1"><strong>Day Type:</strong></p>
                <p><?php if (isset($day_type)) { echo  $day_type; } ?></p>
            </div>
          </div>
          <div class="col-md-2">
            <div class="textBox">
                <p class="mb-1"><strong>Day Count:</strong></p>
                <p><?php if (isset($day_count)) { echo  $day_count; } ?></p>
            </div>
          </div>
          <div class="col-md-2">
            <div class="textBox">
                <p class="mb-1"><strong>Attachment:</strong></p>
                <p>
                  <?php
                    if (!empty($attached_file)) {
                      ?>
                      <a href="admin/upload/leaveAttachment/<?php if (isset($attached_file)) { echo  $attached_file; } ?>" download> Download </a>
                      <?php
                    }else{
                      ?>
                      <span>No File</span>
                      <?php
                    }
                  ?>
                  
                </p>
            </div>
          </div>
          <div class="col-md-12">
            <div class="textBox">
                <p class="mb-1"><strong>Reason:</strong></p>
                <p><?php if (isset($reason)) { echo  $reason; } ?></p>
            </div>
          </div>
          
                    
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>