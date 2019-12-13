<?php
include('connection.php');


$date = $_POST['date_of_booking'];
$time_slot = $_POST['time_slot'];
$name = $_POST['name'];
$_SESSION['mail'] = $_POST['mail_id'];
$isConfirm = $_POST['value'];
//$_SESSION['check'] = $isConfirm ;
$room_name = $_POST['room_name'];
$booking_status = $_POST['booking_status'];

$_SESSION['f_name'] = $name;
$_SESSION['date'] = $date;
$_SESSION['time_slot'] = $time_slot;
$_SESSION['booking_status'] = $booking_status;

if($isConfirm=='confirm'){
$sql = "UPDATE booking set booking_status='Confirmed' where date_of_booking='$date' and time_slot='$time_slot' and room_name='$room_name';";
}
if($isConfirm=='cancel')
$sql = "DELETE from booking where room_name='$room_name' and date_of_booking='$date' and time_slot='$time_slot' and room_name='$room_name';";

//if($isConfirm=='self cancel')
//$sql = "DELETE from booking where room_name='$room_name' and date_of_booking='$date' and time_slot='$time_slot' and room_name='$room_name';";


$res = mysqli_query($con,$sql);

?>
