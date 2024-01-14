<?php if (session_status() == PHP_SESSION_NONE) {
    session_start();
} ?>
<?php
require_once 'errorHandling.php';

require_once("./dbaccess.php");

$connection = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if (isset($_POST["update"])) {

    $update = "UPDATE users SET ";
    foreach ($_POST as $key => $value) {
        if (isset($_POST[$key]) && !empty($_POST[$key]) && $key != "adminUpdate") {
            if ($key === "passwordNew") {
                $key = "password";
                if (checkPasswordHealth(cleanUserInput($value))) {
                    $value = password_hash(cleanUserInput($value), PASSWORD_DEFAULT);
                }
                else {
                    echo "Cannot change password.";
                }
            }
            // store the key in the $setFields array
            $setFields[] = $key;
            $values[] = $value;
            echo "Field $key is set with value $value.<br>";
        } else {
            // Input field is not set, store the key in the $unsetFields array
            $unsetFields[] = $key;
            echo "Field $key is not set.<br>";
        }
    }
    $sqlFields = implode(',', $setFields);
    echo $sqlFields;

    $uname = $_SESSION["userArr"];

    $prepStmt->bind_param("s", $uname);

    $prepStmt->execute();
    $prepStmt->bind_result($id, $mail, $firstname, $lastname, $password2, $isAdmin, $isActive, $username, $salutation);

    while ($prepStmt->fetch()) {
        $passwordUpdate = $password2;
    }
//PW change
    if (!empty($_POST["passwordNew"]) && checkPasswordHealth(cleanUserInput($_POST["passwordNew"]))) {
            $passwordOld = cleanUserInput($_POST["passwordOld"]);
            //verify
            if (password_verify($passwordOld, $password2)) {
                $passwordUpdate = password_hash(cleanUserInput($_POST["passwordNew"]), PASSWORD_DEFAULT);
            }
        }
    }

// Build the UPDATE query
    $sql = "UPDATE users SET ";

    foreach ($setFields as $field) {
        if ($field != "adminUpdate" && $field != "update") {
            if ($field === "passwordNew") {
                $field = "password";
            }
            $sql .= "$field = ?, ";
        }
    }

// Remove the trailing comma and space
    $sql = rtrim($sql, ", ");

    $sql .= " WHERE username = ?";
    echo "<br> UPDATE" . $sql;
// Prepare the statement
    $stmt = $connection->prepare($sql);

// Check if the statement preparation was successful
    if ($stmt) {
        // Dynamically bind parameters for each field
        $types = '';

        foreach ($setFields as $value) {
            // Determine the data type and add to $types
            if (is_int($value)) {
                $types .= 'i'; // Integer
            } elseif (is_float($value)) {
                $types .= 'd'; // Double
            } else {
                $types .= 's'; // String
            }
        }
        //for username
        $types .= 's';
        echo "<br> Typesssss:" . $types;

        array_push($values, $username);
        // Bind parameters dynamically
        $stmt->bind_param($types, ...$values);

        // Execute the statement
        $result = $stmt->execute();


    }

?>