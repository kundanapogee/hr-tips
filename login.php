
<!DOCTYPE html>
<html lang="en">
<head>
  <title>HR TIPS</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css ">
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
  <link rel="stylesheet" type="text/css" href="assets/css/mobile.css">
</head>
<body>




<section class="loginSection py-3">
  <div class="container">
    <div class="row"> 
      <div class="col-md-4 col-sm-4 col-12 align-self-center"></div>
      <div class="col-md-4 col-sm-4 col-12 align-self-center">
        <div class="formWrapContainer">
          <div class="pt-3">
            <img src="assets/images/login2.jpg" class="img-fluid">
          </div>
          <div class="formWrap px-sm-4 px-md-4 px-lg-4 px-3">
            <div class="headingWrap">
              <h3 class="mb-0">Login</h3>
            </div>
            <div>
              <?php
                if(isset($_SESSION['msg'])) {
                  echo $_SESSION['msg'];
                  unset($_SESSION['msg']);
                }
              ?>
            </div>
            <form action="backend/login.php" method="post" id="login_form">
              <div class="mb-4 mt-3 d-flex">
                <div class="iconWrap">
                  <i class="fas fa-at text-muted"></i>
                </div>
                <div class="w-100 pe-3">
                  <input type="text" class="form-control" placeholder="Enter email" name="email" value="<?php if(isset($_COOKIE["username"])) { echo $_COOKIE["username"]; } ?>">
                </div>
              </div>
              <div class="mb-3 d-flex">
                <div class="iconWrap">
                  <i class="fas fa-lock text-muted"></i>
                </div>
                <div class="w-100 pe-3">
                  <input type="password" class="form-control" placeholder="Enter password" name="password" value="<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>">
                </div>
              </div>
              <p><input type="checkbox" name="remember" / style="min-height: 0!important;margin-left: 0!important;font-size: 13px!important;"> Remember me
              <div class="text-end">
                <a href="forgotPassword.php" class="font14" >Forgot Password?</a>
              </div>
              <div class="mt-3">
                <button type="submit" class="btn btn-primary d-block w-100 py-2" name="employeeLogin">Login</button>
              </div>          
            </form>
          </div>        
        </div>
      </div>
    </div>
  </div>
</section>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
</body>
</html>

<style>
  .error{
    color:red!important;
    margin-left: 15px;
    font-size: 13px;
  }
</style>

<script>
  $(document).ready(function(){
      $("#login_form").validate({
        rules :{
          email: {
                required: true,
            },
          password: {
                required: true,  
                minlength: 6,
            }
        },
        messages :{ 
          email: {
                  required:  "Please Enter Email or Username.",
          },
          password: {
                  required: "Please Enter Password.",  
                  minlength: "Please Enter atleast 6 Digit."
          },
        }
      });
  });
</script>