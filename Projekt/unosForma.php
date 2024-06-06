<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">
    <script type="text/javascript" src="jquery-1.11.0.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script src="formValidation.js"></script>
    <title>Document</title>
</head>
<body>

<?php
    session_start();
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
        header('Location: login.php'); // Redirect to login page if not logged in
        exit;
    }

?>


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
            <script type="text/javascript">
                function confirmLogout(){
                    if(confirm("Jeste li sigurni da se želite odjaviti?")) {
                        window.location.href = 'logout.php';
                    }
                }
            </script>
        </header>
    </div>

<div class="centerVertically">
    <section class="newArticleForm">
        <form  action="skripta.php" name="input" method="post" enctype="multipart/form-data">
            <label for="title">Naslov vijesti:</label>
            <br>
            <input type="text" id="title" name="articleTitle">
            <br><br>
            <label for="nutshell">Kratki sadržaj vijesti (do 100 znakova)</label>
            <br>
            <textarea rows="10" cols="30" id="nutshell" name="briefContent"></textarea>
            <br><br>
            <label for="content">Sadržaj vijesti:</label>
            <br>
            <textarea rows="10" cols="30" id="content" name="articleContent"></textarea>
            <br><br>
            <label for="picture">Slika:</label>
            <br>
            <input type="file" id="picture" name="articlePicture" accept="image/jpg,image/gif, image/jpeg">
            <br><br>
            <label for="category">Kategorija:</label>
            <br>
            <select id="category" name="articleCategory">
                <option value="">-</option>
                <option value="Rekreativni dronovi">Rekreativni dronovi</option>
                <option value="Komercijalni dronovi">Komercijalni dronovi</option>
                <option value="Ostalo">Ostalo</option>
            </select>
            <br><br>
            <label for="archive">Spremiti u arhivu:</label>
            <br>
            <input type="checkbox" id="archive" name="articleArchive">
            <br>
            <div class="btnContainer">
                <input type="submit" name="accept" value="Prihvati">
                <input type="submit" name="cancel" value="Poništi">
            </div>
            
        </form> 
    </section>
</div>
    
    

    <footer>
        <article class="footerText">
            <p>Marko Gradiščaj</p>
            <p>mgradisca@tvz.hr</p>
            <p>2024</p>
        </article>
    </footer>


</body>
</html>