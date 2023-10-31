<?php
  include 'header.php';
  include 'profileHeader.php';

  $is_active = "active";
  $today_date = date('Y-m-d');
  $query = $conn->prepare("SELECT id,full_name,title,dob,img From employee where DATE_FORMAT(dob,'%m-%d') = DATE_FORMAT(NOW(),'%m-%d') and is_active = :is_active ");
  $query->bindParam(':is_active',$is_active);
  $query->execute();
  $empBirthDayListResult = $query->fetchAll();
  $empBirthDayListRow = count($empBirthDayListResult);

?>




<section class="sectionBox sectionPadding pt-4">
  <div class="container pb-3 mb-3">
    <div class="alertWrap">
      <?php
      if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
      }
      ?>
    </div>
    <div class="boxAttendance position-relative">
      <div class="boxHeadingAtten" style="">
        <h6 class="mb-0">Today Present</h6>
      </div>
      <div class="row pt-1">

        <?php
        $is_active = "active";
        $today_date = date('Y-m-d');
        $query = $conn->prepare("SELECT id, employee_id,entry_time,entry_distance,attendance_status from daily_attendance where attendance_date = :attendance_date order by id desc limit 0, 6 ");
        $query->bindParam(':attendance_date',$today_date);
        $query->execute();
        $empDailyAttResult = $query->fetchAll();
        $empDailyAttRow = count($empDailyAttResult);
        if ($empDailyAttRow>0) {
          foreach($empDailyAttResult as $value){
            $employee_id = $value['employee_id'];
            $entry_time = $value['entry_time'];
            $entry_distance = $value['entry_distance'];  
            $attendance_status = $value['attendance_status'];  

            if (!empty($entry_time)) {
              $entry_time = substr($entry_time,0,5)." ".substr($entry_time,9,9);                
            } 

            if (!empty($entry_distance)) {
              $entry_distance_string = floatval($value['entry_distance']);
              $entry_distance = number_format($entry_distance_string, 2, '.', '');
            } 

            $query = $conn->prepare("SELECT id,full_name,title From employee where is_active = :is_active and id = :employee_id order by id desc");
            $query->bindParam(':employee_id',$employee_id);
            $query->bindParam(':is_active',$is_active);
            $query->execute();
            $employeeListResult = $query->fetchAll();
            $employeeListRow = count($employeeListResult);

            if ($employeeListRow) {
              $empFullName = $employeeListResult[0]['full_name'];
              $empFullName = explode(" ", $empFullName);
              if (isset($empFullName[0])) {
                $empFullName0 = $empFullName[0];
              }else{
                $empFullName0 = "";
              }
              if (isset($empFullName[1])) {
                $empFullName1 = $empFullName[1];
              }else{
                $empFullName1 = "";
              }
              $empFullName = $empFullName0." ".$empFullName1;
              ?>
                <div class="col-md-2 col-4 mb-2">                  
                  <div class="fc-event position-relative"> 
                    <?php
                      if ($attendance_status=='wfh') {
                        ?>
                        <div class="topTag bg-danger px-2 py-0"><?php if(!empty($attendance_status)){ echo $attendance_status; } ?></div>
                        <?php
                      }
                    ?>                                         
                     <!-- <i class="fas fa-fist-raised"></i>  -->
                     <?php if(!empty($empFullName)){ echo $empFullName; } ?>
                     <span><?php if(!empty($entry_time)){ echo $entry_time; } ?> </span> | 
                     <span><?php if(!empty($entry_distance)){ echo $entry_distance; } ?></span>
                  </div>
                </div>
              <?php
            }
          }
        }


        if ($empDailyAttRow>5) {
        ?> 
          <div class="contentHideShow">
            <div>
               <div class="row">
                <?php 
                $is_active = "active";
                $today_date = date('Y-m-d');
                $query = $conn->prepare("SELECT id, employee_id,entry_time,entry_distance,attendance_status from daily_attendance where attendance_date = :attendance_date order by id desc  LIMIT 50 OFFSET 6");
                $query->bindParam(':attendance_date',$today_date);
                $query->execute();
                $empDailyAttResult = $query->fetchAll();
                $empDailyAttRow = count($empDailyAttResult);
                if ($empDailyAttRow>0) {
                  foreach($empDailyAttResult as $value){
                    $employee_id = $value['employee_id'];
                    $entry_time = $value['entry_time'];
                    $entry_distance = $value['entry_distance'];  
                    $attendance_status = $value['attendance_status'];  

                    if (!empty($entry_time)) {
                      $entry_time = substr($entry_time,0,5)." ".substr($entry_time,9,9);                
                    } 

                    if (!empty($entry_distance)) {
                      $entry_distance_string = floatval($value['entry_distance']);
                      $entry_distance = number_format($entry_distance_string, 2, '.', '');
                    } 

                    $query = $conn->prepare("SELECT id,full_name,title From employee where is_active = :is_active and id = :employee_id order by id desc");
                    $query->bindParam(':employee_id',$employee_id);
                    $query->bindParam(':is_active',$is_active);
                    $query->execute();
                    $employeeListResult = $query->fetchAll();
                    $employeeListRow = count($employeeListResult);

                    if ($employeeListRow) {
                      $empFullName = $employeeListResult[0]['full_name'];
                      $empFullName = explode(" ", $empFullName);
                      if (isset($empFullName[0])) {
                        $empFullName0 = $empFullName[0];
                      }else{
                        $empFullName0 = "";
                      }
                      if (isset($empFullName[1])) {
                        $empFullName1 = $empFullName[1];
                      }else{
                        $empFullName1 = "";
                      }
                      $empFullName = $empFullName0." ".$empFullName1;
                      ?>
                        <div class="col-md-2 col-4 mb-2">                  
                          <div class="fc-event position-relative"> 
                            <?php
                              if ($attendance_status=='wfh') {
                                ?>
                                <div class="topTag bg-danger px-2 py-0"><?php if(!empty($attendance_status)){ echo $attendance_status; } ?></div>
                                <?php
                              }
                            ?>                                        
                             <?php if(!empty($empFullName)){ echo $empFullName; } ?>
                             <span><?php if(!empty($entry_time)){ echo $entry_time; } ?> </span> | 
                             <span><?php if(!empty($entry_distance)){ echo $entry_distance; } ?></span>
                          </div>
                        </div>
                      <?php
                    }
                  }
                }
                ?>
               </div>
            </div>
          </div>
          <a href="#" class="show_hide font13" data-content="toggle-text">Show More... </a>
          <?php
        }
        ?>             
      </div>
    </div>
