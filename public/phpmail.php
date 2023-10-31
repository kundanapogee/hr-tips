<?php
$to = "kundanapogee@gmail.com";
$subject = "HTML email TEST for AMBAR";

$message = "
<html>
<head>
<title>HTML email</title>
</head>
<body>
<p>This email contains HTML Tags!</p>
<table>
<tr>
<th>Firstname</th>
<th>Lastname</th>
</tr>
<tr>
<td>John</td>
<td>Doe</td>
</tr>
</table>
</body>
</html>
";

// kundanapogee@gmail.com
// kundan@apogeeprecision.com

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <kundan@apogeeprecision.com>' . "\r\n";
$headers .= 'Cc: mr.kundanpandey065@gmail.com' . "\r\n";

if(mail($to,$subject,$message,$headers)){
	echo "Success";
}else{
	echo "Not Success";
}
?>