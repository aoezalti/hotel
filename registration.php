<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </script>
    <div id="nav-placeholder"></div>
    <?php
    include 'nav.php';
    ?>
</head>

<?php


function cleanUserInput($input)
{

    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);

    return $input;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $vorname               = cleanUserInput($_POST["vorname"]);
    $nachname              = cleanUserInput($_POST["nachname"]);
    $user                  = cleanUserInput($_POST["user"]);
    $email                 = cleanUserInput($_POST["email"]);
    $password              = cleanUserInput($_POST["password"]);
    $password_confirmation = cleanUserInput($_POST["password_confirmation"]);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["vorname"])) {
        $vornameError = "Der Vorname ist ein Pflichtfeld!";
    }
    if (empty($_POST["nachname"])) {
        $nachnameError = "Der Nachname ist ein Pflichtfeld!";
    }
    if (empty($_POST["user"])) {
        $userError = "Der User ist ein Pflichtfeld!";
    }
    if (empty($_POST["email"])) {
        $mailError = "Die Mail ist ein Pflichtfeld!";
    }
    if (empty($_POST["password"])) {
        $passwordError = "Das Passwort ist ein Pflichtfeld!";
    }
    if (empty($_POST["password_confirmation"])) {
        $passwordConfError = "Die Passwortbestätigung ist ein Pflichtfeld!";
    }

    if ($_POST["password_confirmation"] != $_POST["password"]) {
        $passwordNotEqual = "Die Passwörter müssen übereinstimmen";
    }


    
/*
regex check for password
*/
$upper = preg_match('@[A-Z]@',$password);
$lower = preg_match('@[a-z]@',$password);
$number = preg_match('@[0-9]@',$password);

if($upper || $lower || $number || strlen($password)<6 )
    $passwordCriterianotMet = "Das Passwort muss mindestens 8-stellig sein, Groß- und Kleinbuchstaben, sowie eine Zahl enthalten!";
}

?>
<div class="container">
    <div class="row justify-content-left">

        <form class="col-5" method="post" action="registration.php">
            <h3>Registrierung</h3>
            <div class="col-4">
                <div class="form-floating mb-2">
                    <select class="form-select border-secondary" class="form-control" aria-label="Default select example">
                        <option selected disabled>Anrede</option>
                        <option value="1">Frau</option>
                        <option value="2">Herr</option>
                        <option value="3">Divers</option>
                    </select>
                </div>
            </div>
            <div class="form-floating mb-2">
                <input class="form-control border-primary <?php if (!empty($vornameError)) {
                                                                echo "is-invalid";
                                                            } ?>" id="inputVorname" class="form-control" type="text" name="vorname" placeholder="e" required="true" value ="<?php echo $vorname;?>"/>
                <label for="inputVorname">Vorname</label>
                <div class="invalid-feedback">
                    <?php echo $vornameError; ?>
                </div>
            </div>

            <div class="form-floating mb-3">
                <input class="form-control border-primary <?php if (!empty($nachnameError)) {
                                                                echo "is-invalid";
                                                            } ?>" id="inputNachname" class="form-control" type="text" name="nachname" placeholder="e" required="true" value ="<?php echo $nachname;?>"/>
                <label for="inputNachname">Nachname</label>
                <div class="invalid-feedback">
                    <?php echo $nachnameError; ?>
                </div>
            </div>

            <div class="form-floating mb-3">
                <input class="form-control border-primary <?php if (!empty($userError)) {
                                                                echo "is-invalid";
                                                            } ?>" id="user" class="form-control" type="text" name="user" placeholder="e" required="true" value ="<?php echo $user;?>"/>
                <label for="user">Username</label>
                <div class="invalid-feedback">
                    <?php echo $userError; ?>
                </div>
            </div>

            <div class="form-floating mb-3">
                <input class="form-control border-primary <?php if (!empty($mailError)) {
                                                                echo "is-invalid";
                                                            } ?>" id="email" class="form-control" type="email" name="email" placeholder="e" required="true" value ="<?php echo $email;?>" />
                <label for="email">E-Mail</label>
                <div class="invalid-feedback">
                    <?php echo $mailError; ?>
                </div>
            </div>

            <div class="form-floating mb-3">
                <input class="form-control border-primary <?php if (!empty($passwordError) || !empty($passwordCriterianotMet)) {
                                                                echo "is-invalid";
                                                            } ?>" id="password" class="form-control" type="password" name="password" placeholder="e" required="true" />
                <label for="password">Passwort</label>
                <div class="invalid-feedback">
                    <?php echo $passwordError; ?>
                    <?php echo $passwordConfError; ?>
                    <?php echo $passwordCriterianotMet; ?>
                </div>
            </div>

            <div class="form-floating mb-3">
                <input class="form-control border-primary <?php if (!empty($passwordConfError) || !empty($passwordNotEqual)) {
                                                                echo "is-invalid";
                                                            } ?>" id="password_confirmation" class="form-control" type="password" name="password_confirmation" placeholder="e" required="true" />
                <label for="password_confirmation">Passwort erneut eingeben!</label>
                <div class="invalid-feedback">
                    <?php echo $passwordConfError; ?>
                    <?php echo $passwordNotEqual; ?>
                    
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <input class="btn btn-outline-danger" type="reset" value="Reset">
                    <input class="btn btn-outline-primary" type="submit" value="Submit">
                </div>
            </div>

        </form>

    </div>
</div>


</html>