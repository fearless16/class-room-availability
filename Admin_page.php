<!DOCTYPE html>
<title>Admin page</title>
<body id='admin' >
<link rel="stylesheet" href="style.css">
<link rel="stylesheet"  href="style1.css">
<?php
include("connection.php");

if(array_key_exists('admin',$_SESSION)){

echo "<form action='logout.php'><input type='submit' value='Log out'  id='logout'></form>";
?>



<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>-->
<script src="jqueryFiles.js"></script>
<script type="text/javascript">

$(document).ready(function(){

$('#Change_routine').click(function(){



});



});

</script>


<div id="navigation">

 <ul>
   <li><a class="active"  href='xlToPHP.php' id='Change_routine'>Change routine</a></li>
   <li><a href="pending_request.php" id='Pending_request'>Pending Request</a></li>
   <li><a href='show_bookings.php' id='bookings'>Check bookings</a></li>
   <li><a href="details.php" id='book'>Book</a></li>
 </ul>
</div>
<?php }

else{
//echo $_SESSION['mail_id'];
 header('location:index.php');
}

?>
</body>
</html>
