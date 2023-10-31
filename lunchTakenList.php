<?php
// session_start();

  include 'header.php';
  include 'profileHeader.php';

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

$is_active = "active";
$query = $conn->prepare("SELECT id,full_name,title From employee where is_active = :is_active and id = :employeeID limit 1");
$query->bindParam(':is_active',$is_active);
$query->bindParam(':employeeID',$empID);
$query->execute();
$employeeListResult = $query->fetchAll();
$employeeListRow = count($employeeListResult);

$empTitle = $employeeListResult[0]['title'];
$empFullName = $employeeListResult[0]['full_name'];

$completeEmpName = $empTitle." ".$empFullName;

// echo "<pre>";
// print_r($employeeListResult);
// echo "</pre>";
// die();



$today_date = date('Y-m-d');

$empID = $_SESSION['empIDSESS'];
$query = $conn->prepare("SELECT * from lunch_taken where employee_id = :employeeID and lunch_date = :lunch_date");
$query->bindParam(':employeeID',$empID);
$query->bindParam(':lunch_date',$today_date);
$query->execute();
$todayDateResult = $query->fetchAll();
$todayDateRow = count($todayDateResult);


// print_r($todayDateResult);

$query = $conn->prepare("SELECT * from lunch_taken where employee_id = :employeeID order by id desc");
$query->bindParam(':employeeID',$empID);
$query->execute();
$lunchDetailResult = $query->fetchAll();
$lunchDetailRow = count($lunchDetailResult);




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
      <div class="col-md-6 col-8">
        <a href="#"  data-bs-toggle="modal" data-bs-target="#modelLunchTaken" class="btn btn-success waves-effect waves-light btn-sm">Lunch Taken <i class="mdi mdi-arrow-right ms-1"></i></a>

        <?php
          if ($todayDateRow>0) {
            ?>
            <a href="#"  data-bs-toggle="modal" data-bs-target="#todayTokenForLunchModal" class="btn btn-danger waves-effect waves-light btn-sm">Show Token <i class="mdi mdi-arrow-right ms-1"></i></a>
            <?php
          }
        ?>
    

         <!-- <button type="button" class="btn btn-primary waves-effect waves-light" id="custom-html-alert" onclick="executeExample()">Show Token</button> -->

      </div>
      <div class="col-md-6 col-4 text-end">
        <a href="lunchCalender.php" class="btn btn-primary waves-effect waves-light btn-sm">Calender <i class="mdi mdi-arrow-right ms-1"></i></a>
      </div>
      <?php 
        include 'include/lunch/lunchTakenByEmployee.php';
        include 'include/lunch/todayTokenForLunch.php';
      ?>
    </div>




    <div class="row mt-4">
      <div class="col-md-12 col-12 mb-4">

        <div class="box">
          <div class="">
            <h3 class="fw-bold">Lunch Taken List</h3>
          </div> 
          <hr>
          <div>
            <div class="tableWrap table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Day</th>                 
                    <th>Date</th>
                  </tr>
                </thead>
                <tbody>
                  <?php                  
                  if ($lunchDetailRow>0) {
                    $sr_no = 1;
                    foreach ($lunchDetailResult as $value) {
                      $id = $value['id'];
                      // $lunch_date = $value['lunch_date'];

                      // $source = $value['lunch_date'];
                      // $date = new DateTime($source);
                      // echo $date->format('d.m.Y'); // 31.07.2012
                      // $lunch_date = $date->format('d-m-Y'); // 31-07-2012

                      // $datetime = DateTime::createFromFormat('Y-m-d', $lunch_date);
                      // $dayName = $datetime->format('D');


                      $lunchDateTaken = $value['lunch_date'];
                      $lunchDate = new DateTime($lunchDateTaken);
                      $dayName = $lunchDate->format('D');
                      $lunchDateFormat = $lunchDate->format('d-m-Y');

                      
                      ?>
                      <tr>
                        <td><?php if(isset($sr_no)){ echo $sr_no; } ?></td>
                        <td><?php if(isset($dayName)){ echo $dayName; } ?></td>
                        <td><?php if (isset($lunchDateFormat)){ echo $lunchDateFormat; }?></td>
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



<script>
  $(document).ready(function(){
      $("#lunchTakenFormEmp").validate({
        rules :{
          dateSelect: {
                required: true,
            },
        },
        messages :{ 
          dateSelect: {
            required:  "Please select date.",
          },
        }
      });
  });
</script>