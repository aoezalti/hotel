<?php

include 'nav.php';
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

        $passwordNotEqual,
        $pwHealth
    );
}
function checkPasswordHealth($password)
{
    $upper = preg_match('@[A-Z]@', $password);
    $lower = preg_match('@[a-z]@', $password);
    $number = preg_match('@[0-9]@', $password);

    if ($upper === 0 || $lower === 0 || $number === 0 || strlen($password) < 5) {
        $passwordCriterianotMet = "Das Passwort muss mindestens 5-stellig sein, jeweils einen Groß- und Kleinbuchstaben, sowie eine Zahl enthalten!";
    }
    return $passwordCriterianotMet;
}


function registrationSuccessful($passwordNotEqual, $pwHealth)
{
    if (empty($passwordNotEqual) && empty($pwHealth)) {
        $_SESSION["loggedIn"] =true; 
        $_SESSION["registered"] = true;
        return true;
    }
    return false;
}

function checkLogin($user,$password){
    if(!empty($user) && !empty($password)){
        $_SESSION["loggedIn"] = true; 
        $_SESSION["userArr"] = $user;
    }
    return true;
}

?> 
