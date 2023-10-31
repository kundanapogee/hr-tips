<div class="modal myModel" id="todayTokenForLunchModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- <div class="modal-header bgColorBlack">
        <h4 class="modal-title">Today Token </h4>
        <button type="button" class="btn-close text-white" data-bs-dismiss="modal"></button>
      </div> -->
      <div class="modal-body">
        <div>
          <div class="text-center mb-2">
            <img src="assets/images/tokenIconLunch.png" width="100">
          </div>
          <div class="text-center">
            <!-- <h4 class="text-s"><strong>TOKEN  <u>TAKEN</u></strong></h4> -->
            <h2 class="text-success"><strong><?php if(!empty($completeEmpName)){ echo $completeEmpName; } ?></strong></h2>
            <h3 class="text-danger"><strong><?php echo date("d-m-Y"); ?></strong></h3>
            <p>You can Take your <b>Lunch</b></p>
            <p>You can check your  <a href="lunchCalender.php"> Lunch Calender</a></p> 
          </div>
        </div>              
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
      </div> -->
    </div>
  </div>
</div>     



