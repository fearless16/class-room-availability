<title>Authentication</title>
<?php

include('connection.php');

if(isset($_POST['send_otp'])){

//$_SESSION['fname'] = $_POST['first_name'];
//$_SESSION['lname']= $_POST['last_name'];
$_SESSION['email']= $_POST['mail_id'];
//$_SESSION['phone_no']= $_POST['phone_no'];
$_SESSION['password'] = $_POST['password'];
//$_SESSION['desg']= $_POST['designation'];
$email = $_SESSION['email'];

if(strpos($email,'@')==false){

$email = $email."@iiitbh.ac.in";


}

$sql = "SELECT * from existing_user where mail_id = '$email';";

$res = mysqli_query($con,$sql);

$query = "SELECT * from faculty_details where mail_id = '$email' ;";
$result = mysqli_query($con,$query);

$count1 = mysqli_num_rows($result);
$count = mysqli_num_rows($res);

if($count > 0 ){

echo "<h2 style='color:black;' align='center'>User Already Exists</h2>";

}
else{
if($count==0 && $count1 > 0){
$otp_reg = mt_rand(1000,9999);
//$email;
mail('prajjwalbairagi143@gmail.com','OTP For sign-up',"OTP is : ".$otp_reg.".");

$_SESSION['otp'] = $otp_reg;
header('location: otp_verification.php');
}

else{
echo "<h2 style='color:red;' align='center'>You are not authorized to access this facility</h2>";

}

}
}
 ?>
