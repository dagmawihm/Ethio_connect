<?php

require_once('PHPMailer/PHPMailerAutoload.php');

if(isset($_GET["resete"]))
{

  $email = $_GET["resete"];

$vcode=(rand(100000,999999));

$db=mysqli_connect("localhost","root","","ethio_connect");
$sql="UPDATE users SET verification_code = '$vcode' WHERE email = '$email'";






$message = '<html>
<head>
  <style type="text/css">
    .top-nav-bar
{
    height: 57px;
    top: 0;
    position: sticky;
    background: #fff;
    margin-bottom: 20px; 
    border-bottom: 10px solid black;
    z-index: 2;
}

.logo
{
    height: 40px;
    margin: 5px 10px; 
}
.spec{
    width: 50%;
    margin: 20px auto;
    border:0px solid black;
    padding: 20px;
    background: #a8a4a3;

}
body
{

      font-family: sans-serif;
}

body p
{
  font-size: 18px;
    margin-left: 40px;
}
body b p
{
  font-size: 23px;
  margin-left: 40px;
}
body p b
{
    font-size: 20px;
}

@media only screen and (max-width: 980px)

{

.spec{
    width: 90%;

}
      .logo
{
    height: 90px;
    margin: 5px 10px; 
}
.top-nav-bar
{

    height: 118px;
}
}


  </style>
</head>
<body> 
<div class="spec"> 
<div class="top-nav-bar">

</div>

<br>
<p>Hi,</p>
<br>
<p>here you have your verification code to reset your password.</p>  
<b><p>'.$vcode.'</p></b>
<br>
<br>
<p>please use the above verification code to reset your password.</p>
<br>
<p>as a security measure, the verification code will expire in 4 minutes.</p>
<br>
<p><b>if this was not you:</b></p> 
<p>consider changing your admin login password and your email account password as well to ensure your account security.</p>
<br>
<p>Thanks</p>
</div>
</body>
</html>';


$mail = new PHPMailer();
$mail->isSMTP();
$mail->SMTPAuth =true;
$mail->SMTPSecure = 'ssl';
$mail->Host = 'smtp.gmail.com';
$mail->Port = '465';
$mail->isHTML();
$mail->Username = 'dagmawihm@gmail.com';
$mail->Password = 'asdsad'; // your real password .env
$mail->SetFrom('no-reply@ALLsmartmarket.com');
$mail->Subject = 'Hi';
$mail->Body = $message;
$mail->AddAddress($email);



mysqli_query($db, $sql);
$mail->Send();
header("Location: index.php");
exit;

}
else
{
  echo"not set";
}
  





?>