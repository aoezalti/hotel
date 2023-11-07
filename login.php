<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </script>
    <div id="nav-placeholder"></div>
    <?php
    include 'nav.php'; ?>
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
    $user                  = cleanUserInput($_POST["inputUsername"]);
    $password              = cleanUserInput($_POST["inputPassword"]);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (empty($user)) {
        $userError = "User fehlt";
    }
    
    if (empty($password)) {
        $passwordError = "Passwort fehlt";
   
    }

}

?>
<div class="main-div">
    <form method="post" class="col-2" action="login.php">

        <h3>Login</h3>
        <div class="form-group">
            <label class="username" for="inputUsername" style="font-weight: bold;">Benutzername</label>
            <input type="text" class="form-control border-primary <?php if (!empty($userError)) {echo "is-invalid";}?>" id="inputUsername" name="inputUsername" placeholder="Benutzername" value="<?php echo $user?>"/>
            <div class="invalid-feedback">
                  <?php echo $userError; ?>
                </div>
        </div>
        <div class="form-group">
            <label class="password" for="exampleInputPassword1" style="font-weight: bold;">Passwort</label>
            <input type="password" class="form-control border-primary <?php if (!empty($passwordError)) {echo "is-invalid";}?>" id="inputPassword" name="inputPassword" placeholder="Passwort"/>
            <div class="invalid-feedback">
                  <?php echo $passwordError; ?>
                </div>
        </div>
        <div class="row">
            <div class="col">
                <input class="btn btn-outline-danger" type="reset" value="Reset">
                <input class="btn btn-outline-primary" type="submit" value="Login">
            </div>
        </div>
    </form>
</div>


<?php 
if(!empty($user) && !empty($password)){
    echo "<h3>Welcome " . $user . "!</h3>"; 
}

?> 
<link rel="stylesheet" href="./style.css">

</html>