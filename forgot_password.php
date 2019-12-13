<title>Forgot password</title>
<link rel="stylesheet" href="sign_up.css">

<?php

include('connection.php');
?>

<div class='sign-up' >

<form class="" action="" method="post" style="padding-top:30%;">
  <h3 style="margin:0px;" align='left'>Enter email</h3>
<input type="email" name="email" placeholder="@iiitbh.ac.in" required><br>
<input type="submit" name="send_otp" value="Send OTP">
</form>
</div>

<?php

if(isset($_POST['send_otp'])){

$_SESSION['femail'] = $_POST['email'];
$email = $_SESSION['femail'];

$sql = "SELECT mail_id from faculty_details where mail_id='$email';";

$res = mysqli_query($con,$sql);

$count = mysqli_num_rows($res);

if($count==1){

  $otp_reg = mt_rand(1000,9999);

mail('prajjwalbairagi143@gmail.com','Reset Password','OTP is : '.$otp_reg);


$_SESSION['fotp'] = $otp_reg;
header('location: forgot_password_otp.php');
}

else{

echo "<h2 align='center' style='color:red;text-align:center;margin:0%;padding-bottom:20%;'>Email does not exist</h2>";
}
}
 ?>
