<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">
    <title>Projekt</title>
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
            

    <section class="articles">

        <article class="hobbyDroneContainer">
            <div class="hobbyDronesHeader color">
                <a href="kategorija.php?category=Rekreativni dronovi">
                    <h1>Rekreativni dronovi</h1>
                </a>  
            </div>
            <section class="hobbyDroneRow">
                <?php      
                require 'connection.php'; 
                if($connection) {     
                    $query = "SELECT * FROM vijesti WHERE arhiva = 0 AND kategorija = 'Rekreativni dronovi' ORDER BY datum ASC, id DESC LIMIT 3;";
                    $result = mysqli_query($connection, $query);
                    
                    $queryForHr = "SELECT COUNT(id) AS 'brojHrova' FROM vijesti WHERE arhiva = 0 AND kategorija = 'Rekreativni dronovi';";
                    $resultHr = mysqli_execute_query($connection, $queryForHr);
                    $row = mysqli_fetch_array($resultHr);
                    $sumHr = $row['brojHrova'];     
                    $hrCounter = 0;

                    $numberOfArticles = $sumHr;

                    while($row = mysqli_fetch_array($result)){
                        echo "<article class=\"hobbyDroneArticle\">";
                        echo "<div class=\"image\">";
                        echo "<a href='clanak.php?id=".$row['id']."'>";
                        echo "<img src=\"images/img/" . $row['slika']."\">"; 
                        echo "</a></div>";

                        echo "<h2 class='title titleColor'>";
                        echo "<a href='clanak.php?id=".$row['id']."'>";
                        echo $row['naslov'];
                        echo "</a></h2>";       

                        echo "<h4 class='summaryText summaryTextColor'>";
                        echo "<a href='clanak.php?id=".$row['id']."'>";
                        echo $row['sazetak'];
                        echo "</a></h4>";
                  
                        if($hrCounter < $sumHr-1) {
                            echo "<hr>";
                            $hrCounter++;
                        }
                        
                        echo "</article>";

                    }

                    if($numberOfArticles < 3) {
                        for($i = 0; $i < (3 -$numberOfArticles); $i++) {
                            echo "<article class='invisibleArticle'></article>";
                        }
                    }

                }
                ?>
                </section>
                </article>

        <article class="businessDroneContainer">
            <div class="businessDroneHeader color">
                <a href="kategorija.php?category=Komercijalni dronovi">
                    <h1>Komercijalni dronovi</h1>
                </a>
            </div>
            <section class="businessDroneRow">
                <?php 
                    $query = "SELECT * FROM vijesti WHERE arhiva = 0 AND kategorija = 'Komercijalni dronovi' ORDER BY datum ASC, id DESC LIMIT 3;";
                    $result = mysqli_query($connection, $query);

                    $queryForHr = "SELECT COUNT(id) AS 'brojHrova' FROM vijesti WHERE arhiva = 0 AND kategorija = 'Komercijalni dronovi';";
                    $resultHr = mysqli_execute_query($connection, $queryForHr);
                    $row = mysqli_fetch_array($resultHr);
                    $sumHr = $row['brojHrova'];     
                    $hrCounter = 0;

                    $numberOfArticles = $sumHr;

                    while($row = mysqli_fetch_array($result)) {
                        echo "<article class='businessDroneArticle'>";
                        echo "<div class=\"image\">";
                        echo "<a href='clanak.php?id=".$row['id']."'>";
                        echo "<img src=\"images/img/" . $row['slika']."\">"; 
                        echo "</a></div>";

                        echo "<h2 class='title titleColor'>";
                        echo "<a href='clanak.php?id=".$row['id']."'>";    
                        echo $row['naslov'];
                        echo "</a></h2>";

                        echo "<h4 class='summaryText summaryTextColor'>";
                        echo "<a href='clanak.php?id=".$row['id']."'>";
                        echo $row['sazetak'];
                        echo "</a></h4>";

                        if($hrCounter < $sumHr-1) {
                            echo "<hr>";
                            $hrCounter++;
                        }

                        echo "</article>";
                    }

                    if($numberOfArticles < 3) {
                        for($i = 0; $i < (3 -$numberOfArticles); $i++) {
                            echo "<article class='invisibleArticle'></article>";
                        }
                    }

                ?>
            </section>
        </article>    

        <article class="otherNewsContainer marginReset">
            <div class="otherNewsHeader color">
                <a href="kategorija.php?category=Ostalo">
                    <h1>Ostalo</h1>
                </a>
            </div>

        <section class="otherNewsRow">
        <?php 
            $query = "SELECT * FROM vijesti WHERE arhiva = 0 AND kategorija = 'Ostalo' ORDER BY datum ASC, id DESC LIMIT 3;";
            $result = mysqli_query($connection, $query);

            $queryForHr = "SELECT COUNT(id) AS 'brojHrova' FROM vijesti WHERE arhiva = 0 AND kategorija = 'Ostalo';";
            $resultHr = mysqli_execute_query($connection, $queryForHr);
            $row = mysqli_fetch_array($resultHr);
            $sumHr = $row['brojHrova'];     
            $hrCounter = 0;

            $numberOfArticles = $sumHr;

            while($row = mysqli_fetch_array($result)) {
                echo "<article class='otherNewsArticle'>";
                echo "<div class='image'>";
                echo "<a href='clanak.php?id=".$row['id']."'>";
                echo "<img src=\"images/img/" . $row['slika']."\">";
                echo "</a></div>";

                echo "<h2 class='title titleColor'>";
                echo "<a href='clanak.php?id=".$row['id']."'>";
                echo $row['naslov'];
                echo "</a></h2>";

                echo "<h4 class='summaryText'>";
                echo "<div class='summaryTextColor'>";
                echo "<a href='clanak.php?id=".$row['id']."'>";
                echo $row['sazetak'];
                echo "</div></a></h4>";

                if($hrCounter < $sumHr-1) {
                    echo "<hr>";
                    $hrCounter++;
                }


                echo "</article>";

            }

            if($numberOfArticles < 3) {
                for($i = 0; $i < (3 -$numberOfArticles); $i++) {
                    echo "<article class='invisibleArticle'></article>";
                }
            }
            

        ?>
        </section>

        </article>

    </section>
       
 
       <footer>
            <article class="footerText">
            <p>Marko Gradiščaj</p>
            <p>mgradisca@tvz.hr</p>
            <p>2024</p>
            </article>
        </footer> 
   
        <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('logout') && urlParams.get('logout') === 'success') {
                alert('Uspješno ste odjavljeni!');
            }
        });
    </script>


</body>
</html>