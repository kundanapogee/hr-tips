<?php
  include 'header.php';
  include 'profileHeader.php';

  ?>



   <!--  <style type="text/css">
        #results { padding:20px; border:1px solid; background:#ccc; }
    </style> -->

  <?php

// $is_active = "active";
// $query = $conn->prepare("SELECT id,full_name,title From employee where is_active = :is_active order by id desc");
// $query->bindParam(':is_active',$is_active);
// $query->execute();
// $employeeListResult = $query->fetchAll();
// $employeeListRow = count($employeeListResult);



$today_date = date('Y-m-d');

$empID = $_SESSION['empIDSESS'];
// $query = $conn->prepare("SELECT * from daily_attendance where employee_id = :employeeID order by id desc limit 31");
$query = $conn->prepare("SELECT * from daily_attendance where employee_id = :employeeID and MONTH(created_at) = MONTH(now())
       and YEAR(created_at) = YEAR(now()) order by id desc limit 31");
$query->bindParam(':employeeID',$empID);
$query->execute();
$empDailyAttResult = $query->fetchAll();
$empDailyAttRow = count($empDailyAttResult);




?>

<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDOT5yBi-LAmh9P2X0jQmm4y7zOUaWRXI0"></script> -->



<section class="commonBox sectionPadding pt-md-4">
  <div class="container">
    <div class="alertWrap">
      <?php
      if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
      }
      ?>
    </div>

    <div class="row">
      <div class="col-md-6 col-sm-6  col-6">
        <?php
        $query = $conn->prepare("SELECT * from daily_attendance where employee_id = :employeeID and attendance_date = :attendance_date");
        $query->bindParam(':employeeID',$empID);
        $query->bindParam(':attendance_date',$today_date);
        $query->execute();
        $todayAttResult = $query->fetchAll();
        $todayAttRow = count($todayAttResult);
          if (isset($todayAttRow)) {
            if ($todayAttRow>0) {
              ?>
              <a href="#"  data-bs-toggle="modal" data-bs-target="#modelAttendanceOut" class="btn btn-danger waves-effect waves-light btn-sm">Attendance Out<i class="mdi mdi-arrow-right ms-1"></i></a>
              <?php
              include 'include/attendance/attendanceOut.php';
            }else{
              ?>
              <a href="#"  data-bs-toggle="modal" data-bs-target="#modelAttendanceAdd" class="btn btn-success waves-effect waves-light btn-sm">Attendance In<i class="mdi mdi-arrow-right ms-1"></i></a>
              <?php
              include 'include/attendance/attendanceAdd.php';
            }
          }
        ?>

        <!-- <a href="#"  data-bs-toggle="modal" data-bs-target="#modelAttendanceAdd" class="btn btn-success waves-effect waves-light btn-sm">Attendance In<i class="mdi mdi-arrow-right ms-1"></i></a> -->
        <?php
        // include 'include/attendance/attendanceAdd.php';
        ?>

      </div>
      <div class="col-md-6 col-sm-6 col-6 text-end">
        <a href="attendanceCalender.php" class="btn btn-primary waves-effect waves-light btn-sm">View Calender <i class="mdi mdi-arrow-right ms-1"></i></a>
      </div>
       
    </div>
    <div class="row mt-4">
      <div class="col-md-12 col-12 mb-4">
        <div class="box">
          <div class="">
            <h3 class="fw-bold">Attendance List</h3>
          </div> 
          <hr>
          <div>
            <div class="tableWrap table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Status</th>
                    <th>Day</th>
                    <th>Entry</th>
                    <th>Exit</th>
                    <th>Distance In</th>
                    <th>Distance Out</th>                    
                    <th>Total Time</th>
                    <th>Break Time</th>
                    <!-- <th style="min-width: 90px;">Date</th>                     -->
                    <th style="min-width: 80px;"></th>
                  </tr>
                </thead>
                <tbody>
                  <?php                  
                  if ($empDailyAttRow>0) {
                    $sr_no = 1;
                    foreach ($empDailyAttResult as $value) {
                      $id = $value['id'];
                      $dailyAttandanceEmpID = $value['employee_id'];
                      $attendance_status = $value['attendance_status'];
                      $entry_time = $value['entry_time'];
                      $exit_time = $value['exit_time'];
                      $entry_distance = $value['entry_distance'];
                      $exit_distance = $value['exit_distance'];
                      $attendance_date = $value['attendance_date'];
                      $break_time = $value['break_time'];


                      $attendance_date = date("d M Y", strtotime($attendance_date));

                      // // $datetime = DateTime::createFromFormat('Y-m-d', $attendance_date);
                      // $dayName = $datetime->format('D');



                      // $orgDate = "17-07-2012";  
                      // $date = str_replace('-"', '/', $attendance_date);  
                      // $newDate = date("d-M-Y", strtotime($date));  
                      // echo $newDate;  
                      // $attendance_date = $newDate;  


                      $total_time = $value['total_time'];

                      $remark = $value['remark'];
                      $exit_remark = $value['exit_remark'];
                      $entry_latitude = $value['entry_latitude'];
                      $entry_longitude = $value['entry_longitude'];
                      $entry_distance = $value['entry_distance'];
                      $exit_latitude = $value['exit_latitude'];
                      $exit_longitude = $value['exit_longitude'];
                      $exit_distance = $value['exit_distance'];
                      $device_detail = $value['device_detail'];
                      $device_type = $value['device_type'];
                      $ipaddress = $value['ipaddress'];
                      $exit_device_detail = $value['exit_device_detail'];
                      $exit_device_type = $value['exit_device_type'];
                      $exit_ipaddress = $value['exit_ipaddress'];
                      $total_time = $value['total_time'];
                      $created_at = $value['created_at'];


                      $entryLatLong = $entry_latitude."/".$entry_longitude;
                      $exitLatLong = $exit_latitude."/".$exit_longitude;

                      

                      // die();


                      
                      // die();
                      // $entry_distance = ;
                      if (!empty($entry_distance)) {
                        $entry_distance_string = floatval($value['entry_distance']);
                        $entry_distance = number_format($entry_distance_string, 2, '.', '');
                      }

                      if (!empty($exit_distance)) {
                        $exit_distance_string = floatval($value['exit_distance']);
                        $exit_distance = number_format($exit_distance_string, 2, '.', '');
                      }

                      // $exit_distance = $value['exit_distance'];
                      ?>
                      <tr>
                        <td><?php if(isset($sr_no)){ echo $sr_no; } ?></td>
                        <td>
                          <?php 
                            if (isset($entry_time)) {
                              if (!empty($entry_time)) {
                               ?>
                               <span class="badge badge-pill badge-soft-success font-size-11 text-capitalize"><?php if(isset($attendance_status)){ echo $attendance_status; } ?></span>
                               <?php
                              }else{
                                ?>
                               <span class="badge badge-pill badge-soft-danger font-size-11">Absent</span>
                               <?php
                              }
                            }
                          ?>              
                        <td><?php if(isset($attendance_date)){ echo $attendance_date; } ?>
                              <br>
                          <small ><?php if(isset($dayName)){ echo $dayName; } ?></small></td>
                        <td><?php if(isset($entry_time)){ echo $entry_time; } ?></td> 
                        <td><?php if(isset($exit_time)){ echo $exit_time; } ?></td>
                        <td>
                          <?php 
                                if(isset($entry_distance)){ 
                                  if (!empty($entry_distance)) {
                                    echo $entry_distance."Km";
                                  }else{
                                    ?>
                                    <span class="badge badge-pill badge-soft-danger font-size-11">NA</span>
                                    <?php
                                  }
                                }
                           ?>
                        </td>
                        <td>
                          <?php 
                            if(isset($exit_distance)){ 
                              if (!empty($exit_distance)) {
                                echo $exit_distance."Km";
                              }else{
                                ?>
                                <span class="badge badge-pill badge-soft-danger font-size-11">NA</span>
                                <?php
                              }
                            }
                          ?>
                        </td>                         
                        <td><?php if(isset($total_time)){ echo $total_time; } ?></td> 
                        <td><?php if(isset($break_time)){ echo $break_time; } ?></td>  
                        <td>
                          <a href="#" class="btn btn-primary" style="padding: 2px 6px;border-radius: 3px;" data-bs-toggle="modal" data-bs-target="#attendanceDetailEmp<?php echo $id; ?>"><i class="fas fa-list"></i></a>
                          <?php
                          include 'include/attendance/attendanceDetail.php';
                          ?>

                          <a href="attendanceMapLocation.php?id=<?php if(isset($id)){ echo $id; } ?>" class="btn btn-primary" style="padding: 2px 6px;border-radius: 3px;"><i class="fas fa-map-marked-alt"></i></a>

                          <!-- <a href="#" class="btn btn-primary" style="padding: 2px 6px;border-radius: 3px;" data-bs-toggle="modal" data-bs-target="#attendanceEmpMapLocation<?php echo $id; ?>"><i class="fas fa-map-marked-alt"></i></a> -->

                          <?php
                          // include 'include/attendance/attendanceMapLocation.php';
                          ?>                          
                        </td>
                      </tr>
                      <?php
                      $sr_no = $sr_no+1;
                    }
                    
                  }
                  ?>
                  <!-- <tr>
                    <td>1</td>
                    <td><span class="badge badge-pill badge-soft-success font-size-11">Present</span></td>                    
                    <td>Monday</td>
                    <td>5 Km</td>
                    <td>17-03-2023</td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td><span class="badge badge-pill badge-soft-danger font-size-11">Absent</span></td>
                    <td>Monday</td>
                    <td>5 Km</td>
                    <td>17-03-2023</td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td><span class="badge badge-pill badge-soft-success font-size-11">Present</span></td>
                    <td>Monday</td>
                    <td>5 Km</td>
                    <td>17-03-2023</td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td><span class="badge badge-pill badge-soft-danger font-size-11">Present</span></td>
                    <td>Monday</td>
                    <td>5 Km</td>
                    <td>17-03-2023</td>
                  </tr>
                  <tr>
                    <td>5</td>
                    <td><span class="badge badge-pill badge-soft-success font-size-11">Present</span></td>
                    <td>Monday</td>
                    <td>5 Km</td>
                    <td>17-03-2023</td>
                  </tr> -->
                </tbody>
              </table>
            </div>
          </div>
        </div>        
      </div>

    </div>
  </div>
</section>



<?php
  include 'footer.php';
?>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->


<script language="JavaScript">
    // Webcam.set({
    //     width: 290,
    //     height: 290,
    //     image_format: 'jpeg',
    //     jpeg_quality: 90
    // });
  
    // Webcam.attach( '#my_camera' );
  
    // function take_snapshot() {
    //     Webcam.snap( function(data_uri) {
    //         $(".image-tag").val(data_uri);
    //         document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
    //     } );
    // }
</script>



<script>
      let userLocation = navigator.geolocation;
         if(userLocation) {
            userLocation.getCurrentPosition(success);
         } else {
            "The geolocation API is not supported by your browser.";
            console.log("The geolocation API is not supported by your browser.");
         }
      function success(data) {
         let lat = data.coords.latitude;
         let long = data.coords.longitude;
         $("#latitude").val(lat);
         $("#longitude").val(long);

          $(".latitudeText").text(lat);
          $(".longitudeText").text(long);
        
       
      }
   </script>


