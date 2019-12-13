<title>Import status</title>
<link rel="stylesheet" href="style.css">
<?php
// Load the database configuration file
error_reporting(0);
include_once 'connection.php';

if(isset($_POST['importSubmit'])){

    // Allowed mime types
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');

    // Validate whether selected file is a CSV file
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){


        // If the file is uploaded
        if(is_uploaded_file($_FILES['file']['tmp_name'])){

            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');

            // Skip the first line
            fgetcsv($csvFile);

            // Parse data from CSV file line by line
              mysqli_query($con,"DELETE from routine;");

            while(($line = fgetcsv($csvFile)) !== FALSE){
                // Get row data
                $day   = $line[0];
                $time_slot  = $line[1];
                $room_name  = $line[2];
                $mail_id = $line[3];
                $branch = $line[4];
                $subject_code = $line[5];
                $year = $line[6];
                // Check whether member already exists in the database with the same email
              //  $prevQuery = "SELECT id FROM members WHERE email = '".$line[1]."'";
              //  $prevResult = $con->query($prevQuery);

              /*  if($prevResult->num_rows > 0){
                    // Update member data in the database
                    $con->query("UPDATE test SET c1 = '".$name."', c2 = '".$phone."', c3 = '".$status."', c4 = NOW() ,c5 = '0'");
                }else{*/
                    // Insert member data in the database
                    $con->query("INSERT INTO routine VALUES ('$day', '$time_slot', '$room_name', '$mail_id','$branch','$subject_code','$year')");
                //}
            }

            // Close opened CSV file

            echo "<h2 align='center'>Routine updated successfully</h2>";
            fclose($csvFile);

            $qstring = '?status=succ';
        }else{
            $qstring = '?status=err';
        }
    }
    else{
        $qstring = '?status=invalid_file';

        echo "<h3 style='text-align:center;'>Invalid file type</h3>";
    }

    echo "<input type=button onclick='javascript:history.go(-2)' value='back' id='back'>";
}

// Redirect to the listing page