</div>




  <div class="container">
    <div class="row">
      <?php
      $query = $conn->prepare("SELECT * from break_time_in_out where employee_id = :employee_id and break_date = :break_date order by id desc limit 1");
      $query->bindParam(':employee_id',$empID);
      $query->bindParam(':break_date',$today_date);
      $query->execute();
      $todayAttResult = $query->fetchAll();
      $todayAttRow = count($todayAttResult);
      if($todayAttRow>0){
        $to_time = $todayAttResult[0]['to_time'];
        if (empty($to_time)) {
        ?>        
        <div class="col-md-3 col-6 ">
          <div class="box position-relative">
            <div class="fromTimeBreak text-white">From Time : <?php echo $todayAttResult[0]['from_time']; ?></div>
            <a href="breakTimeList.php">
              <div class="imgWrap breakOutBorder">
                <img src="assets/images/punch-in.png" class="img-fluid ">
              </div>
              <div class="textwrap text-center pt-2">
                <p>Break Time</p>
              </div>
            </a>
          </div>        
        </div>
        <?php 
        }else{
          ?>
          <div class="col-md-3 col-6 ">
            <div class="box">
              <a href="breakTimeList.php">
                <div class="imgWrap">
                  <img src="assets/images/punch-in.png" class="img-fluid ">
                </div>
                <div class="textwrap text-center pt-2">
                  <p>Break Time</p>
                </div>
              </a>
            </div>        
          </div>
          <?php
        }
      }else{
          ?>
          <div class="col-md-3 col-6 ">
            <div class="box">
              <a href="breakTimeList.php">
                <div class="imgWrap">
                  <img src="assets/images/punch-in.png" class="img-fluid ">
                </div>
                <div class="textwrap text-center pt-2">
                  <p>Break Time</p>
                </div>
              </a>
            </div>        
          </div>
          <?php
        }
      ?>


      <div class="col-md-3 col-6">
        <div class="box">
          <a href="attendanceList.php">
            <div class="imgWrap">
              <img src="assets/images/attendance.png" class="img-fluid">
            </div>
            <div class="textwrap text-center pt-2">
              <p>Attendance</p>
            </div>
          </a>
        </div>        
      </div>

      <div class="col-md-3 col-6">
        <div class="box">
          <a href="leave-list-by-employee.php" >
            <div class="imgWrap">
              <img src="assets/images/leave.png" class="img-fluid">
            </div>
            <div class="textwrap text-center pt-2">
              <p>Leave</p>
            </div>
          </a>
        </div>        
      </div>

      <div class="col-md-3 col-6">
        <div class="box">
          <a href="holidayCalender.php">
            <div class="imgWrap">
              <img src="assets/images/holiday.png" class="img-fluid">
            </div>
            <div class="textwrap text-center pt-2">
              <p>Holiday</p>
            </div>
          </a>
        </div>        
      </div>

      <div class="col-md-3 col-6">
        <div class="box">
          <a href="lunchTakenList.php">
            <div class="imgWrap">
              <img src="assets/images/lunch-time.png" class="img-fluid">
            </div>
            <div class="textwrap text-center pt-2">
              <p>Lunch</p>
            </div>
          </a>
        </div>        
      </div>

      <div class="col-md-3 col-6">
        <div class="box">
          <a href="reimbursementList.php">
            <div class="imgWrap">
              <img src="assets/images/reimbursement.png" class="img-fluid">
            </div>
            <div class="textwrap text-center pt-2">
              <p>Reimbursement</p>
            </div>
          </a>
        </div>        
      </div>

      <div class="col-md-3 col-6">
        <div class="box">
          <a href="birthdayCalender.php">
            <div class="imgWrap">
              <img src="assets/images/birthday-cake.png" class="img-fluid">
            </div>
            <div class="textwrap text-center pt-2">
              <p>Birthday</p>
            </div>
          </a>
        </div>        
      </div>

       <div class="col-md-3 col-6">
        <div class="box">
          <a href="employeeProfile.php">
            <div class="imgWrap">
              <?php
                if ($empDetailRowHeader>0) {
                  $empDetailGender = $empDetailResultHeader[0]['gender'];
                  if ($empDetailGender=='female') {
                    ?>
                    <img src="assets/images/female.png" class="img-fluid">
                    <?php
                  }else{
                    ?>
                    <img src="assets/images/male.png" class="img-fluid">
                    <?php
                  }
                }
              ?>              
            </div>
            <div class="textwrap text-center pt-2">
              <p>Profile</p>
            </div>
          </a>
        </div>        
      </div>

    

      <!--<div class="col-md-3 col-6">
        <div class="box">
          <div class="imgWrap">
            <img src="assets/images/newsletter.png" class="img-fluid">
          </div>
          <div class="textwrap text-center pt-2">
            <p>Newsletter</p>
          </div>
        </div>        
      </div>

      <div class="col-md-3 col-6">
        <div class="box">
          <div class="imgWrap">
            <img src="assets/images/salary.png" class="img-fluid">
          </div>
          <div class="textwrap text-center pt-2">
            <p>Salary Slip</p>
          </div>
        </div>        
      </div>
      
      <div class="col-md-3 col-6">
        <div class="box">
          <div class="imgWrap">
            <img src="assets/images/birthday-cake.png" class="img-fluid">
          </div>
          <div class="textwrap text-center pt-2">
            <p>Birthday</p>
          </div>
        </div>        
      </div> -->

    </div>
  </div>
