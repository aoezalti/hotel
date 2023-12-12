<?php

// initializing variables
$username = "";
$email    = "";
$errors = array();

require_once("./dbaccess.php");

$connection = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

if (isset($_POST['registration'])) {
    // receive all input values from the form
    $username = mysqli_real_escape_string($connection, $_POST['user']);
    $mail = mysqli_real_escape_string($connection, $_POST['email']);
    $password_1 = mysqli_real_escape_string($connection, $_POST['password']);
    $password_2 = mysqli_real_escape_string($connection, $_POST['password_confirmation']);
    $firstname = mysqli_real_escape_string($connection, $_POST['inputVorname']);
    $lastname = mysqli_real_escape_string($connection, $_POST['inputNachname']);
    $isAdmin = 0;

    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($mail)) {
        array_push($errors, "Email is required");
    }
    if (empty($firstname)) {
        array_push($errors, "First name is required");
    }
    if (empty($lastname)) {
        array_push($errors, "Last name is required");
    }
    if (empty($password_1)) {
        array_push($errors, "Password is required");
    }
    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match");
    }

    $user_check_query = "SELECT * FROM users WHERE username='$username' OR mail='$mail' LIMIT 1";
    $result = mysqli_query($connection, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        if ($user['username'] === $username) {
            array_push($errors, "Username already exists");
        }

        if ($user['mail'] === $mail) {
            array_push($errors, "Email already exists");
        }
    }


    if (count($errors) == 0) {
        $password = password_hash($password_1, PASSWORD_DEFAULT);
        // prepared statement
        $sqlInsert = "INSERT INTO users(mail,firstname, lastname, password,isAdmin,username) VALUES (?,?,?,?,?,?)";
        $stmt = $connection->prepare($sqlInsert);
        $stmt->bind_param("ssssis", $em, $firstn, $lastn, $passw, $isAd, $usern);

        $em = $mail;
        $firstn = $firstname;
        $lastn = $lastname;
        $passw = $password;
        $isAd = $isAdmin;
        $usern = $username;

        if($stmt->execute()){
            echo "<h1>Success</h1>";
        }
        else {
            echo "<h1>Failed to insert</h1>";
        }
        $_SESSION['username'] = $username;
        $_SESSION['registered'] = "You are now registered!";

    }
}
    ?>