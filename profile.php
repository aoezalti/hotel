<?php
include 'nav.php';
?>

<!doctype html>
<html lang="en">
<?php

if (isset($_POST["update"]) && $_SESSION["userArr"]=="Testuser") {
  
header("Location: profile.php"); 


  if (strlen($_POST["vorname"]) > 0) {
    $_SESSION["vorname"] = htmlspecialchars($_POST["vorname"]);
  }

  if (strlen($_POST["nachname"]) > 0) {
    $_SESSION["nachname"] = htmlspecialchars($_POST["nachname"]);
  }

  if (strlen($_POST["mail"]) > 0) {
    $_SESSION["mail"] = htmlspecialchars($_POST["mail"]);
  }

  if (strlen($_POST["user"]) > 0) {
    $_SESSION["userArr"] = htmlspecialchars($_POST["user"]);
  }
  if (isset($_POST["anrede"]) > 0) {
    $_SESSION["anrede"] = htmlspecialchars($_POST["anrede"]);
  }
}
?>



<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  </script>
</head>

<body>
  <div class="container">
    <?php
    echo "<h1> Welcome " . $_SESSION["userArr"] . "</h1>";
    ?>
    <?php if($_SESSION["userArr"] !="Admin") : ;?> 
    <h3> Profile overview </h3>

    <?php
    if($_SESSION["userArr"]== "Testuser"){
    echo "<h4> User: " . $_SESSION["userArr"] . "</h4>";
    echo "<h4> Salutation: " . $_SESSION["anrede"] . "</h4>";
    echo "<h4> Firstname: " . $_SESSION["vorname"] . "</h4>";
    echo "<h4> Lastname: " . $_SESSION["nachname"] . "</h4>";
    echo "<h4> Mail: " . $_SESSION["mail"] . "</h4>";}
    ?>
  </div>
  <br><br><br>
  <div class="container">
    <form class="col-5" name="updateUser" method="POST" action="profile.php">
      <h3>Update Profile</h3>
      <br>

      <div class="col-4">
        <div class="mb-2">
          <select class="form-select border-secondary" class="form-control" aria-label="" name="anrede">
            <option selected disabled>Salutation</option>
            <option value="Frau">Ms.</option>
            <option value="Herr">Mr.</option>
            <option value="Divers">Mx.</option>
          </select>
        </div>
      </div>
      <div class="form-floating mb-2">
        <input class="form-control border-primary" id="inputVorname" class="form-control" type="text" name="vorname" placeholder="" value="" />
        <label for="inputVorname">Firstname</label>

      </div>

      <div class="form-floating mb-3">
        <input class="form-control border-primary" id="inputNachname" class="form-control" type="text" name="nachname" placeholder="" value="" />
        <label for="inputNachname">Lastname</label>

      </div>

      <div class="form-floating mb-3">
        <input class="form-control border-primary" id=" user" class="form-control" type="text" name="user" placeholder="" value="" />
        <label for="user">Username</label>

      </div>

      <div class="form-floating mb-3">
        <input class="form-control border-primary" id=" email" class="form-control" type="email" name="mail" placeholder="" value="" />
        <label for="email">E-Mail</label>

      </div>
      <div class="row">
        <div class="col">
          <input class="btn btn-outline-danger" type="reset" value="Reset">
          <input class="btn btn-outline-primary" type="submit" name="update" value="update">

        </div>
      </div>

    </form>

  </div>

</body>
<?php elseif($_SESSION["userArr"] === "Admin") :  ?>
  <h4>Currently registered Users: 1</h4>
<?php endif ?>
</html>