</section>



<?php
  include 'footer.php';
?>



<?php
if(isset($empBirthDayListRow)) {
  foreach ($empBirthDayListResult as $value) {
    $full_name = $value['full_name'];
    $emp_img = $value['img'];
    ?>
      <div class="modal fade" id="birthdayModal" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered1 modal-lg">
              <div class="modal-content">
                  <div class="modal-header border-bottom-0">
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body pt-0">
                      <div class="text-center mb-4">
                          <div class="avatar-md mx-auto mb-4">
                              <div class="avatar-title bg-light rounded-circle text-primary h1">
                                  <i class="mdi mdi-email-open"></i>
                              </div>
                          </div>
                          <div class="row justify-content-center">
                              
                              <div class="col-md-7">
                                <div class="textWrapRight px-4">
                                  <!-- <h4 class="text-primary">Aaj <span><?php if(isset($full_name)){ echo $full_name; } ?></span> Ka Birthday hai !</h4> -->
                                  <p class="quotePara">Wishing you a happy birthday, a wonderful year and success in all you do. </p>
                                  <h4 class="text-primary"> <span><?php if(isset($full_name)){ echo $full_name; } ?></span></h4>
                                </div>
                              </div>
                              <div class="col-md-5">                            
                                  <div>
                                    <img src="admin/upload/users/<?php if(isset($emp_img)){ echo $emp_img; } ?>" style="width: 250px;height: 230px;object-fit:cover;object-position: top;">
                                  </div>                            
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    <?php
  }
}
?>



<script type="text/javascript">
    $(window).on('load', function() {
        $('#birthdayModal').modal('show');
    });
</script>





<script>
$(document).ready(function () {
    $(".contentHideShow").hide();
    $(".show_hide").on("click", function () {
        var txt = $(".contentHideShow").is(':visible') ? 'Show More...' : 'Show Less';
        $(".show_hide").text(txt);
        $(this).prev('.contentHideShow').slideToggle(200);
    });
});
</script>
