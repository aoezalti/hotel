<?php session_start();?>
<!doctype html>
<html lang="en">
<?php 
        
        $_SESSION["loggedIn"] = false;
        ?>
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

  <style>
    h4{
      font-size: 35px;
    }
    p{
      font-size: 20px;
    }
  </style>

        <?php 
        
    
        session_unset();
        session_destroy();
        header('Location: index.php');
        ?>
      </style>
  </body>
</html>
