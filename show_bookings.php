<!DOCTYPE html>
<title>Bookings</title>
<body id='show-bookings'style="background-image: url('Image/images (3).jpg');background-position: center;background-size: cover;margin:0;padding:0;">
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>-->
<script src="jqueryFiles.js"></script>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="style1.css">
<?php

include('connection.php');
if(isset($_SESSION['admin'])){
echo "<form action='logout.php'><input type='submit' value='Log out' id = 'logout' /></form>";
$sql = "SELECT * from booking where booking_status='confirmed' and date_of_booking >= (SELECT current_date);";
$res = mysqli_query($con,$sql);
 ?>

 <?php
 if(mysqli_num_rows($res) > 0){

   ?>
    <div class = 'hide-show'>
   <table style ='width:100%' align ='center' border='4' class= 'table'>

     <tr><th>Name</th>
     <th>Room Name</th>
     <th>Booked for Date</th>
     <th>Timing(hrs)</th>
     <th>Email ID</th>
     <th>Cancel Booking</th>
      </tr>
      <?php
 while($row = mysqli_fetch_assoc($res)){

 echo " <tr>
  <td align = 'center'>".$row['first_name']." ".$row['last_name']."</td>
  <td align = 'center'>".$row['room_name']."</td>
   <td align = 'center'>".$row['date_of_booking']."</td>
   <td align = 'center'>".$row['time_slot']."</td>
   <td align = 'center'>".$row['mail_id']."</td>
   <td align = 'center'><input type= 'button' class='reject' value='cancel' ></td>
 </tr>";

 }
}

else{

echo "<h2 align='center' style='color : black'>No Booking</h2>";

}

  ?>
 </table>
</div>


<script>
$(document).ready(function(){
  $('#mail_id').hide();
  $('#cancel-page').hide();
  var data;
$(".table").on('click','.reject',function(){

    $('.hide-show').hide();
      $('#cancel-page').show();
    //var decision = confirm("Do you want to Reject the request??");
     var currentRow=$(this).closest("tr");
     var col1=currentRow.find("td:eq(0)").text(); // get current row 1st TD value
     var col2=currentRow.find("td:eq(1)").text(); // get current row 2nd TD
     var col3=currentRow.find("td:eq(2)").text();// get current row 3rd TD
     var col4=currentRow.find("td:eq(3)").text();
     var col5=currentRow.find("td:eq(4)").text();

    // data =col1+"\n"+col2+"\n"+col3+"\n"+col4+"\n"+col5;
$('#mail_id').hide();
$('#mail_id').val(col5);

     data = {
          name : col1,
          room_name : col2,
          date_of_booking : col3,
          time_slot : col4,
          mail_id:col5,
          value : 'cancel'

     };

return false;


   })

$('.cancel').click(function(){
$('#mail-id').hide();
var length = $('#reason').val().length;
  if(length > 1){
  $.ajax({
    type: "POST",
    url: "check_booking.php",
    data: data,
    success: function() {

      alert('Request has been cancelled');

  }
  });

}

})

$('#back').click(function(){


$('.hide-show').show();
$('#cancel-page').hide();
})

})
</script>


<div id='cancel-page' style="padding-top:1.5%;" >
<form class="" action="cancelled.php" method="post" align='center'>
  <input type="text" name=""  id='mail_id' value="">
  <textarea name="reason" id= 'reason' placeholder="Enter reason:due to" rows="8" cols="80" required></textarea>
</br>
  <input type="submit"  class='cancel' name="" value="Submit">

  <input type="button" value='back' id='back' >
</form>
</div>


 </body>
<?php
}

else{

header('location: index.php');

}
 ?>
</body>
</html>
