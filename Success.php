<title>Registration Successful</title>

<?php

if(isset($_SESSION['new_user'])){
include('connection.php');

echo "<h2 align='center'>New user has been created successfully</h2>";

echo "<input type = 'button' onclick=window.location.href='logout.php' value='go to login'>";
}
else{

header('location: index.php');

}
 ?>
