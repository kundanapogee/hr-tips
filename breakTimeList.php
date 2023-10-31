<?php
  include 'header.php';
  include 'profileHeader.php';

$today_date = date('Y-m-d');

$empID = $_SESSION['empIDSESS'];
$query = $conn->prepare("SELECT * from break_time_in_out where employee_id = :employeeID and MONTH(created_at) = MONTH(now())
       and YEAR(created_at) = YEAR(now()) order by id desc limit 31");
$query->bindParam(':employeeID',$empID);
$query->execute();
$empDailyAttResult = $query->fetchAll();
$empDailyAttRow = count($empDailyAttResult);


?>

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
        // $query = $conn->prepare("SELECT * from break_time_in_out where employee_id = :employee_id and break_date = :break_date and to_time IS NULL OR to_time = ' ' order by id desc limit 1");
        // $query->bindParam(':employee_id',$empID);
        // $query->bindParam(':break_date',$today_date);
        // $query->execute();
        // $todayBreakResult = $query->fetchAll();
        // $todayBreakRow = count($todayBreakResult);
        //   if (isset($todayBreakRow)) {
        //     if ($todayBreakRow>0) {
        $query = $conn->prepare("SELECT * from break_time_in_out where employee_id = :employee_id and break_date = :break_date order by id desc limit 1");
        $query->bindParam(':employee_id',$empID);
        $query->bindParam(':break_date',$today_date);
        $query->execute();
        $todayAttResult = $query->fetchAll();
        $todayAttRow = count($todayAttResult);
        if($todayAttRow>0){
          $to_time = $todayAttResult[0]['to_time'];
          if (empty($to_time)) {
              $todayBreakID = $todayAttResult[0]['id'];
              ?>
              <a href="#"  data-bs-toggle="modal" data-bs-target="#modelBreakOver" class="btn btn-danger waves-effect waves-light btn-sm">Break Over<i class="mdi mdi-arrow-right ms-1"></i></a>
              <?php
              include 'include/break/breakOver.php';
            }else{
              ?>
              <a href="#"  data-bs-toggle="modal" data-bs-target="#modelTakingBreakAdd" class="btn btn-success waves-effect waves-light btn-sm">Take Break<i class="mdi mdi-arrow-right ms-1"></i></a>
              <?php
              include 'include/break/breakTaken.php';
            }
          }else{
            ?>
            <a href="#"  data-bs-toggle="modal" data-bs-target="#modelTakingBreakAdd" class="btn btn-success waves-effect waves-light btn-sm">Take Break<i class="mdi mdi-arrow-right ms-1"></i></a>
            <?php
            include 'include/break/breakTaken.php';
          }
        ?>

        <?php
        // include 'include/attendance/attendanceAdd.php';
        ?>

      </div>
      <!-- <div class="col-md-6 col-sm-6 col-6 text-end">
        <a href="attendanceCalender.php" class="btn btn-primary waves-effect waves-light btn-sm">View Calender <i class="mdi mdi-arrow-right ms-1"></i></a>
      </div> -->
       
    </div>
    <div class="row mt-4">
      <div class="col-md-12 col-12 mb-4">
        <div class="box">
          <div class="">
            <h3 class="fw-bold">Break Time List</h3>
          </div> 
          <hr>
          <div>
            <div class="tableWrap table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Break Date</th>
                    <th>Day</th>
                    <th>From Time</th>
                    <th>To Time</th>
                    <th>Total Time</th>
                  </tr>
                </thead>
                <tbody>
                  <?php                  
                  if ($empDailyAttRow>0) {
                    $sr_no = 1;
                    foreach ($empDailyAttResult as $value) {
                      $id = $value['id'];
                      $employee_id = $value['employee_id'];
                      $break_date = $value['break_date'];
                      $from_time = $value['from_time'];
                      $to_time = $value['to_time'];
                      $total_time = $value['total_time'];
                      $created_at = $value['created_at'];

                      $break_date = date("d M Y", strtotime($value['break_date']));

                      $break_day = date("D", strtotime($value['break_date']));

                      ?>
                      <tr>
                        <td><?php if(isset($sr_no)){ echo $sr_no; } ?></td>                                 
                        <td><?php if(isset($break_date)){ echo $break_date; } ?></td>                          
                        <td ><?php if(isset($break_day)){ echo $break_day; } ?></td>
                        <td><?php if(isset($from_time)){ echo $from_time; } ?></td> 
                        <td><?php if(isset($to_time)){ echo $to_time; } ?></td>
                                         
                        <td><?php if(isset($total_time)){ echo $total_time; } ?></td> 
                        <!-- <td> -->
                          <!-- <a href="#" class="btn btn-primary" style="padding: 2px 6px;border-radius: 3px;" data-bs-toggle="modal" data-bs-target="#attendanceDetailEmp<?php echo $id; ?>"><i class="fas fa-list"></i></a> -->
                          <?php
                          // include 'include/attendance/attendanceDetail.php';
                          ?>
                          <!-- <a href="attendanceMapLocation.php?id=<?php if(isset($id)){ echo $id; } ?>" class="btn btn-primary" style="padding: 2px 6px;border-radius: 3px;"><i class="fas fa-map-marked-alt"></i></a>                           -->
                        <!-- </td> -->
                      </tr>
                      <?php
                      $sr_no = $sr_no+1;
                    }                    
                  }
                  ?>
                    
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

