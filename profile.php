<?php
include 'nav.php';
include 'server.php';
include './userUpdates/userUpdate.php'
?>

<!doctype html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </script>
</head>

<body>
<div class="container-fluid">
    <div>
        <?php
        echo "<h1> Welcome " . $_SESSION["userArr"] . "</h1>";
        ?>
        <?php if ($_SESSION["isAdmin"] === 0) :; ?>
        <h3> Profile overview </h3>

        <?php
        fetchUser($_SESSION["userArr"], $dbHost, $dbUsername, $dbPassword, $dbName);
        echo "<h4> User: " . $_SESSION["userArr"] . "</h4>";
        echo "<h4> Salutation: " . $_SESSION["anrede"] . "</h4>";
        echo "<h4> Firstname: " . $_SESSION["vorname"] . "</h4>";
        echo "<h4> Lastname: " . $_SESSION["nachname"] . "</h4>";
        echo "<h4> Mail: " . $_SESSION["mail"] . "</h4>";
        ?>
    </div>
    <br><br><br>
    <div class="container">
        <form class="col-5" name="userUpdate" method="POST" action="profile.php">
            <h3>Update Profile</h3>
            <br>

            <div class="col-4">
                <div class="mb-2">
                    <select class="form-select border-secondary" class="form-control" aria-label="" name="salutation">
                        <option selected disabled>Salutation</option>
                        <option value="Ms.">Ms.</option>
                        <option value="Mr.">Mr.</option>
                        <option value="Mx.">Mx.</option>
                    </select>
                </div>
            </div>
            <div class="form-floating mb-2">
                <input class="form-control border-primary" id="firstname" class="form-control" type="text"
                       name="firstname" placeholder="" value=""/>
                <label for="firstname">Firstname</label>

            </div>

            <div class="form-floating mb-3">
                <input class="form-control border-primary" id="lastname" class="form-control" type="text"
                       name="lastname" placeholder="" value=""/>
                <label for="inputNachname">Lastname</label>

            </div>

            <div class="form-floating mb-3">
                <input class="form-control border-primary" id="username" class="form-control" type="text" name="username"
                       placeholder="" value=""/>
                <label for="username">Username</label>

            </div>

            <div class="form-floating mb-3">
                <input class="form-control border-primary" id="mail" class="form-control" type="email" name="mail"
                       placeholder="" value=""/>
                <label for="mail">E-Mail</label>

            </div>

            <div class="form-floating mb-3">
                <input class="form-control border-primary" id="pwnew" class="form-control" type="password"
                       name="passwordNew" placeholder="" value=""/>
                <label for="passwordNew">New Password</label>

            </div>
            <div class="form-floating mb-3">
                <input class="form-control border-primary" id="pwold" class="form-control" type="password"
                       name="passwordOld" placeholder="" value=""/>
                <label for="pwold">Old Password</label>

            </div>
            <div class="row">
                <div class="col">
                    <input class="btn btn-outline-danger" type="reset" value="Reset">
                    <input class="btn btn-outline-primary" type="submit" name="userUpdate" value="Update">
                </div>
            </div>

        </form>

    </div>

</body>
<div>
    <br>
    <?php elseif ($_SESSION["isAdmin"] === 1) :; ?>
        <?php 
        echo " <h4>Currently registered Users: " . getUserCount($dbHost, $dbUsername, $dbPassword, $dbName) ."</h4>"?>
        <a href="./userManagement.php" class="btn btn-primary" role="button">Manage Users</a>
        <?php 
        echo " <h4>New bookings: " . getBookingCount($dbHost, $dbUsername, $dbPassword, $dbName) ."</h4>"?>
        <a href="./bookingManagement.php" class="btn btn-primary" role="button">Manage Bookings</a>
    <?php endif ?>
</div>
<br>

</html>