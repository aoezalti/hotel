<?php session_start();?>
<!doctype html>
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
    include 'nav.php';
    ?>
  </head>
  <body> 
    <h3>  Profile overview! </h3>
      <?php 
      echo "<h4> User: " .$_SESSION["userArr"] . "</h4>";
      ?>
      </style>
  </body>
</html>