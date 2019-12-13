<title>Registration form</title>
<?php
include('connection.php');



 ?>
<body style='margin : 0;'>

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>-->
<script src="jqueryFiles.js"></script>
<link rel="stylesheet" href="sign_up.css">
<div class='sign-up'>
<h1>New user registration</h1>

<script type='text/javascript'>
  function showPassword() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>




<form class="" action="save_otp.php" method="post"  onsubmit="return " enctype="multipart/form-datam" id='sign-up-form'>
  <!--<input type="text" name="first_name" value="" placeholder="First name" class='required' id='fname' required><br>

  <input type="text" name="last_name" value="" placeholder="Last name"   id='lname'><br> -->

  <input type="text" name="mail_id" id='email' value="" placeholder="@iiitbh.ac.in" class='required' required id='email'><br>

  <!-- <input type="text" name="phone_no" value="" placeholder="Phone No." maxlength="10" class='required' required id='phone_no'><br>

  <input type="text" name="designation" class='required' placeholder="Designation" required id='designation'><br> -->

  <input type="password" name="password" value="" class='required' id='password' placeholder="Create password" required maxlength="10" >
    <input type="checkbox" onclick="showPassword()" >Show Password
  <br>

  <input type="submit" name="send_otp" value='Sign up' required id='otp' >
</form>



</div>
</body>
