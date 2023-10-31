
<div class="modal" id="attendanceDetailEmp<?php echo $id; ?>">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><?php if(isset($attendance_date)){ echo $attendance_date; } ?></h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-2">
            <div class="textBox">
                <p class="mb-1"><strong>Entry Time:</strong></p>
                <p><?php if (isset($entry_time)) { echo  $entry_time; } ?></p>
            </div>
          </div>
          <div class="col-md-2">
            <div class="textBox">
                <p class="mb-1"><strong>Exit Time:</strong></p>
                <p><?php if (isset($exit_time)) { echo  $exit_time; } ?></p>
            </div>
          </div>
          <div class="col-md-2">
            <div class="textBox">
                <p class="mb-1"><strong>Entry Distance:</strong></p>
                <p><?php if (isset($entry_distance)) { echo  $entry_distance; } ?></p>
            </div>
          </div>
          <div class="col-md-2">
            <div class="textBox">
                <p class="mb-1"><strong>Exit Distance:</strong></p>
                <p><?php if (isset($exit_distance)) { echo  $exit_distance; } ?></p>
            </div>
          </div>
          <div class="col-md-2">
            <div class="textBox">
                <p class="mb-1"><strong>Total Time:</strong></p>
                <p><?php if (isset($total_time)) { echo  $total_time; } ?></p>
            </div>
          </div>
          <div class="col-md-2">
            <div class="textBox">
                <p class="mb-1"><strong>Entry IP Address:</strong></p>
                <p><?php if (isset($ipaddress)) { echo  $ipaddress; } ?></p>
            </div>
          </div>
          <div class="col-md-2">
            <div class="textBox">
                <p class="mb-1"><strong>Exit IP Address:</strong></p>
                <p><?php if (isset($exit_ipaddress)) { echo  $exit_ipaddress; } ?></p>
            </div>
          </div>
          <div class="col-md-2">
            <div class="textBox">
                <p class="mb-1"><strong>Entry Device Type:</strong></p>
                <p><?php if (isset($device_type)) { echo  $device_type; } ?></p>
            </div>
          </div>
          <div class="col-md-2">
            <div class="textBox">
                <p class="mb-1"><strong>Exit Device Type:</strong></p>
                <p><?php if (isset($exit_device_type)) { echo  $exit_device_type; } ?></p>
            </div>
          </div>
          <div class="col-md-2">
            <div class="textBox">
                <p class="mb-1"><strong>Entry Lat/Long:</strong></p>
                <p><?php if (isset($entryLatLong)) { echo  $entryLatLong; } ?></p>
            </div>
          </div>
          <div class="col-md-2">
            <div class="textBox">
                <p class="mb-1"><strong>Exit Lat/Long:</strong></p>
                <p><?php if (isset($exitLatLong)) { echo  $exitLatLong; } ?></p>
            </div>
          </div>
          <div class="col-md-2">
            <div class="textBox">
                <p class="mb-1"><strong>Creating Date:</strong></p>
                <p><?php if (isset($created_at)) { echo  $created_at; } ?></p>
            </div>
          </div>
          <div class="col-md-3">
            <div class="textBox">
                <p class="mb-1"><strong>Entry Remark:</strong></p>
                <p><?php if (isset($remark)) { echo  $remark; } ?></p>
            </div>
          </div>
          <div class="col-md-3">
            <div class="textBox">
                <p class="mb-1"><strong>Exit Remark:</strong></p>
                <p><?php if (isset($exit_remark)) { echo  $exit_remark; } ?></p>
            </div>
          </div>          
          <div class="col-md-3">
            <div class="textBox">
                <p class="mb-1"><strong>Entry Device Detail:</strong></p>
                <p><?php if (isset($device_detail)) { echo  $device_detail; } ?></p>
            </div>
          </div>
          <div class="col-md-3">
            <div class="textBox">
                <p class="mb-1"><strong>Exit Device Detail:</strong></p>
                <p><?php if (isset($exit_device_detail)) { echo  $exit_device_detail; } ?></p>
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