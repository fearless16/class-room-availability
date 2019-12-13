<?php
//bool mail ( string $to , string $subject , string $message [, string $additional_headers [, string $additional_parameters ]] )


if(array_key_exists('first_name',$_SESSION)){
$newdate = date("d-m-Y", strtotime($date));
$mail_subject = 'Booking request is cancelled';
$mail_content = $name.' has cancelled the booking of date : '.$newdate.' and time slot : '.$time_slot.'.';

mail($_SESSION['admin_id'],$mail_subject, $mail_content);


}
?>
