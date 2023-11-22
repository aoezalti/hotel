<?php 

include 'reservations.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" 
    crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
    </script> 
</head>
<body>
<div class="container">
    <div class="row justify-content-left">
        
            <form class="col-5" name="reservation" method="POST" action="reservations.php">
                <h3>Reservierung</h3>
                
                <div class="form-floating mb-2">
                    <input class="form-control border-primary" type="date" name="start_date" id="start_date" required />
                    <label for="start_date">Check-in</label>

                </div>

                <div class="form-floating mb-3">
                    <input class="form-control border-primary" type="date" name="end_date" id="end_date" required />
                    <label for="end_date">Check-out</label>

                </div>

                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="breakfast" id="breakfast"/>
                    <label class="form-check-label" for="breakfast">include breakfast</label>

                </div>

                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="parking" id="parking"/>
                    <label class="form-check-label" for="parking">include parking</label>

                </div>

                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="pets" id="pets"/>
                    <label class="form-check-label" for="pets">include pets</label>

                </div>
                <br>
            
                <div class="row">
                    <div class="col">
                        <input class="btn btn-outline-danger" type="reset" value="Reset">
                        <input class="btn btn-outline-primary" type="submit" name="registration" value="Book">
                    </div>
                </div>

            </form>
    </div>
  
</div>
<div class="container">
<h3>Already booked reservations: 0</h3>
    </div>
    
</body>
</html>