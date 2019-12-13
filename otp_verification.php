<title>OTP verification</title>
<link rel="stylesheet" href="sign_up.css">
<?php
include('connection.php');
//echo $_SESSION['otp'];

if(isset($_POST['submit_otp'])){
$otp_entered = $_POST['otp1'];

$otp_reg = $_SESSION['otp'];

$_SESSION['new_user'] = true;

if($otp_entered==$otp_reg){

//$fname = $_SESSION['fname'];
//$lname =   $_SESSION['lname'];
$email = $_SESSION['email'];
//$phone_no =  $_SESSION['phone_no'];
$pass =   $_SESSION['password'];


$sql = "INSERT INTO existing_user values('$email',PASSWORD('$pass'));";

//$sql1= "UPDATE faculty_details set password='$pass' where mail_id='$email';";

$res = mysqli_query($con,$sql);
//$count = mysqli_affected_rows($res);

$query = "SELECT first_name,last_name from faculty_details where mail_id='$email';";
$result = mysqli_query($con,$query);
$row = mysqli_fetch_assoc($result);


$mail_subject = 'Registration successful';
$mail_content = "Welcome ".$row['first_name'].' '.$row['last_name'].',

Now you have access to classroom booking facility.';

mail($email,$mail_subject,$mail_content);
?>
<script type="text/javascript">

function success(){

alert('New user has been created Suceessfully');
//windows.location.href = 'index.php'

}
</script>
<?php
//header('location: Success.php');

/*else{

echo "<h2 align='center' style='color:red;margin:0px;position:absolute;top:65%;left:40%'>User already exist</h2>";
echo "<script>$('.sign-up').hide()</script>";

}*/

}
}
 ?>

<div class='sign-up'>
 <form class="" id='OTP submission' action="" method="post" onsubmit="success()">

   <input type="text" name="otp1" value="" id='otp-field' placeholder="Enter OTP" required maxlength="4"><br>
   <input type="submit" name="submit_otp" value="Submit OTP" >
 </form>
</div>
