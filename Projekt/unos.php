<?php 
     if(isset($_POST['accept'])){
        if($uploadOk == 1) {
            require 'connection.php';

            if($connection){
                if(isset($_POST['articleArchive'])){
                    $archive = 1;
                }
                else{
                    $archive = 0;
                }
    
                $date = date('d.m.Y');
                $picture = $_FILES['articlePicture']['name'];
    
                $query = "INSERT INTO vijesti(datum, naslov, sazetak, tekst, slika, kategorija, arhiva)
                                      VALUES('$date', '$title', '$briefContent', '$content', '$picture', '$category', '$archive')";
                mysqli_query($connection, $query) or die('There was an error while trying to save a new article to Database.');
                mysqli_close($connection);
            }
        }
    }

    ?>