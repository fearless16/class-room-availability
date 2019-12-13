<body id='confirm_booking' align='center'>
<link rel="stylesheet" href="style.css">

<?php
error_reporting(0);
include('connection.php');
if(isset($_POST['room_check']) ){

  echo "<form action='logout.php'><input type='submit' value='Log out'  id='logout'/></form>";
  ?>

  <input type ='button' onclick="javascript:window.location.href='details.php'" value='back' id='back'>";
<?php
  $date1 = $_SESSION['cur_date'];
  $date = date_create($date1);

  $mydate = getdate(date("U"));

  $date2= $mydate['year']."-".$mydate['mon']."-".$mydate['mday'];
  $y = date_create($date2);
  $diff=date_diff($y,$date);
  $num = $diff->format("%R%a");
  $num1 = $diff->format("%a");

$_SESSION['room_name'] = $_POST['room_name'] ;
$room_name = $_POST['room_name'];

echo "<h3 style='background-color:black;'>You have selected ".$room_name."</h3><br>";
$fname = $_SESSION['first_name'];
$lname = $_SESSION['last_name'];
$time_slot = $_SESSION['time_slot'];
$date1 = $_SESSION['cur_date'];

echo "<h2  style='color:black;'>You are asking for booking after : ".$num1." days</h2><br>";

$newDate = date("d-m-Y", strtotime($date1));

$mail_id = $_SESSION['mail_id'];
$admin_id = $_SESSION['admin_id'] ;
$subject_user = 'Request sent successfully';
$mail_content_user = 'Dear '.$fname.' '.$lname.' ,

Your request for date '.$newDate.' and time slot '.$time_slot. ' has been successfully sent.
On confirmation you will receive a mail.
';
$subject_admin = 'New booking request arrived';
$mail_content_admin = 'Dear Admin,


Request recieved for booking on date '.$newDate.' and time slot '.$time_slot.' Please check the pending requests.


Thanks!
';

mail($mail_id,$subject_user,$mail_content_user);
mail('prajjwalbairagi143@gmail.com',$subject_admin,$mail_content_admin);


$sql1 = "INSERT into booking values ('$fname','$lname','$room_name','$date1','$time_slot','$mail_id','pending');";
mysqli_query($con,$sql1);

$sql2 = "SELECT * from booking where mail_id='$mail_id' and date_of_booking ='$date1' and time_slot = '$time_slot' ;";
$result1 = mysqli_query($con,$sql2);

?>
<table style ='width:100%' align ='center' border='4' class='table'>

  <tr><th>Name</th>
  <th>Room Name</th>
  <th>Requested for Date</th>
  <th>Timing(hrs)</th>
   </tr>
<?php
while($row = mysqli_fetch_assoc($result1)){

echo " <tr>
 <td align = 'center'>".$fname." ".$lname."</td>
 <td align = 'center'>".$room_name."</td>
  <td align = 'center'>".$row['date_of_booking']."</td>
  <td align = 'center'>".$row['time_slot']."</td>

</tr>";

}
 ?>
</table>
<?php
//session_unset();
//echo "<form action='index.php'><input type='submit' value='Log out' /></form>";


//else {
  //echo "<h3>Booking is not allowed on this date </h3>";
  //echo "<form action='index.php'><input type='submit' value='Log out'  id='log_out'/></form>";
//}
//header('location: mail.php');


?>
<script type="text/javascript">
  alert('booking request has been sent');
  window.location.href="details.php";
</script>

<?php
}
else {

  session_unset();
  header('location: index.php');

}
?>
