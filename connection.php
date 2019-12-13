<?php
session_start();

$server_name = "localhost";
$user_name = "root";
$password = '';
$db_name = "iiit_project";

$con = mysqli_connect($server_name,$user_name,$password,$db_name);
?>
<div class="header-wrapper" align='center'>
      <div class="site-name">
        <table align='center'><tbody><tr><td > <img src="Image\150dpi.png" height="90px" align='left' style='padding-left:0%;padding-top:5%;'></td><td>
          <h1 align='center'>भारतीय सूचना प्रौद्योगिकी संस्थान भागलपुर<br>Indian Institute of Information Technology Bhagalpur</h1>
        </td>
      </tr>
    </tbody>
  </table>
      </div>
    </div>
<body align= 'left' id = 'main'>

</body>
