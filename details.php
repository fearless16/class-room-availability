<!DOCTYPE html>
<title>Profile</title>
<link rel="stylesheet" href="style.css">
<body id ='detailPage' align="center">

<!--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>-->
  <script src="jqueryFiles.js"></script>
<?php
include('connection.php');

if(isset($_SESSION['first_name']))
{

echo "<form action='logout.php' align='right' ><input type='submit' value='Log out' id='logout' /></form>";
$mail_id = $_SESSION['mail_id'];
$query = "SELECT * from booking where mail_id='$mail_id';";
$query_result = mysqli_query($con,$query);

if($mail_id == 'dksinha.ece@iiitbh.ac.in'){
?>
<script type="text/javascript">
  function redirect(){

window.location.href="Admin_page.php";

  }
</script>

<input type= 'button' onclick='redirect()' id='back' value='Home'>
<?php
}

 ?>
<div class="setTable">

<table style ="width:100%" align ='center' border="4" class= 'table'>

  <tr >
  <th>Name</th>
  <th>Designation</th>
  <th>Email</th>
  <th>Phone No</th>
</tr>
  <tr>
  <td align = 'center'><?php   echo $_SESSION['first_name']." " .$_SESSION['last_name'] ?></td>
  <td align = 'center'><?php   echo $_SESSION['designation'] ?></td>
  <td align = 'center'><?php   echo $_SESSION['mail_id'] ?></td>
  <td align = 'center'><?php   echo $_SESSION['phone_no'] ?></td>
</tr>

</table>
</div>

<?php

if(mysqli_num_rows($query_result) > 0){

 ?>
 <form class="" action="" method="post" style="text-align: center;">


<table style ='width:100%' align ='center' border='4' class='table'>

  <tr><th>Name</th>
  <th>Room Name</th>
  <th>Booked For Date</th>
  <th>Timing</th>
  <th>Booking status</th>
  <th>Cancel Booking</th>
   </tr>
<?php
echo "<h2 align='left'> Booking history of ".$_SESSION['first_name']." ".$_SESSION['last_name']."</h3><br>";

while($row = mysqli_fetch_assoc($query_result)){
  $_SESSION['room_name'] = $row['room_name'];
  $room_name = $_SESSION['room_name'];
echo " <tr>
 <td align = 'center'>".$_SESSION['first_name']." ".$_SESSION['last_name']."</td>
 <td align = 'center'>".$row['room_name']."</td>
 <td align = 'center'>".$row['date_of_booking']."</td>
<td align = 'center'>".$row['time_slot']."</td>
<td align = 'center'>".$row['booking_status']."</td>
<td align = 'center'><input type='submit' class='cancel' value='cancel' /></td>

</tr>";


}
 ?>
</table>
 </form></br>


<script type='text/javascript'>
$(document).ready(function() {
        $("#cancel").click(function() {

          var x = confirm('Do you want to cancel');

          if(x==true){

            $("#cancel_booking").submit();

          }

        });
  });

      </script>



<!--<form id='cancel_booking' action="cancel.php" method="post" >
<input type="button" name="cancel" id='cancel' value="cancel booking" />

</form> -->

<?php

}
//else{
  ?>

  <script type="text/javascript">

          $(document).ready(function(){
              $('#lab_timing').hide();
          $("#room_type").change(function(){

            var x= document.getElementById('room_type').value;
            //document.write(x);
            if(x =='LAB'){
            $('#class_timing').hide();

          $('#lab_timing').show();
        }
        else{
          $('#class_timing').show();

           $('#lab_timing').hide();
        }
        });
  });
      </script>

    <div class='searchDiv'>
  <form class="" action="search.php" id='Search' method="post" align = 'center'>
  </br></br>
   <select id='room_type' name='room-type' style = 'min-width: 150px;'>
      <option value="Class" selected>CLASS</option>
      <option value="LAB" >LAB</option>
    </select>


  <input type="date" name="cur_date" value="" placeholder="select date" required>

  <select id="class_timing" name="class_time_slot"  required>
        <option value="09.00-10.00">09.00-10.00</option>
        <option value="10.00-11.00">10.00-11.00</option>
        <option value="11.00-12.00">11.00-12.00</option>
        <option value="12.00-13.00">12.00-13.00</option>
        <option value="13.00-14.00">13.00-14.00</option>
        <option value="14.00-15.00">14.00-15.00</option>
        <option value="15.00-16.00">15.00-16.00</option>
        <option value="16.00-17.00">16.00-17.00</option>
        <option value="17.00-18.00">17.00-18.00</option>

  </select>

  <select id="lab_timing" name="lab_time_slot"  required>
        <option value="09.00-12.00">09.00-12.00</option>
        <option value="10.00-13.00">10.00-13.00</option>
        <option value="14.00-17.00">14.00-17.00</option>

  </select>

  <button type="submit" name="search" required>Search</button></p>

  </form>
</div>
</body>
<?php

//echo "<marquee><h4 class='disc' style='color:red;'>Disclaimer : 13.00-14.00hrs is for lunch no one is allowed to take class in this slot</h4></marquee>";


//echo "<form action='index.php'><input type='submit' value='Log out'  /></form>";
}
else {
  header('location: index.php');
}

 ?>

 <script type="text/javascript">


 $(document).ready(function(){

   $(".table").on('click','.cancel',function(){


         var decision = confirm('Do you want to cancel the booking??');

       if(decision==true){
        var currentRow=$(this).closest("tr");

        var col1=currentRow.find("td:eq(0)").text();
        var col2=currentRow.find("td:eq(1)").text();
        var col3=currentRow.find("td:eq(2)").text();
        var col4=currentRow.find("td:eq(3)").text();

        data = {
             name : col1,
             room_name : col2,
             date_of_booking : col3,
             time_slot : col4,
             value : 'cancel'


        };
        //console.log(data);

        $.ajax({
          type: "POST",
          url: "check_booking.php",
          data: data,
          success: function() {
            window.location.href='mail.php';
           history.go(0);
          }
        });
        return false;

      }

 });
 });

 </script>
</body>
</html>
