<?php
include('connection.php');

if(array_key_exists('admin',$_SESSION)&&isset($_POST['cancelled']))
{
$mail_id_user = $_SESSION['mail'];
 $name = $_SESSION['f_name'] ;
 $date = $_SESSION['date'] ;
$time_slot = $_SESSION['time_slot'] ;
$booking_status = $_SESSION['booking_status'] ;
$mail_content=$_POST['reason'];

$newdate = date("d-m-Y", strtotime($date));

$subject = 'Request has been cancelled';

$mail_user = 'Dear '.$name.',


Your request for date '. $newdate.' and time slot '.$time_slot.' is cancelled due to '.$mail_content.'.';
//$mail_id_user
mail($mail_user,$subject,$mail_user);

if(strtolower($booking_status)=="pending")
header('location: pending_request.php');

else {
  header('location: show_bookings.php');
}
}
else{

header('location: index.php');

}
 ?>
