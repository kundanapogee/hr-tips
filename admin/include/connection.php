<?php
// session_start();

// $officeLatitude = "";
// $officeLongitude = "";


date_default_timezone_set('Asia/Kolkata');

$servername = "localhost";
$username = "root";
$password = "";
$database = "apogeele_attandance";

// $servername = "localhost";
// $username = "apogeele_attandance";
// $password = "apogeele_attandance";
// $database = "apogeele_attandance";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Connected successfully"; 
        // die();
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }                      
?>