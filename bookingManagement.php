<?php
include 'nav.php';
include 'server.php';
include './userUpdates/adminUpdate.php';


if($_SERVER["REQUEST_METHOD"] == "POST"){
    require_once("./dbaccess.php");
    $connection = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
    // Get the bookingID and status from the $_POST variables

   
    $bookingID = $_POST['bookingID'];
    $status = $_POST['status'];

    // Prepare the SQL statement
    $stmt = $connection->prepare("UPDATE reservations SET status = ? WHERE id = ?");
    
    // Bind the status and bookingID to the SQL statement
    $stmt->bind_param("si", $status, $bookingID);

    // Execute the SQL statement
    $stmt->execute();

    // Close the statement and connection
    $stmt->close();
    $connection->close();
}
?>

<!doctype html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </script>
</head>

<body>
<div class="container-fluid">
    <table class="table table-striped">
        <div class="table responsive">
            
            <tbody>
            <?php
            $result = getAllBookings($dbHost, $dbUsername, $dbPassword, $dbName);
            $rows = $result;

            // Define the table headers
            $headers = array("bookingID","start_date", "end_date", "breakfast", "parking", "pets", "bookingTime", "status", "totalPrice", "userID", "roomType");
            
            // Generate the table
            echo "<table>";
            echo "<thead><tr>";
            foreach ($headers as $header) {
                echo "<th>$header</th>";
            }
            echo "<th>Update Status</th>";
            echo "</tr></thead>";
            echo "<tbody>";
            foreach ($rows as $row) {
                echo "<tr>";
                foreach ($headers as $header) {
                    echo "<td class=\"$header\">" . $row[$header] . "</td>";
                }
                echo "<td>";
                echo "<form method='post' action='bookingManagement.php'>";
                echo "<input type='hidden' name='bookingID' value='" . $row['bookingID'] . "'>";
                echo "<select name='status'><option value=\"confirmed\">confirm</option><option value=\"cancelled\">cancel</option></select>";
                echo "<input type='submit' value='Update'>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
            
            ?>
            </tbody>
        </div>
    </table>
</div>
<br><br>



</body>


<?php

function getAllBookings($dbHost, $dbUsername, $dbPassword, $dbName){

    $connection = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

    $select = "SELECT reservations.id, reservations.checkIn, reservations.checkOut, reservations.breakfast, reservations.parking,reservations.pets,reservations.bookingTime,reservations.status,reservations.totalPrice,reservations.userID,rooms.roomType FROM reservations JOIN rooms on reservations.roomID = rooms.id";
    $prepStmt = $connection->prepare($select);
    
    $prepStmt->execute();
    $prepStmt->bind_result($id,$checkIn, $checkOut, $breakfast, $parking,$pets,$bookingTime,$status,$totalPrice,$userID,$roomType );

    $reservations = array();
    while($prepStmt->fetch()){
        $reservations[] = array(
            "bookingID" => $id ,
            "start_date" => $checkIn,
            "end_date" => $checkOut,
            "breakfast" => $breakfast,
            "parking" => $parking,
            "pets" => $pets,
            "bookingTime" => $bookingTime,
            "status" => $status,
            "totalPrice" => $totalPrice,
            "userID" => $userID,
            "roomType" => $roomType
        );
    }
    $connection->close();

    return $reservations;
}


?>