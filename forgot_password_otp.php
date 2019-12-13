<title>OTP verification</title>
<link rel="stylesheet" href="sign_up.css">


<?php
include('connection.php');
//echo $_SESSION['fotp'];
if(isset($_POST['submit_otp'])){

$otp_entered = $_POST['otp1'];

$otp_reg = $_SESSION['fotp'];

if($otp_reg == $otp_entered){

header('location: set_password.php');

}

else{

//header('location: forgot_password.php');
echo "<h2 style='color:red;margin:0px;position:absolute;top:65%;left:44%'> Wrong OTP</h2>";
}
}

?>

<div class='sign-up' >
<form class="" action="" method="post" style="padding-top:30%;">

<input type="text" name="otp1" placeholder="Enter OTP" required maxlength="4"><br>
<input type="submit" name="submit_otp" value="Submit">
</form>
</div>
