<link rel="stylesheet" href="sign_up.css">


<?php

include('connection.php');

if(isset($_POST['set_password'])){

$email = $_SESSION['femail'];

$password = $_POST['pass'];

echo $email;

$sql = "UPDATE existing_user set password = '$password' where mail_id='$email';";

$res = mysqli_query($con,$sql);

header('location: index.php');

}

 ?>


<script type='text/javascript'>
  function showPassword() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

function success(){

alert('Password Updated Suceessfully');
//windows.location = 'index.php'

}
</script>

<div class='sign-up' >
<form class="" action="" method="post" style="padding-top:30%;" onsubmit="success()">

<input type="password" name="pass" placeholder="New Password" required id='password'>
<input type="checkbox" onclick="showPassword()" >Show Password<br>
<input type="submit" name="set_password" value="Submit" >
</form>
</div>
