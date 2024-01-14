<?php if (session_status() == PHP_SESSION_NONE) {
    session_start();
} ?>
<?php
require_once 'errorHandling.php';

require_once("./dbaccess.php");

$connection = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);


if (isset($_POST["adminUpdate"])) {
    $update = "UPDATE users SET ";
    if (!isset($_POST["username"])) {
        echo "Please select a username from the dropdown!";
    }
    $id = getId($_POST["username"], $dbHost, $dbUsername, $dbPassword, $dbName);
    foreach ($_POST as $key => $value) {
        if (!empty($_POST[$key]) && $key != "adminUpdate" && $key != "username") {
            if ($key === "passwordNew") {
                $key = "password";
                if (checkPasswordHealth(cleanUserInput($value))) {
                    $value = password_hash(cleanUserInput($value), PASSWORD_DEFAULT);
                } else {
                    echo "Cannot change password.";
                }
            }
            if ($key === "newUsername") {
                $key = "username";
            }
            // store the keys in the $setFields array
            $setFields[] = $key;
            $values[] = $value;
            //echo "Field $key is set with value $value.<br>";
        } else {
            $unsetFields[] = $key;
            //echo "Field $key is not set.<br>";
        }
    }
    $setFieldsUnique = array_unique($setFields);
    $sqlFields = implode(',', $setFieldsUnique);

// Build the UPDATE query
    $updateStmt = "UPDATE users SET ";

    foreach ($setFieldsUnique as $field) {
        $updateStmt .= "$field = ?, ";
    }

    $updateStmt = rtrim($updateStmt, ", ");

    $updateStmt .= " WHERE id = ?";

// Prepare the statement
    $stmt = $connection->prepare($updateStmt);

    if ($stmt) {
        // Dynamically bind parameters for each field
        $types = '';

        foreach ($setFieldsUnique as $value) {
            // Determine the data type and add to $types
            if (is_int($value)) {
                $types .= 'i'; // Integer
            } elseif (is_float($value)) {
                $types .= 'd'; // Double
            } else {
                $types .= 's'; // String
            }
        }
        //for id
        $types .= 'i';

        array_push($values, $id);
        $stmt->bind_param($types, ...$values);

        $result = $stmt->execute();

    }
}