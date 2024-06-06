<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">
    <title>Document</title>
</head>
<body>
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
    <?php 
        require 'connection.php';

        if($connection) {
            if(isset($_GET['id'])) {
                $articleId = $_GET['id']; //dohvacanje id clanka iz index.php
                $findArticleQuery = "SELECT * FROM vijesti WHERE id = $articleId";
                $result = mysqli_query($connection, $findArticleQuery);
                
                while($row = mysqli_fetch_array($result)) {
                $date = $row['datum'];
                $title = $row['naslov'];
                $picture = $row['slika'];
                $briefContent = $row['sazetak'];
                $text = $row['tekst'];


                $textParagraphs = explode("\n", $text);
                    $formattedText = '';
                    foreach($textParagraphs as $paragraph) {
                        $formattedText .= '<p>' . $paragraph . '</p>';
                    }

                ?>

                <article class="wholeArticlePrintContainer">
                    <div class="title">
                        <h1> <?php echo $briefContent ?></h1>
                    </div>
                    <div class='date'> <?php echo $date?> </div>
                    <div class="picture">
                        <img src="images/img/<?php echo $picture?>">
                    </div>
                    <div class="text">
                        <?php echo $formattedText ?>
                    </div>
                </article>



    <?php
                }

            }
        }
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