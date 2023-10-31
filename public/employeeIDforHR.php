<?php
 include '../include/connection.php';

$is_active = 'active';
$query = $conn->prepare("SELECT * from employee where is_active = :is_active order by emp_id asc");
$query->bindParam(':is_active',$is_active);
$query->execute();
$employeeResult = $query->fetchAll();
$employeeRow = count($employeeResult);


?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>AMBAR</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css ">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
  <link rel="stylesheet" type="text/css" href="assets/css/mobile.css">
</head>
<body>


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


    <div class="row mt-4">
      <div class="col-md-12 col-12 mb-4">
        <div class="box">
          <div class="">
            <h3 class="fw-bold">Employee List</h3>
          </div> 
          <hr>
          <div>
            <div class="tableWrap table-responsive">
              <table class="table table-hover table-bordered" style="width: 100%;" border="1" cellpadding="10" cellspacing="0">
                <thead >
                  <tr>
                    <th>No.</th>
                    <th>Emp. Name</th>
                    <th>Emp ID</th>
                  </tr>
                </thead>
                <tbody>
                  <?php                  
                  if ($employeeRow>0) {
                    $sr_no = 1;
                    foreach ($employeeResult as $value) {
                      $id = $value['id'];
                      $full_name = $value['full_name'];
                      $emp_id = $value['emp_id'];                  

                      ?>
                      <tr>
                        <td><?php if(isset($sr_no)){ echo $sr_no; } ?></td>                             
                        <td><?php if(isset($full_name)){ echo $full_name; } ?></td>
                        <td><?php if(isset($emp_id)){ echo $emp_id; } ?></td>                        
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



