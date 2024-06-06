<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">
    <title>Administracija</title>
</head>
<body>


    
<?php
    session_start();
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
        header('Location: login.php'); // Redirect to login page if not logged in
        exit;
    }
?>

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
     
    <div class="centerVertically">
        <section class="editingAndDeletingFormContainer">
            <form action="editOrDeleteArticle.php" method="post">
                <label for="articleTitle">Izaberi naslov članka:</label>
                <br>
                <select id="articleTitle" name="selectTitle">
                <?php 
                    require 'connection.php';

                    if($connection) {
                        $query = "SELECT * FROM vijesti ORDER BY datum ASC";
                        $result = mysqli_query($connection, $query);
                        
                        while($row = mysqli_fetch_array($result)) {
                            echo "<option value='" . $row['id'] . "|" . $row['naslov'] . "'>" . $row['naslov'] . "</option>";
                        }
                    }
            ?>
                </select>
                <br>
                <div class="buttonContainer">
                    <input type="submit" value="Promijeni" name="action" class="editBtn">
                    <input type="submit" value="Izbriši" name="action" class="deleteBtn">
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