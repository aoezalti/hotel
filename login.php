<?php 
include 'nav.php';
include 'server.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" 
    crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
    </script> 
  </head>
<div class="main-div">
<?php 
if(isset($_POST["login"])){
    if (checkLogin($_POST["loginUsername"], $_POST["loginPassword"])){
        $user                  = cleanUserInput($_POST["loginUsername"]);
        $password              = cleanUserInput($_POST["loginPassword"]);
       
      }
      else {
        if (empty($_POST["loginUsername"])) {
            $userError = "User fehlt";
        }
        if (empty($_POST["loginPassword"])) {
            $passwordError = "Passwort fehlt";
        }
      }
    }
?>    
<?php if(!isset($_SESSION["userArr"])) : ?>
    <div class=container justify-content-left>
    <form method="POST" name="login" class="form-horizontal" action="login.php">
        <br>
        <div class="row mb-3">
            <h1>Login</h1>
            <br>
            <label class="form-label" for="loginUsername">Username</label>
            <input type="text" class="form-control border primary w-auto" id="loginUsername" name="loginUsername" placeholder="Username" value=""/>
            <div class="invalid-feedback">
                  <?php echo $userError; ?>
                </div>
        </div>
        <div class="row mb-3">
            <label class="form-label" for="exampleloginPassword1">Password</label>
            <input type="password" class="form-control border primary w-auto" id="loginPassword" name="loginPassword" placeholder="Password"/>
            <div class="invalid-feedback">
                  <?php echo $passwordError; ?>
                </div>
        </div>
        <div class="row mb-3">
        <div class="col-sm-offset-2 col-sm-10">
                <input class="btn btn-outline-danger" type="reset" value="Reset">
                <input class="btn btn-outline-primary" type="submit" name="login" value="Login">
            </div> 
        </div>
</div>
            <?php else: ?> 
                <?php
                header("Location: profile.php");
                ?>
                <form method="POST" action="logout.php">
                    <input class="btn btn-outline-primary" type="submit" value="Logout">
                </form></div>
</div>
            <?php endif ?>
       <?php 
       if( (isset($_POST["login"])) && !checkLogin($_POST["loginUsername"], $_POST["loginPassword"])){
        echo "<div><h3>User not found, or password wrong</h3></div>";
       }
       ?>
    </form>
</div>
<link rel="stylesheet" href="./style.css">

</html>