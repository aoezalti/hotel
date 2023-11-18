<?php

include 'errorHandling.php';
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
            <form class="col-5" name="create" method="post" action="registration.php">
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
                    <input class="form-control border-primary ?>" id="inputVorname" class="form-control" type="text" name="inputVorname" placeholder="e" required="true" value="" />
                    <label for="inputVorname">Vorname</label>

                </div>

                <div class="form-floating mb-3">
                    <input class="form-control border-primary  id=" inputNachname" class="form-control" type="text" name="inputNachname" placeholder="e" required="true" value="" />
                    <label for="inputNachname">Nachname</label>

                </div>

                <div class="form-floating mb-3">
                    <input class="form-control border-primary id=" user" class="form-control" type="text" name="user" placeholder="e" required="true" value="" />
                    <label for="user">Username</label>

                </div>

                <div class="form-floating mb-3">
                    <input class="form-control border-primary id=" email" class="form-control" type="email" name="email" placeholder="e" required="true" value="" />
                    <label for="email">E-Mail</label>

                </div>

                <div class="form-floating mb-3">
                    <input class="form-control border-primary <?php if (!empty($passwordCriterianotMet)) {
                                                                    echo "is-invalid";
                                                                } ?>" id="password" class="form-control" type="password" name="password" placeholder="e" required="true" />
                    <label for="password">Passwort</label>
                    <div class="invalid-feedback">
                        <?php if (!empty($passwordCriterianotMet)) echo $passwordCriterianotMet; ?>
                    </div>
                </div>

                <div class="form-floating mb-3">
                    <input class="form-control border-primary <?php if (!empty($passwordNotEqual)) {
                                                                    echo "is-invalid";
                                                                } ?>" id="password_confirmation" class="form-control" type="password" name="password_confirmation" placeholder="e" required="true" />
                    <label for="password_confirmation">Passwort erneut eingeben!</label>
                    <div class="invalid-feedback">
                        <?php if (!empty($passwordNotEqual)) echo $passwordNotEqual; ?>

                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <input class="btn btn-outline-danger" type="reset" value="Reset">
                        <input class="btn btn-outline-primary" type="submit" value="Submit">
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