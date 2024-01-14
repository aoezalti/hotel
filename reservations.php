<?php
include
'nav.php';
?>
<?php
// neue Zimmerreservierung anlegen
function create_reservation($start_date, $end_date, $breakfast, $parking, $pets)
{
    if ($end_date <= $start_date) {
        return "Error: End date must be greater than start date.";
    }
    $reservation = array(
        "start_date" => $start_date,
        "end_date" => $end_date,
        "breakfast" => $breakfast,
        "parking" => $parking,
        "pets" => $pets,
        "status" => "new"
    );
    return $reservation;
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