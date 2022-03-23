<?php

include 'connect.php'; 

if (isset($_POST['send'])) {
    $min=1000;
    $max=10000;
    $mail=$_POST['mail'];
    $otp=rand ($min , $max );
    $sql = "INSERT INTO otp_list (mail, otp_code)
    VALUES ('$mail', '$otp')";



//echo "başarılı";
    
if (mysqli_query($db, $sql)) {
  $to=$mail;
  $subject="OTP Sample";
  $message = "
<html>
<head>
  <title>OTP Sample</title>
</head>
<body>
<h3>Mail Sample for $mail From php-otp</h3><br>
<h2><b>Some Dumb Text Here your one time passcode : $otp </b></h2><br>

</body>
</html>
";

  $headers = "MIME-Version: 1.0" . "\r\n";
  $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
  $headers .= 'From: <php-otp@php-otp.com>';

  mail($to, $subject, $message, $headers);
  setcookie("mail", $mail, time()+3600);
Header("Location:passcode.php");
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($db);
  }
}

  if (isset($_POST['otp_btn'])) {
    $mail=$_POST['mail'];
    $otp_code=$_POST['otp_code'];

    $sql = "SELECT otp_code FROM otp_list WHERE mail = '$mail' and otp_code = '$otp_code'";
  $result = mysqli_query($db,$sql);
  $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
  
  
  $count = mysqli_num_rows($result);

  if($count == 1) {
    
    header("Location:index.php?stat=success");
 }else {
   header("Location:passcode.php?stat=fail");
 }
}

    
  


