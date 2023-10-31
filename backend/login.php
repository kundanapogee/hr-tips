<?php
session_start();
if(isset($_POST['employeeLogin'])){ 
require '../include/connection.php';


// die();
// $cookie_name = "user";
// $cookie_value = "John Doe";
// setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); //86400 = 1 day



    $email = $_POST['email'];
    $password1 = $_POST['password'];
    $password = base64_encode($password1);
    $is_active = "active";
    $query = $conn->prepare("SELECT * FROM employee where email=:email or username =:username and password=:password and is_active=:is_active");
    $query->bindParam(':email',$email);
    $query->bindParam(':username',$email);
    $query->bindParam(':password',$password); 
    $query->bindParam(':is_active',$is_active); 
    $query->execute(); 
    $result = $query->fetchAll();
    $row = count($result);
    if($row==1){
      $_SESSION['empIDSESS'] = $result[0]['id'];
      // echo $_SESSION['empIDSESS'];
      // die();

      // if(!empty($_POST["remember"])) {
      //   // setcookie ("username",$email,time()+ (86400 * 90));
      //   setcookie ("username",$email,time()+ 86400, "/");
      //   // setcookie ("password",$password,time()+ (86400 * 90));      
      //   setcookie ("password",$password,time()+ 86400,  "/");      
      //   // echo "Cookies Set Successfuly";
      // } 


      // echo $_COOKIE["username"];
      // echo "<br>";
      // echo "<br>";
      // echo $_COOKIE["password"];

      // die();

      header("location:../index.php");
    }else{
      $_SESSION['msg'] = '<div class="alert alert-danger py-2">
                          <strong>Oops.!</strong> Somthing went Wrong</a>.
                        </div>';
      header("location:../login.php");
    }      
}else{
      $_SESSION['msg'] = '<div class="alert alert-danger py-2">
                          <strong>Oops.!</strong> You should <a href="#" class="alert-link">Somthing went Wrong</a>.
                        </div>';
      header("location:../login.php");
    }     


?>