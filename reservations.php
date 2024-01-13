<?php 
include 
'nav.php';
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" 
    crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
    </script> 
</head>
<?php
// neue Zimmerreservierung anlegen
function create_reservation($start_date, $end_date, $breakfast, $parking, $pets) {
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
function view_reservations($reservations) {
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
function update_reservation_status($reservation, $status) {
    $valid_statuses = array("new", "confirmed", "cancelled");
    if (!in_array($status, $valid_statuses)) {
        return "Error: Invalid status.";
    }
    $reservation["status"] = $status;
    return $reservation;
}
    ?>

    <!DOCTYPE html>
    <html lang="en">
    
    <body>
        <br><br><br>
<div class="container">        
        <?php 
        // Beispielaufrufe
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];
    $breakfast = isset($_POST["breakfast"]);
    $parking = isset($_POST["parking"]);
    $pets = isset($_POST["pets"]);
    $reservation = create_reservation($start_date, $end_date, $breakfast, $parking, $pets);
    echo "<h2>Reservierung erfolgreich angelegt</h2>";
    echo "Anreisetag: " . $_POST["start_date"] . "<br>";
    echo "Abreisetag: " . $_POST["end_date"] . "<br>";
    echo "Frühstück: " . ((!empty($_POST["breakfast"])) ? $_POST["breakfast"] : "" ) . "<br>";
    echo "Parkplatz: " . ((!empty($_POST["parking"])) ? $_POST["parking"] : "" ) . "<br>";
    echo "Haustiere: " . ((!empty($_POST["pets"])) ? $_POST["pets"] : "" ) . "<br>";
}

        ?>
</div>
</body>^
    </html>