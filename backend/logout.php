<?php
session_start();

if (isset($_SESSION['empIDSESS'])) {
	if(session_destroy()) {
		header("location:../login.php");
	}else{
		header("location:../index.php");
	}	
}


?>