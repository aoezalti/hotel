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
function getRoomIdByType($roomType){
    $connection = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

    $select = "SELECT * FROM rooms WHERE roomType=?";

    $prepStmt = $connection->prepare($select);
    $prepStmt->bind_param("s", $roomType);
    $prepStmt->execute();
    $prepStmt->bind_result($roomId);

    $roomId= $prepStmt->fetch();
    $connection->close();
    return $roomId;

}
// neue Zimmerreservierung anlegen
    if(isset($_POST["reservation"])) {
        $userId = getId($_SESSION["userArr"]);

        $connection = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
        $roomId = getRoomIdByType($_POST["roomType"]);
        $checkIn = $_POST["checkIn"];
        $checkOut = $_POST["checkOut"];
        $breakfast = isset($_POST["breakfast"]);
        $parking = isset($_POST["parking"]);
        $pets = isset($_POST["pets"]);
        $totalPrice = getRoomPriceById($roomId) * ($checkIn->diff($checkOut)) -1;


        $sql = "INSERT INTO reservations (roomId, userId, checkIn, checkOut, breakfast, parking, pets, totalPrice) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $connection->prepare($sql);

        $stmt->bind_param('iissiiid', $roomId, $userId, $checkIn, $checkOut, $breakfast, $parking, $pets, $totalPrice);

        // Execute the statement
        $stmt->execute();

        // Close the statement
        $stmt->close();
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
function view_reservations($reservations)
{
    if (count($reservations) == 0) {
        return "You have no reservations.";
    }
    $output = "";
    foreach ($reservations as $reservation) {
        $output .= "Start date: " . $reservation["start_date"] . "\n";
        $output .= "End date: " . $reservation["end_date"] . "\n";
        $output .= "Breakfast: " . ($reservation["breakfast"] ? "yes" : "no") . "\n";
        $output .= "Parking: " . ($reservation["parking"] ? "yes" : "no") . "\n";
        $output .= "Pets: " . ($reservation["pets"] ? "yes" : "no") . "\n";
        $output .= "Status: " . $reservation["status"] . "\n\n";
    }
    return $output;
}

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

?>