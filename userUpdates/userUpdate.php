<?php if (session_status() == PHP_SESSION_NONE) {
    session_start();
} ?>
<?php
require_once 'errorHandling.php';

require_once("./dbaccess.php");

$connection = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
$username = $_SESSION["userArr"];
$userDuplicate = false;
if (isset($_POST["userUpdate"])) {
    $update = "UPDATE users SET ";
    $id = getId($_SESSION["userArr"], $dbHost, $dbUsername, $dbPassword, $dbName);
    
    foreach ($_POST as $key => $value) {
        //take new username value for check that is performed later 
        if ($key === "username") {
            
                //check username duplicate 
                $user_check = "SELECT count(*) FROM users WHERE username=?";
                $prepStmt = $connection->prepare($user_check);

                $prepStmt->bind_param("s", $value);
                $prepStmt->execute();
                $prepStmt->bind_result($result);
                $prepStmt->store_result();
                $prepStmt->fetch(); // get the mysqli result
                
                if ($result != 0) {
                    echo "username duplicate";
                    $userDuplicate = true;
                }elseif(!empty($value)){
                    $_SESSION["userArr"] = $value;
                }
                
                
            }
        
        if (!empty($value) && $key != "userUpdate") {
            //if user wants to change password, compare input of old pw to pw in db
            if ($key === "passwordNew" && isset($_POST["passwordOld"])) {
                echo "Old password has to be set!";
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
                        $_SESSION["pwError"] = "Wrong value for old password";
                        
                    }
                } else {
                    $_SESSION["pwError"] =  "Passwords don't match criteria";
                }
                $_SESSION["pwChanged"] ="Password changed";
            }
        

            // store the keys in the $setFields array
            if ($key != "passwordOld" && $key != "passwordNew" && !$userDuplicate ) {
                $setFields[] = $key;
                $values[] = $value;
            }
            //echo "Field $key is set with value $value.<br>";
         else {
            $unsetFields[] = $key;
            //echo "Field $key is not set.<br>";
        }}
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
            var_dump($values);
            array_push($values, $id);
            // Bind parameters dynamically
            $stmt->bind_param($types, ...$values);


           
            
            $stmt->execute();
        }
    }
}

?>
