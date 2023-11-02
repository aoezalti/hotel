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
        <div id="nav-placeholder"></div>
        <?php 
    include 'nav.php'; ?> 
      </head>
<div class="main-div">
    <form method="post">
            <h3>Login</h3>
            <div class="form-group">
                <label class="username" for="inputUsername"style="font-weight: bold;">Benutzername</label>
                <input type="text" class="form-control" id="inputUsername" placeholder="Benutzername">
            </div>
            <div class="form-group">
                <label class="password" for="exampleInputPassword1"style="font-weight: bold;">Passwort</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Passwort">
            </div>
           <button type ="submit" class="btn btn-primary">Login</button>     
        </form>
    </div>
    
<link rel="stylesheet" href="./style.css">
</html>