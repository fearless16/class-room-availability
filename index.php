<!DOCTYPE html>
<title>Login</title>
<?php

include('connection.php');

 ?>
 <body style="padding-right:28%;text-align:center;" >
<link rel="stylesheet" href="style.css">

<h1 align='center' style='color:black;font-family:helvetica;'>Classroom Availability Project</h1>

 <div id = 'loginform' >
   <h1 align='center'>Login</h1>

<form class="" action="" method="post" align='center' id='login' style="text-align:center;">
<img src="Image/How-to-Change-a-Username-in-WordPress.jpg" alt="" id='imgs' height="5%" width='10%'  >
<input type="text" name="mail" id ='mail' placeholder="Email Address"     required><br><br>
<img src="Image/password icon.png" alt="" id='imgs1' height="5%" width='10%'>
<input type="password" name="password" id ='pass' placeholder="Password" required><br><br>

<button type="submit" name="submit" id='log-in' >Login</button>
<br><br><a href='new_user.php' >New user</a>
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
<a href='forgot_password.php'>Forgot password</a>
</form>


<!--<img src="Image/Login-Icon-e1541097562576.jpg" alt="" id='imgs2' height="25%" width='25%'> -->
<img src="Image/black-technology-wallpapers-desktop-background-On-wallpaper-hd.jpg" alt="" id='imgs3' height="40%" width='30%'>

</div>
<div class='my-image'>
<marquee style="color:white;"><h2 style='color:white;'>Classroom availability project designed and developed by PRAJWAL BAIRAGI and ABHROJEET BOSE<h2></marquee>


</div>
<?php

if(isset($_POST['submit'])){
$mail_id = $_POST['mail'];

if(strpos($mail_id,'@')==false){

$mail_id = $mail_id."@iiitbh.ac.in";


}


$pass = $_POST['password'];
$query = "SELECT * from faculty_details where mail_id = '$mail_id' ;";
$result = mysqli_query($con,$query);
$row = mysqli_fetch_assoc($result);
$count = mysqli_num_rows($result);

if($count==1){

$mail_id = $row['mail_id'];

}

$sql = "SELECT * from existing_user where mail_id= '$mail_id' and password = '$pass';";

$res = mysqli_query($con,$sql);

$row1 = mysqli_fetch_assoc($res);
//echo $row1['password'];
$count1 = mysqli_num_rows($res);
//echo $row1['password'];

if($count1==1 ){


$_SESSION['mail_id'] = $row['mail_id'];
$_SESSION['designation'] = $row['designation'];
$_SESSION['phone_no'] = $row['phone_no'];
$_SESSION['first_name'] = $row['first_name'];
$_SESSION['last_name'] = $row['last_name'];

$admin_id = 'prajwal.cse.1737@iiitbh.ac.in';
$_SESSION['admin_id'] = 'prajwal.cse.1737@iiitbh.ac.in';
if($mail_id == $admin_id ){
  $_SESSION['admin'] = 'prajwal.cse.1737@iiitbh.ac.in';
header('location: Admin_page.php');

}
else
header('location: details.php');

}

if($row['mail_id']!=$mail_id)
{
echo "<h2 id='wrong_credential'>invalid email or password </h2>";

}

else{
echo "<h2 id='wrong_credential'>User Does not exist </h2>";
//header('location:index.php');

}


}




 ?>


</body>
</html>
