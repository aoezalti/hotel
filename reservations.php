<?php if (session_status() == PHP_SESSION_NONE) {
    session_start();
} ?>
<?php
include 'server.php';
require_once 'errorHandling.php';

require_once("./dbaccess.php");
function fetchRooms($dbHost, $dbUsername, $dbPassword, $dbName){
        $connection = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

        $select = "SELECT * FROM rooms";
        $prepStmt = $connection->prepare($select);
        $prepStmt->execute();
        $result = $prepStmt->get_result();
        $connection->close();
        return $result;

}

function getRoomIdByType($roomType,$dbHost, $dbUsername, $dbPassword, $dbName ){
    $connection = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

    $select = "SELECT id FROM rooms WHERE roomType=?";
    $prepStmt = $connection->prepare($select);
    $prepStmt->bind_param("s", $roomType);
    $prepStmt->execute();
    $prepStmt->bind_result($roomId);

    $prepStmt->fetch();
    $connection->close();
    return $roomId;

}

function getRoomPriceById($roomId,$dbHost, $dbUsername, $dbPassword, $dbName )
{
    $connection = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

    $select = "SELECT pricePerNight FROM rooms WHERE id=?";

    $prepStmt = $connection->prepare($select);
    $prepStmt->bind_param("i", $roomId);
    $prepStmt->execute();
    $prepStmt->bind_result($pricePerNight);
   
    $prepStmt->fetch();
    $connection->close();
    return $pricePerNight;
}

// neue Zimmerreservierung anlegen
    if(isset($_POST["reservation"])) {
        $connection = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
        $userId = getId($_SESSION["userArr"],$dbHost, $dbUsername, $dbPassword, $dbName);

        $roomId = getRoomIdByType($_POST["roomType"],$dbHost, $dbUsername, $dbPassword, $dbName);
        $checkIn = new DateTime($_POST["checkIn"]);
        $checkOut = new DateTime($_POST["checkOut"]);
        $breakfast = isset($_POST["breakfast"]);
        $parking = isset($_POST["parking"]);
        $pets = isset($_POST["pets"]);
        $duration = (($checkIn)->diff(($checkOut))->days);
        $totalPrice = getRoomPriceById($roomId,$dbHost, $dbUsername, $dbPassword, $dbName) * $duration;

        if($pets === true ){
            $totalPrice += 30;
        }

        if($parking === true ){
            $totalPrice += 10*$duration;
        }
        
        if($breakfast === true){
            $totalPrice += 20*$duration;
        }

        $checkIn = $checkIn->format('Y-m-d H:i:s');
        $checkOut = $checkOut->format('Y-m-d H:i:s');

        if(checkAvailability($checkIn, $checkOut,$_POST["roomType"],$dbHost, $dbUsername, $dbPassword, $dbName)){
        $sql = "INSERT INTO reservations (roomId, userId, checkIn, checkOut, breakfast, parking, pets, totalPrice) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param('iissiiid', $roomId, $userId, $checkIn, $checkOut, $breakfast, $parking, $pets, $totalPrice);

        // Execute the statement
        $stmt->execute();

        // Close the statement
        $stmt->close();}
        else{
            echo "<h3>Room not available for this period!</h3>";
        }
}

function fetchAllRooms($dbHost, $dbUsername, $dbPassword, $dbName)
{
    $connection = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

    $select = "SELECT * FROM rooms";
    $prepStmt = $connection->prepare($select);
    $prepStmt->execute();
    $result = $prepStmt->get_result();
    return $result;
}

// eine Liste aller eigener Reservierungen einsehen


// Reservierungen haben einen Status „neu“, „bestätigt“, oder „storniert“
function update_reservation_status($reservation, $status)
{
    $valid_statuses = array("new", "confirmed", "cancelled");
    if (!in_array($status, $valid_statuses)) {
        return "Error: Invalid status.";
    }
    $reservation["status"] = $status;
    return $reservation;
}
function fetchReservations($userID,$dbHost, $dbUsername, $dbPassword, $dbName){
    $connection = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

    $select = "SELECT reservations.checkIn, reservations.checkOut, reservations.breakfast, reservations.parking,reservations.pets,reservations.bookingTime,reservations.status,reservations.totalPrice,rooms.roomType FROM reservations JOIN rooms on reservations.roomID = rooms.id WHERE userID=?";
    $prepStmt = $connection->prepare($select);
    $prepStmt->bind_param("i", $userID);
    $prepStmt->execute();
    $prepStmt->bind_result($checkIn, $checkOut, $breakfast, $parking,$pets,$bookingTime,$status,$totalPrice,$roomType );

    $reservations = array();
    while($prepStmt->fetch()){
        $reservations[] = array(
            "start_date" => $checkIn,
            "end_date" => $checkOut,
            "breakfast" => $breakfast,
            "parking" => $parking,
            "pets" => $pets,
            "bookingTime" => $bookingTime,
            "status" => $status,
            "totalPrice" => $totalPrice,
            "roomType" => $roomType
        );
    }
    $connection->close();
    
    return view_reservations($reservations);
}
function view_reservations($reservations)
{
    if (count($reservations) == 0) {
        return "You have no reservations.";
    }
    $output = "<table class=\"table\">";
    $output .= "<tr>
    <th scope =\"col\">Start date</th><th scope =\"col\">End date</th><th scope =\"col\">Room Type</th><th scope =\"col\">Breakfast</th><th scope =\"col\">Parking</th><th scope =\"col\">Pets</th><th scope =\"col\">Status</th><th scope =\"col\">Total Prices</th></tr>";

    foreach ($reservations as $reservation) {
        $output .= "<tr>";
        $output .= "<td>" . $reservation["start_date"] . "</td>";
        $output .= "<td>" . $reservation["end_date"] . "</td>";
        $output .= "<td>" . $reservation["roomType"] . "</td>";
        $output .= "<td>" . ($reservation["breakfast"] ? "yes" : "no") . "</td>";
        $output .= "<td>" . ($reservation["parking"] ? "yes" : "no") . "</td>";
        $output .= "<td>" . ($reservation["pets"] ? "yes" : "no") . "</td>";
        $output .= "<td>" . $reservation["status"] . "</td>";
        $output .= "<td>" . "€ " .$reservation["totalPrice"] . "</td>";
        $output .= "</tr>";
    }

    $output .= "</table>";
    return $output;
}
function checkAvailability($checkIn, $checkOut,$roomType,$dbHost, $dbUsername, $dbPassword, $dbName){
    $connection = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);


    // get total available room count
    $select = "SELECT maxRoomCount FROM rooms WHERE roomType=?";
    $prepStmt = $connection->prepare($select);
    $prepStmt->bind_param("s", $roomType);
    $prepStmt->execute();
    $prepStmt->bind_result($roomCount);
    $prepStmt->fetch();
    $prepStmt->close();

    //get booking count for duration
    $select = "SELECT COUNT(*) FROM reservations WHERE checkIn >= ? AND checkOut <=? AND status=?";
    $prepStmt = $connection->prepare($select);
    $status = "confirmed";
    $prepStmt->bind_param("sss", $checkIn,$checkOut,$status);
    $prepStmt->execute();
    $prepStmt->bind_result($bookingCount);
    $prepStmt->fetch();
    $prepStmt->close();
    
    if($bookingCount<$roomCount){
        return true;
    }if($bookingCount>=$roomCount){
        return false;
    }



}

?>