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
<div class=container-fluid>
    <h1>News</h1>

    <?php
    fetchNews($dbHost,$dbUsername,$dbPassword,$dbName);
    ?>
<br>
   
<?php if(isset($_SESSION["userArr"])&&($_SESSION["isAdmin"]) == 1) :?>
    <form action="news.php" name = "newsEntry" method="POST" enctype="multipart/form-data">
    <form action="news.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
        <h2>Create News Entry</h2>
            <div class="form-group col-md-3">
        <label for="title" class="form-label">Titel:</label>
        <input class="form-control border-primary" type="text" name="title" id="title" required><br>
            </div>
        <div class="form-group col-md-3">
            <label for="text" class="form-label">Text</label>
            <textarea class="form-control border-dark" name="text" id="text" rows="4" required></textarea>
        </div>
            <br>
            <div class="form-group col-md-3">
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input class="btn btn-outline-primary" type="submit" value="Post News" name="newsEntry">
            </div>
        </div>
    </form>
    <?php endif?>
    </div>
</body>
</html>
