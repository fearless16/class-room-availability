<!DOCTYPE html>
<title>Search page</title>

<body id ='searchPage' align='center' style='margin:0%;padding:0%;'>
<link rel="stylesheet" href="style.css">
<?php
//error_reporting(0);
include('connection.php');
if(isset($_POST['search']) && array_key_exists('mail_id',$_SESSION)){

  ?><input type='button' name='back' value='back' id='back' onclick="javascript:window.location.href='details.php'">
  <?php
  echo "<form action='logout.php'><input type='submit' value='Log out' id = 'logout' /></form>";



$room_type = $_POST['room-type'];
if($room_type=='Class')
$time_slot = $_POST['class_time_slot'];
else
$time_slot = $_POST['lab_time_slot'];

$_SESSION['time_slot'] = $time_slot;
$_SESSION['cur_date'] = $_POST['cur_date'];
$date = $_SESSION['cur_date'];

$timestamp = strtotime($date);

$day = date("D",$timestamp);

$date1 = $_SESSION['cur_date'];
$date = date_create($date1);

$mydate = getdate(date("U"));

$date2= $mydate['year']."-".$mydate['mon']."-".$mydate['mday'];
$y = date_create($date2);
$diff=date_diff($y,$date);
$num = $diff->format("%R%a");
$num1 = $diff->format("%a");
$email = $_SESSION['mail_id'];
$check_query = "SELECT * from booking where mail_id = '$email' and time_slot= '$time_slot' and date_of_booking='$date1';";

$res = mysqli_query($con,$check_query);

$row_count = mysqli_num_rows($res);


if($num > 15 || $num < 0 || $row_count == 1){

if($row_count == 1)
echo "<h3 style='color:red;background-color:black;'>You have already requested for a room on this date and time</h3>";
else
echo "<h3 style='color:red;background-color:black;'>Booking is not allowed on this date </h3>";
//echo "<input type ='button' onclick=javascript:window.href='' value='back' id='back1'>";

}

else{
if(strlen($time_slot) < 11)
$time_slot = $time_slot.".00";
$date = $_SESSION['cur_date'];

$sql = "SELECT room_type , s.floor , s.room_name from classroom s ,(select room_name from ((SELECT room_name from routine where day like '%$day%' and time ='$time_slot' union all select room_name from classroom)  union all SELECT room_name from booking where time_slot = '$time_slot' and date_of_booking = '$date')y group by room_name having count(room_name) = 1) z where room_type='$room_type' and s.room_name=z.room_name;";
$result = mysqli_query($con,$sql);

$no_of_rows = mysqli_num_rows($result);

$result1 = mysqli_query($con,$sql);

if($no_of_rows > 0){

echo "<h3>No. of classrooms available  : ".$no_of_rows."</h3></br>";


 ?>
 <form class="" action="confirm_booking.php" class='booking' method="post">
 <select class="" name="room_name" style = 'min-width: 150px;' placeholder='select room' required>
 <?php while($row1 = mysqli_fetch_assoc($result1)){
   $r = $row1['room_name'];
   ?>
 <option value="<?php echo $r; ?>" name ="<?php echo $r; ?>"> <?php echo $r; ?></option>
<?php } ?>
 </select>
 <button type="submit" name="room_check">Request</button>
</form>

<table style ='width:100%' align ='center' border='4' class='table'>

  <tr><th>Room Name</th>
  <th>Floor</th>
   <th>Room Type</th>
   </tr>
   <?php

  while($row = mysqli_fetch_assoc($result)){

  echo " <tr>
   <td align = 'center'>".$row['room_name']."</td>
   <td align = 'center'>".$row['floor']."</td>
   <td align = 'center'>".$row['room_type']."</td>
 </tr>";

}
?>

</table>

<?php
}
else{

  echo "<h3>No ".$room_type." is Available</h3></br>";

}

}

}

else{
echo "<script>javascript:window.location.href='index.php'</script>";
}

?>

</body>
</html>
