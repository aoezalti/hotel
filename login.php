<?php 
include 'errorHandling.php';
?>

<!DOCTYPE html>
<html lang="en">
<?php



?>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" 
    crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
    </script> 
    <div id="nav-placeholder"></div>
    
  </head>

<div class="main-div">
<?php if(!isset($_SESSION["userArr"])) : ?>
    <form method="POST" name="login" class="col-2" action="login.php">

        <h3>Login</h3>
        <div class="form-group">
            <label class="username" for="loginUsername" style="font-weight: bold;">Benutzername</label>
            <input type="text" class="form-control border-primary <?php if (!empty($userError)) {echo "is-invalid";}?>" id="loginUsername" name="loginUsername" placeholder="Benutzername" value="<?php if(!empty($user)) echo $user?>"/>
            <div class="invalid-feedback">
                  <?php echo $userError; ?>
                </div>
        </div>
        <div class="form-group">
            <label class="password" for="exampleloginPassword1" style="font-weight: bold;">Passwort</label>
            <input type="password" class="form-control border-primary <?php if (!empty($passwordError)) {echo "is-invalid";}?>" id="loginPassword" name="loginPassword" placeholder="Passwort"/>
            <div class="invalid-feedback">
                  <?php echo $passwordError; ?>
                </div>
        </div>
        <div class="row">

            <div class="col">
                <input class="btn btn-outline-danger" type="reset" value="Reset">
                <input class="btn btn-outline-primary" type="submit" value="Login">
            </div>
            <?php else: ?> 
                <div class="col">
                <?php 
                    echo "<h3>Welcome " . $_SESSION["userArr"] . "!</h3>"; 
                   
                    ?> 
                    <p>Login successful</p>
               
                    <a href="profile.php">view profile</a>
               
                <br>
                <form method="post" class="col-2" action="logout.php">
                    <input class="btn btn-outline-primary" type="submit" value="Logout">
                </form>
                </div>
            <?php endif ?>
        </div>
    </form>
</div>
<link rel="stylesheet" href="./style.css">

</html>