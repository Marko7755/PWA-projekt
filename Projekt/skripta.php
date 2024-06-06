<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <header>
            <div class="logoContainer">
                <a href="index.php">
                    <img src="images/img/logoT.png">
                </a>
            </div>
            <?php 
                require 'nav.html';
            ?>
        </header>
    </div>
<div class="centerVertically">
    <main class="articlePrint">
        <?php 
        if(isset($_POST['accept'])){
            if(isset($_POST['articleTitle']) && isset($_POST['briefContent']) 
                && isset($_POST['articleContent']) && isset($_FILES['articlePicture'])
                && isset($_POST['articleCategory'])) {

                $title = $_POST['articleTitle'];
                $briefContent = $_POST['briefContent'];
                $content = $_POST['articleContent'];
                $category = $_POST['articleCategory'];


                $textParagraphs = explode("\n", $content);
                $formattedText = '';
                foreach($textParagraphs as $paragraph) {
                    $formattedText .= '<p>' . $paragraph . '</p>';
                }


                $target_dir = 'images/';
                $target_file = $target_dir . basename($_FILES['articlePicture']['name']);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                // Check if image file is an actual image or fake image
                $check = getimagesize($_FILES['articlePicture']['tmp_name']);
                if($check !== false) {
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }

                // Check if file already exists
                /* $fileExists = false;
                if (file_exists($target_file)) {
                    $fileExists = true;
                    echo "Sorry, file already exists.";
                    $uploadOk = 0;
                } */

                /* // Check file size
                if ($_FILES['articlePicture']['size'] > 500000) { // 500KB max file size
                    echo "Sorry, your file is too large.";
                    $uploadOk = 0;
                } */

                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                    echo "Sorry, only JPG, JPEG, & GIF files are allowed.";
                    $uploadOk = 0;
                }

                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    echo "Sorry, your file was not uploaded.";
                } else {
                    // Sanitize file name
                    $safe_filename = preg_replace('/[^a-zA-Z0-9._-]/', '_', basename($_FILES['articlePicture']['name']));
                    $target_file = $target_dir . $safe_filename;

                    if (move_uploaded_file($_FILES['articlePicture']['tmp_name'], $target_file)) {
                        #echo "The file ". htmlspecialchars($safe_filename). " has been uploaded.";
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                        $uploadOk = 0;
                    }
                }
                ?>

                <div class="articleHeader">
                    <p class="category">
                        <?php echo $category; ?>
                    </p>
                    
                    <h1 class="title">
                        <?php echo $title; ?>
                    </h1>
                    <p>AUTOR: Marko Gradiščaj</p>
                    <p>OBJAVLJENO:<?php echo date('d.m.Y') ?></p>
                </div>
              
                <section class="pictureContainer">
                    <?php 
                        if ($uploadOk == 1) {
                            echo "<img src='" . htmlspecialchars($target_file) . "' alt='Article Image'>";
                        } else {
                            echo "<p>Image upload failed. Please try again.</p>";
                        }
                    ?>
                </section>

                <div class="articleContent">
                    <b><h3><?php echo $briefContent; ?></h3></b>
                    <p><?php echo $formattedText; ?></p>
                </div>

                <?php 
            } else {
                echo "<p>Form is incomplete. Please fill out all fields.</p>";
            }
        }
        else if(isset($_POST['cancel'])){
            header('Location: ' . 'unosForma.php');
            exit();
        }
        ?>
    </main>
</div>
    


    <?php 
        require 'unos.php';
    ?>





    <footer>
        <article class="footerText">
            <p>Marko Gradiščaj</p>
            <p>mgradisca@tvz.hr</p>
            <p>2024</p>
        </article>
    </footer>
</body>
</html>
