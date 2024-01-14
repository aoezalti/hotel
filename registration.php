<?php
include 'nav.php';
include 'server.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </script>
</head>

<div class="container">
    <div class="row justify-content-left">
        <?php if (!isset($_SESSION["registered"])) : ?>
            <form class="col-5" name="registration" method="POST" action="registration.php">
                <h3>Register</h3>
                <br>

                <div class="col-4">
                    <div class="mb-2">
                        <select name="salutation" class="form-select border-secondary" class="form-control" aria-label="">
                            <option selected disabled>Salutation</option>
                            <option value="Ms.">Ms.</option>
                            <option value="Mr.">Mr.</option>
                            <option value="Mx.">Mx.</option>
                        </select>
                    </div>
                </div>
                <div class="form-floating mb-2">
                    <input class="form-control border-primary" id="inputVorname" class="form-control" type="text" name="inputVorname" placeholder="" required="true" value="" />
                    <label for="inputVorname">Firstname</label>

                </div>

                <div class="form-floating mb-3">
                    <input class="form-control border-primary" id="inputNachname" class="form-control" type="text" name="inputNachname" placeholder="" required="true" value="" />
                    <label for="inputNachname">Lastname</label>

                </div>

                <div class="form-floating mb-3">
                    <input class="form-control border-primary" id=" user" class="form-control" type="text" name="user" placeholder="" required="true" value="" />
                    <label for="user">Username</label>

                </div>

                <div class="form-floating mb-3">
                    <input class="form-control border-primary" id=" email" class="form-control" type="email" name="email" placeholder="" required="true" value="" />
                    <label for="email">E-Mail</label>

                </div>

                <div class="form-floating mb-3">
                    <input class="form-control border-primary <?php if (!empty($pwCriteriaNotMet)) {
                                                                    echo "is-invalid";
                                                                } ?>" id="password" class="form-control" type="password" name="password" placeholder="" required="true" />
                    <label for="password">Password</label>
                    <div class="invalid-feedback">
                        <?php if (!empty($pwCriteriaNotMet)) echo $pwCriteriaNotMet ; ?>
                    </div>
                </div>

                <div class="form-floating mb-3">
                    <input class="form-control border-primary <?php if (!empty($pwNotEqual)) {
                                                                    echo "is-invalid";
                                                                } ?>" id="password_confirmation" class="form-control" type="password" name="password_confirmation" placeholder="" required="true" />
                    <label for="password_confirmation">Repeat Password!</label>
                    <div class="invalid-feedback">
                        <?php if (!empty($pwNotEqual)) echo $pwNotEqual ?>

                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <input class="btn btn-outline-danger" type="reset" value="Reset">
                        <input class="btn btn-outline-primary" type="submit" name="registration" value="Submit">
                    </div>
                </div>

            </form>
        <?php elseif (isset($_SESSION["registered"])) : ?>
            <h3>Registered successfully!</h3>
            <a href="profile.php">Go to profile</a>
        <?php endif ?>
    </div>
</div>

</html>