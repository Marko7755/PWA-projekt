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


    <section class="categoryArticles color">
        <article class="newsCategoryContainer">
            <?php 
                require 'connection.php';

                if($connection) {
                    if(isset($_GET['category'])) {
                        $kategorija = $_GET['category'];   

                        $headerColorClass = '';
                        $titleColorClass = '';
                        $summaryTextColorClass = '';
                        if($kategorija == 'Rekreativni dronovi') {
                            $headerColorClass = $titleColorClass = $summaryTextColorClass = "hobbyDronesColor";
                        }
                        else if($kategorija == 'Komercijalni dronovi') {
                            $headerColorClass = $titleColorClass = $summaryTextColorClass = 'businessDronesColor';
                        }
                        else if($kategorija == 'Ostalo') {
                            $headerColorClass = $titleColorClass = $summaryTextColorClass = 'otherNewsColor';
                        }

                       
                        echo "<div class='newsCategoryHeader " . $headerColorClass ."'>";                       
                        echo"<h1>$kategorija</h1>";
                        echo "</div>";

                        ?>

                        <section class="newsCategoryRow">
                        <?php    
                        $query = "SELECT * FROM vijesti WHERE kategorija = '$kategorija' ORDER BY datum ASC, id DESC;";
                        $result = mysqli_execute_query($connection, $query);

                        $queryForHr = "SELECT COUNT(id) AS 'brojHrova' FROM vijesti WHERE kategorija = '$kategorija';";
                        $resultHr = mysqli_execute_query($connection, $queryForHr);
                        $row = mysqli_fetch_array($resultHr);
                        $sumHr = $row['brojHrova'];     
                        $hrCounter = 0;


                            $numberOfArticles = $sumHr;
                        
                            while($row = mysqli_fetch_array($result)) {
                            echo "<article class=\"newsCategoryArticle\">";
                            echo "<div class=\"image\">";
                            echo "<a href='clanak.php?id=".$row['id']."'>";
                            echo "<img src=\"images/img/" . $row['slika']."\">"; 
                            echo "</a></div>";

                            echo "<h2 class='title " . $titleColorClass . "'>";
                            echo "<a href='clanak.php?id=".$row['id']."'>";
                            echo $row['naslov'];
                            echo "</a></h2>";       

                            echo "<h4 class='summaryText " . $summaryTextColorClass . "'>";
                            echo "<a href='clanak.php?id=".$row['id']."'>";
                            echo $row['sazetak'];
                            echo "</a></h4>";

                            if($hrCounter < $sumHr-1) {
                                echo "<hr>";
                                $hrCounter++;
                            }

                            echo "</article>";

                        }

                        if($numberOfArticles % 3 != 0) {
                            $remainder = floor($numberOfArticles / 3);
                            $helper = $numberOfArticles - ($remainder * 3);  //broj artikala u zadnjem retku
                            $invisibleArticles = (3 - $helper);
                            for($i = 0; $i < $invisibleArticles; $i++) {
                                echo "<article class='invisibleArticle'></article>";
                            }
                        }

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


</body>
</html>