<?php
  include 'header.php';

  include 'profileHeader.php';


$empID = $_SESSION['empIDSESS'];
$query = $conn->prepare("SELECT * from reimbursement where emp_id = :employeeID order by id desc");
$query->bindParam(':employeeID',$empID);
$query->execute();
$reimbursementResult = $query->fetchAll();
$reimbursementRow = count($reimbursementResult);


?>








<section class="commonBox sectionPadding pt-md-4">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <a href="#"  data-bs-toggle="modal" data-bs-target="#modelReimbursementAdd" class="btn btn-success waves-effect waves-light btn-sm">Add Reimbursement <i class="mdi mdi-arrow-right ms-1"></i></a>
        <?php 
          include 'include/reimbursement/reimbursementAdd.php'
        ?>
      </div>
      <div class="col-md-6 text-end">
        <!-- <a href="attendanceCalender.php" class="btn btn-primary waves-effect waves-light btn-sm">View Calender <i class="mdi mdi-arrow-right ms-1"></i></a> -->
      </div>       
    </div>
    <div class="row mt-4">
      <div class="col-md-12 col-12 mb-4">
        <div class="box">
          <div class="">
            <h3 class="fw-bold">Reimbursement List</h3>
          </div> 
          <hr>
          <div>
            <div class="tableWrap table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Subject </th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th style="min-width: 90px;">Date</th>                    
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                <?php                  
                  if ($reimbursementRow>0) {
                    $sr_no = 1;
                    foreach ($reimbursementResult as $value) {
                      $id = $value['id'];
                      $amount = $value['amount'];
                      $subject = $value['subject'];
                      $description = $value['description'];
                      $is_paid = $value['is_paid'];
                      $created_at = $value['created_at'];
                      // $updated_at = $value['updated_at'];
                      // $emp_id = $value['emp_id'];
                      ?>
                  <tr>
                    <td><?php if(isset($sr_no)){ echo $sr_no; } ?></td>
                    <td><?php if(isset($subject)){ echo $subject; } ?></td>
                    <td><i class="fas fa-rupee-sign"></i> <?php if(isset($amount)){ echo $amount; } ?></td>
                    <td>
                      <?php 
                        if (isset($is_paid)) {
                          if ($is_paid=='paid') {
                           ?>
                           <span class="badge badge-pill badge-soft-success font-size-11">Paid</span>
                           <?php
                          }else{
                            ?>
                           <span class="badge badge-pill badge-soft-danger font-size-11">Unpaid</span>
                           <?php
                          }
                        }
                      ?>       
                    </td>
                    <td><?php if(isset($created_at)){ echo $created_at; } ?></td>
                   <!--  <td>
                      <?php 
                        if (isset($is_paid)) {
                          if ($is_paid=='unpaid') {
                           ?>
                           <a href="#" class="badge badge-pill badge-soft-success" style="font-size:17px;"><i class="far fa-edit"></i></a>
                           <?php
                          }
                        }
                      ?>
                      <a href="#" class="badge badge-pill badge-soft-danger" style="font-size:17px;"><i class="far fa-trash-alt"></i></a>
                    </td> -->
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
      $("#reimbursementForm").validate({
        rules :{
          amount: {
                required: true,
            },
          subject: {
                required: true,  
            }
        },
      });
  });
</script>