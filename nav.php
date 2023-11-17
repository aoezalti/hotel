<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/png" href="https://www.technikum-wien.at/fhtw-logo.svg"/>
<title>Hotel Technikum</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
   <a class="navbar-brand" href="./index.php">
    <img src="https://www.technikum-wien.at/fhtw-logo.svg" alt="" width="80" height="70"> </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
   
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <style>
            .nav-item, .dropdown-item{
                font-size: larger;
            }
        </style>
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            More
          </a>
          <ul class="dropdown-menu">
            
            <li><a class="dropdown-item" href="./impressum.php">Impressum</a></li>
          </ul>
        </li>
        <!--<li class="nav-item">
          <a class="nav-link disabled" aria-disabled="true">Disabled</a>
        </li>-->
      </ul>
      <ul class="navbar-nav me-right">
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?php session_start(); 
       
            function cleanUserInput($input)
            {
            
                $input = trim($input);
                $input = stripslashes($input);
                $input = htmlspecialchars($input);
            
                return $input;
            }
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $user                  = cleanUserInput(isset($_POST["inputUsername"]));
                $password              = cleanUserInput(isset($_POST["inputPassword"]));
                $userArr[$user]        = $password; 
                $_SESSION["userArr"]   = $user;
                $_SESSION["loggedIn"]  = true;
            }
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                
                if (empty($user)) {
                    $userError = "User fehlt";
                }
                
                if (empty($password)) {
                    $passwordError = "Passwort fehlt";
                }
            
            }
            
            if(isset($_SESSION["loggedIn"])){
              echo "Welcome " . $_SESSION["userArr"] . "!";
            }
            else {
              echo "Login/Register";
            }
            ?>
            
          </a>
          
          <ul class="dropdown-menu">
           <?php if(isset($_SESSION["loggedIn"])) :?>
            <li><a class="dropdown-item" href="./logout.php">Logout</a></li>

            <?php else: ?> 
              <li><a class="dropdown-item" href="./login.php">Login</a></li>
              <?php endif ?>
            <li><a class="dropdown-item" href="./registration.php">Registrierung</a></li>
           
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>  

<link rel="stylesheet" href="./style.css">