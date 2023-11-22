<?php include 'nav.php';?>
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
    
 

    // File-Upload
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $target_dir = "news/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check != false) {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $thumbnail_path = "news/thumbnails/" . basename($_FILES["fileToUpload"]["name"]);
                $thumbnail_size = 250;
                list($width, $height) = getimagesize($target_file);
                $thumb_width = $thumbnail_size;
                $thumb_height = intval($height * $thumbnail_size / $width);
                $thumb_image = imagecreatetruecolor($thumb_width, $thumb_height);
                $source_image = imagecreatefromjpeg($target_file);
                imagecopyresized($thumb_image, $source_image, 0, 0, 0, 0, $thumb_width, $thumb_height, $width, $height);
                imagejpeg($thumb_image, $thumbnail_path);
                imagedestroy($thumb_image);
                imagedestroy($source_image);
                echo "Beitrag erstellt.";
            } else {
                echo "Es gab einen Fehler beim Hochladen des Bildes.";
            }
        } else {
            echo "Die Datei ist kein Bild.";
        }
    }
       // Beitragsanzeige
       $posts = array(
        array(
            "title" => "Erster Beitrag",
            "date" => "19. November 2023",
            "image" => "news/thumbnails/image1.jpg",
            "text" => "Dies ist der erste Beitrag."
        ),
        array(
            "title" => "Zweiter Beitrag",
            "date" => "18. November 2023",
            "image" => "news/thumbnails/image1.jpg",
            "text" => "Dies ist der zweite Beitrag."
        ),
        array(
            "title" => (!empty($_POST["title"])) ? $_POST["title"] : "",
            "date" => (!empty($_POST["title"])) ? date('Y-m-d') : "",
            "image" => (!empty($_POST["title"])) ? $thumbnail_path : "",
            "text" => (!empty($_POST["title"])) ? $_POST["text"] : ""
        )
    );
    foreach ($posts as $post) {
      
        echo "<div><h2>" . $post["title"] . "</h2>";
        echo "<p>" . $post["date"] . "</p>";
        echo "<img src=\"" . $post["image"] . "\" alt=\"\">";
        echo "<p>" . $post["text"] . "</p></div>";
        
    }
    ?>
    <?php if(isset($_SESSION["userArr"])&&($_SESSION["userArr"]) == "Admin") :?>
    <form action="news.php" method="post" enctype="multipart/form-data">
        <h2>Beitrag erstellen</h2>
        <label for="title">Titel:</label>
        <input type="text" name="title" id="title" required><br>

        <label for="text">Text:</label>
        <textarea name="text" id="text" required></textarea><br>
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Hochladen" name="submit">
    </form>
    <?php endif?>
    </div>
</body>
</html>
