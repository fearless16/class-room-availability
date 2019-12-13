<!DOCTYPE html>
<title>Pending requests</title>
<body id = 'pending_page'>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="style1.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="jqueryFiles.js"></script>
<script src='jquery1.js'></script>


<?php
include('connection.php');

if(isset($_SESSION['admin'])){
echo "<form action='logout.php'><input type='submit' value='Log out' id = 'logout' /></form>";
$sql = "SELECT * from booking where booking_status='pending';";

$res = mysqli_query($con,$sql);

$rows = mysqli_num_rows($res);

if($rows==0){

echo "<h2 align='left' style='font-family:helvetica;float:left;'><b> No request is pending </b></h2>";

}

else {

 ?>
 <div class = 'hide-show'>
  <!--<form id="confirm-form" action="" method="post" onsubmit="return " enctype="multipart/form-datam">
-->
     <h2 style='font-family:helvetica;float:left;'> No. of request pending : <?php echo $rows; ?></h2>
  <table style ='width:100%' align ='center' border='4' class='table'>

    <tr>
    <th>Name</th>
    <th>Room Name</th>
    <th>Asking For Date</th>
    <th>Timing</th>
    <th>Email ID</th>
    <th>Booking status</th>
    <th>Change status</th>
     </tr>



     <?php
     $i = 0;
     while($row = mysqli_fetch_assoc($res)){

     echo " <tr >
      <td align = 'center' id=$i name='name'>".$row['first_name']." ".$row['last_name']."</td>
      <td align = 'center' id=$i name='room_name'>".$row['room_name']."</td>
      <td align = 'center' id=$i name='date_of_booking'>".$row['date_of_booking']."</td>
     <td align = 'center' id=$i name='time_slot'>".$row['time_slot']."</td>
     <td align = 'center' id=$i name='mail_id'>".$row['mail_id']."</td>
     <td align = 'center' id=$i>".$row['booking_status']."</td>
     <td align = 'center' id=$i> <input type='button' class ='btnSelect'  name ='submit' value='Accept'>
     <input type='button' class ='reject'  name ='cancel' value='Reject'>

     </tr>";
     $i +=1;
   }

?>

</table>
</div>
<script type="text/javascript">

$(document).ready(function(){

  // code to read selected table row cell data (values).
  $(".table").on('click','.btnSelect',function(){
      var decision = confirm("Do you want to accept??");

      if(decision==true){
      decision = 'confirm';
       var currentRow=$(this).closest("tr");
       var col1=currentRow.find("td:eq(0)").text(); // get current row 1st TD value
       var col2=currentRow.find("td:eq(1)").text(); // get current row 2nd TD
       var col3=currentRow.find("td:eq(2)").text();// get current row 3rd TD
       var col4=currentRow.find("td:eq(3)").text();
       var col5=currentRow.find("td:eq(4)").text();
       var col6=currentRow.find("td:eq(5)").text();
      // data =col1+"\n"+col2+"\n"+col3+"\n"+col4+"\n"+col5;
       data = {
            name : col1,
            room_name : col2,
            date_of_booking : col3,
            time_slot : col4,
            booking_status : col6,
            mail_id : col5,
            value : decision

       };
    //  console.log(data);

       $.ajax({
         type: "POST",
         url: "check_booking.php",
         data: data,
         success: function() {
        //  alert('Page submitted successfully');
            //document.write(data);
          history.go(0);
         }
       });
       return false;
}
});

});



</script>



<?php
//echo $_SESSION['check'];
}

}

else{

header('location: index.php');

}
?>

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
     var col6=currentRow.find("td:eq(5)").text();
    // data =col1+"\n"+col2+"\n"+col3+"\n"+col4+"\n"+col5;

    $('#mail_id').val(col5);
     data = {
          name : col1,
          room_name : col2,
          date_of_booking : col3,
          time_slot : col4,
          booking_status : col6,
          mail_id : col5,
          value : 'cancel'

     };



     return false;


   })

$('.cancel').click(function(){
$('#mail_id').hide();
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


<div id='cancel-page' style="padding-top:1.5%;">
<form class="" action="cancelled.php" method="post" align='center'>
    <input type='text' name=""  id='mail_id' value="">
  <textarea name="reason" id= 'reason' placeholder="Enter reason:due to" rows="8" cols="80" required></textarea>
  <br>
  <input type="submit"  class='cancel' name="cancelled" value="Submit">

  <input type="button" value='back' id='back' >
</form>
</div>

<!--$.ajax({
  type: "POST",
  url: "check_booking.php",
  data: data,
  success: function() {

}
}); -->
</body>
</html>
