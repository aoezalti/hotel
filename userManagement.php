<?php
include 'nav.php';
include 'server.php';
include './userUpdates/adminUpdate.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $_SESSION["username"] = isset($_POST['username']);
    $_SESSION["salutation"] = isset($_POST['salutation']) ? $_POST["salutation"] : '';
    $_SESSION["firstname"] = $_POST['firstname'];
    $_SESSION["lastname"] = $_POST['lastname'];
    //$_SESSION["user"] = $_POST['user'];
    $_SESSION["mail"] = $_POST['mail'];
    $_SESSION["passwordNew"] = $_POST['passwordNew'];
    $_SESSION["userStatus"] = isset($_POST['userStatus']) ? true : false;
}
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
    <table class="table table-striped">
        <div class="table responsive">
            <thead>
            <tr>
                <th>User</th>
                <th>Mail</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Active?</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $result = fetchAllUsers($dbHost, $dbUsername, $dbPassword, $dbName);
            while ($row = $result->fetch_assoc()) {
                echo '<tr> 
              <td class="username">' . $row["username"] . '</td>
              <td class="mail">' . $row["mail"] . '</td>
              <td class="firstname">' . $row["firstname"] . '</td>
              <td class="lastname"> ' . $row["lastname"] . '</td>
              <td class="isActive"> ' . $row["isActive"] . '</td>
            </tr>';
                $usernames[] = $row["username"];
                $user[] = $row;
            }
            ?>
            </tbody>
        </div>
    </table>
</div>
<br><br>
<div class="container-fluid">
    <form class="col-5" name="adminUpdate" method="POST" action="userManagement.php">
        <h3>Update User Profile</h3>
        <br>
        <div class="col-4">
            <div class="mb-2">
                <select class="form-select border-secondary" class="form-control" aria-label="" name="username" required>
                    <option selected disabled value="">Username</option>
                    <?php
                    foreach ($usernames as $username => $value) {
                        $username = htmlspecialchars($username);
                        echo '<option value="' . $value . '">' . $value . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
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
            <input class="form-control border-primary" id="inputfirstname" class="form-control" type="text"
                   name="firstname" placeholder="" value=""/>
            <label for="inputfirstname">Firstname</label>

        </div>

        <div class="form-floating mb-3">
            <input class="form-control border-primary" id="inputlastname" class="form-control" type="text"
                   name="lastname" placeholder="" value=""/>
            <label for="inputlastname">Lastname</label>

        </div>

        <div class="form-floating mb-3">
            <input class="form-control border-primary" id="newUsername" class="form-control" type="text"
                   name="newUsername" placeholder="" value=""/>
            <label for="newUsername">Username</label>

        </div>

        <div class="form-floating mb-3">
            <input class="form-control border-primary" id=" email" class="form-control" type="email" name="mail"
                   placeholder="" value=""/>
            <label for="email">E-Mail</label>

        </div>

        <div class="form-floating mb-3">
            <input class="form-control border-primary" id=" pwnew" class="form-control" type="password"
                   name="passwordNew" placeholder="" value=""/>
            <label for="pwnew">New Password</label>

        </div>
        <div class="form-check">
            <input type="hidden" name="isActive" value="0">
            <input class="form-check-input" type="checkbox" value="1" id="userStatus" name="isActive" checked>
            <label class="form-check-label" for="isActive">
                User Active
            </label>
        </div>
        <br>
        <div class="form-row">
            <div class="col">
                <input class="btn btn-outline-danger" type="reset" value="Reset">
                <input class="btn btn-outline-primary" type="submit" name="adminUpdate" value="Update">
            </div>
        </div>

    </form>
</div>


</body>