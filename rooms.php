<?php include 'nav.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>About</title>
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
  <div class="row">
    <div class="col-md-4">
      <h2>Single Room</h2>
      <img src="assets/singleRoom.jpg" class="img-fluid" alt="Single Room">
      <p>Our Single Rooms are designed for comfort and convenience. They feature a cozy single bed, a desk for your work needs, and a modern bathroom. Perfect for solo travelers looking for a comfortable stay.</p>
    </div>
    <div class="col-md-4">
      <h2>Double Room</h2>
      <img src="assets/room-interior-hotel-bedroom.jpg" class="img-fluid" alt="Double Room">
      <p>Our Double Rooms offer a spacious setting with a comfortable double bed. The rooms are equipped with a work desk and a modern bathroom. Ideal for couples or individuals looking for a bit more space.</p>
    </div>
    <div class="col-md-4">
      <h2>Deluxe Room</h2>
      <img src="assets/luxurious-modern-bedroom-with-comfortable-bedding-elegance-generated-by-ai.jpg" class="img-fluid" alt="Deluxe Room">
      <p>Experience luxury in our Deluxe Rooms. These rooms feature a large, comfortable bed, a spacious work area, and a luxurious bathroom. Perfect for those who desire a touch of luxury during their stay.</p>
    </div>
  </div>

  <?php 
  if(isset($_SESSION["loggedIn"])){
    echo "<h3><a href=\"booking.php\">Book now!</a></h3>";
  }else {
    echo "<h3><a href=\"login.php\"> Log in and book now!</a></h3>";
  }
  ?>
  
</div>


</body>
</html>