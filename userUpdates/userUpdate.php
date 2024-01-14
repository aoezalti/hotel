<?php if (session_status() == PHP_SESSION_NONE) {
    session_start();
} ?>
<?php
require_once 'errorHandling.php';

require_once("./dbaccess.php");

$connection = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
$username = $_SESSION["userArr"];

if (isset($_POST["userUpdate"])) {

    $update = "UPDATE users SET ";
    $id = getId($_SESSION["userArr"], $dbHost, $dbUsername, $dbPassword, $dbName);
    foreach ($_POST as $key => $value) {
        if (!empty($value) && $key != "userUpdate") {
            //if user wants to change password, compare input of old pw to pw in db
            if ($key === "passwordNew") {
                if (checkPasswordHealth(cleanUserInput($_POST["passwordNew"]))) {
                    $select = "SELECT password FROM users WHERE id=?";
                    $prepStmt = $connection->prepare($select);

                    $prepStmt->bind_param("i", $id);

                    $prepStmt->execute();
                    $prepStmt->bind_result($prevPassword);
                    $prepStmt->store_result();
                    $prepStmt->fetch();
                    $passwordOld = cleanUserInput($_POST["passwordOld"]);

                    //verify
                    if (password_verify($passwordOld, $prevPassword)) {
                        $value = password_hash(cleanUserInput($_POST["passwordNew"]), PASSWORD_DEFAULT);
                        $key = "password";
                    } elseif (!password_verify($passwordOld, $prevPassword)) {
                        echo "<h1> Wrong value for old password</h1>";
                        header("location: ./profile.php");
                    }
                } else {
                    echo "<h1>Passwords don't match criteria</h1>";
                }
            }
            // store the keys in the $setFields array
            if ($key != "passwordOld" && $key != "passwordNew") {
                $setFields[] = $key;
                $values[] = $value;
            }
            //echo "Field $key is set with value $value.<br>";
        } else {
            $unsetFields[] = $key;
            //echo "Field $key is not set.<br>";
        }
    }


    if (!empty($setFields) && !empty($values)) {



        $sqlFields = implode(',', $setFields);


// Build the UPDATE query
        $updateStmt = "UPDATE users SET ";

        foreach ($setFields as $field) {
            $updateStmt .= "$field = ?, ";
        }

// Remove the trailing comma and space
        $updateStmt = rtrim($updateStmt, ", ");

        $updateStmt .= " WHERE id= ?";

// Prepare the statement
        $stmt = $connection->prepare($updateStmt);

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
            //for id
            $types .= 'i';

            array_push($values, $id);
            // Bind parameters dynamically
            $stmt->bind_param($types, ...$values);

            // Execute the statement
            $result = $stmt->execute();


        }
    }
}
?>