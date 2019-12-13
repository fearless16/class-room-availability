<?php
include('connection.php');

if(isset($_SESSION['admin']))
unset($_SESSION['admin']);

if(isset($_SESSION['new_user']))
unset($_SESSION['new_user']);

session_destroy();

header('location: index.php');
 ?>
