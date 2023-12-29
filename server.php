<?php if (session_status() == PHP_SESSION_NONE) {
    session_start();} ?>
<?php
include 'errorHandling.php';

// initializing variables
$username = "";
$email    = "";
$errors = array();

require_once("./dbaccess.php");

$connection = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

if (isset($_POST['registration'])) {
    // receive all input values from the form
    $username = cleanUserInput($_POST['user']);
    $mail = cleanUserInput($_POST['email']);
    $password_1 = cleanUserInput($_POST['password']);
    $password_2 = cleanUserInput($_POST['password_confirmation']);
    $firstname = cleanUserInput($_POST['inputVorname']);
    $lastname = cleanUserInput($_POST['inputNachname']);
    $salutation = cleanUserInput($_POST['salutation']);
    $isAdmin = 0;

    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($salutation)) {
        array_push($errors, "Salutation is required");
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
    if (!checkPasswordHealth($password_1,$password_2)) {
        array_push($errors, "Password doesn't match password criteria (atleast 5 chars,
        lower + uppercase, atleast one number)");
    }
    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match");
    }

    $user_check = "SELECT * FROM users WHERE username=? OR mail=? LIMIT 1";
    $prepStmt = $connection->prepare($user_check);

    $user = $username; // Define $uname before binding it
    $email = $mail;
    $prepStmt->bind_param("ss",$uname,$email);
    $prepStmt->execute();
    $result = $prepStmt->get_result(); // get the mysqli result
    $user = $result->fetch_assoc(); // fetch data

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
        $sqlInsert = "INSERT INTO users(mail,firstname, lastname, password,isAdmin,username, salutation) VALUES (?,?,?,?,?,?,?)";
        $stmt = $connection->prepare($sqlInsert);
        
        $em = $mail;
        $firstn = $firstname;
        $lastn = $lastname;
        $passw = $password;
        $isAd = $isAdmin;
        $usern = $username;
        $salut = $salutation;
        $stmt->bind_param("ssssiss", $em, $firstn, $lastn, $passw, $isAd, $usern, $salut);
        
        if($stmt->execute()){
            echo "<h1>Success</h1>";
        }
        else {
            echo "<h1>Failed to insert</h1>";
        }
        $_SESSION['username'] = $username;
        $_SESSION["userArr"] = $user;
        $_SESSION["loggedIn"] = true;
        $_SESSION["registered"] = true;
        $_SESSION["isAdmin"] = $isAdmin;

    }
    else {
        foreach ($errors as $error) {
            echo "$error <br>";
        }
    }
}

if(isset($_POST["login"])){
    // receive all input values from the form
    $user = cleanUserInput($_POST["loginUsername"]);
    $password1 = cleanUserInput($_POST["loginPassword"]);

    $select = "SELECT * FROM users WHERE username=?";
    $prepStmt = $connection->prepare($select);

    $uname = $user; // Define $uname before binding it
    $prepStmt->bind_param("s",$uname);

    $prepStmt->execute();
    $prepStmt->bind_result($id, $mail, $firstname, $lastname, $password2, $isAdmin, $isActive, $username, $salutation);
    
    //var_dump($prepStmt);

    echo "<ol>";
while($prepStmt->fetch()){
    echo "<ul>";
    echo "<li>" . $id . "</li>";
    echo "<li>" . $username . "</li>";
    echo "<li>" . $mail . "</li>";
    echo "<li>" . $password2 . "</li>";
    echo "</ul>";
}
echo "</ol>";
    if(password_verify($password1,$password2)){
        echo "<h1>correct</h1>";
        $_SESSION["userArr"] = $username;
        $_SESSION["loggedIn"] = true;
        $_SESSION["isAdmin"] = $isAdmin;
        }
    
    /*if(!password_verify($password1,$password2)){
        echo "<h1>not correct</h1>";
        echo $password2;
        echo $user;
        echo $firstname;
        echo $password1;
    }*/
    
}



if(isset($_POST["newsEntry"])){
    $title = cleanUserInput($_POST["title"]) ;
    $articleText  = cleanUserInput($_POST["text"]);
    $filepath = $_SESSION["filepath"];
    $author = $_SESSION["userArr"]; 
    $thumbnailpath = $_SESSION["thumbnailpath"];

    $sqlInsert = "INSERT INTO news(imageURL ,articleText , 	author, thumbnailPath ,title ) VALUES (?,?,?,?,?)";
    $stmt = $connection->prepare($sqlInsert);
    $stmt->bind_param("sssss", $filepath, $articleText, $author, $thumbnailpath, $title);
        
    if($stmt->execute()){
        echo "<h1>Success</h1>";
    }
    else {
        echo "<h1>Failed to insert</h1>";
    }


}
    ?>