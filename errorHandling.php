<?php

function cleanUserInput($input)
            {
            
                $input = trim($input);
                $input = stripslashes($input);
                $input = htmlspecialchars($input);
            
                return $input;
            }
//check user input
function checkRegistration(
    $password,
    $password_confirmation
) {
    if ($password_confirmation != $password) {
        $passwordNotEqual = "Die Passwörter müssen übereinstimmen";
    }
    $pwHealth = checkPasswordHealth($password);
    return array(

       isset($passwordNotEqual),
        $pwHealth
    );
}
function checkPasswordHealth($password)
{
    $upper = preg_match('@[A-Z]@', $password);
    $lower = preg_match('@[a-z]@', $password);
    $number = preg_match('@[0-9]@', $password);

    if ($upper === 0 || $lower === 0 || $number === 0 || strlen($password) < 5) {
        return false;
    }
    return true;
}

function checkPasswordEquality($password, $password_confirmation){
    if($password == $password_confirmation) {
        return true;
    }
    return false;
}


function checkLogin($user,$password){
    if(empty($user) || empty($password)){
        return false;
    }

    if($user === "Testuser" && $password === "testpw"){
        $_SESSION["anrede"] ="Mx.";
        $_SESSION["vorname"] = "Test";
        $_SESSION["nachname"] = "User";
        $_SESSION["mail"]   = "testuser@test.com";
        return true;
    }
    if($user === "Admin" && $password === "admin"){
        return true;
    }
}

?> 
