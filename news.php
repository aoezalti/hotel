<?php 
include 'nav.php';
include 'server.php';
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>News-Beiträge</title>
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
<div class=container justify-content-left>
    <h1>News-Beiträge</h1>

    <?php
    fetchNews($dbHost,$dbUsername,$dbPassword,$dbName);
    ?>
    <?php if(isset($_SESSION["userArr"])&& isset($_SESSION["isAdmin"])) :?>
    <form action="news.php" name = "newsEntry" method="POST" enctype="multipart/form-data">
        <h2>Beitrag erstellen</h2>
        <label for="title">Titel:</label>
        <input type="text" name="title" id="title" required><br>

        <label for="text">Text:</label>
        <textarea name="text" id="text" required></textarea><br>
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="newsEntry" name="newsEntry">
    </form>
    <?php endif?>
    </div>
</body>
</html>
