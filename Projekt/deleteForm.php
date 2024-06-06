<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<section class="deleteFormContainer">
    <form action="" method="post" enctype="multipart/form-data" class="deleteForm">
                    <input type="hidden" name="selectedId" value="<?php echo $row['id']; ?>">
                    <input type="hidden" name="existingPicture" value="<?php echo $row['slika']; ?>">
                    <label for="title">Naslov vijesti:</label>
                    <br>
                    <input type="text" id="title" name="articleTitle" class="titleLabel" value="<?php echo $row['naslov']?>" readonly>
                    <br><br>
                    <label for="nutshell">Kratki sadržaj vijesti (do 50 znakova)</label>
                    <br>
                    <textarea rows="10" cols="30" id="nutshell" name="briefContent" readonly><?php echo $row['sazetak']?></textarea>
                    <br><br>
                    <label for="content">Sadržaj vijesti:</label>
                    <br>
                    <textarea rows="10" cols="30" id="content" name="articleContent" readonly><?php echo $row['tekst']?></textarea>
                    <br><br>
                    <label for="picture">Slika:</label>
                    <br>
                    <input type="file" id="picture" name="articlePicture" accept="image/jpg,image/gif, image/jpeg" value="<?php echo $row['slika']?>" disabled>
                    <br> <img src="images/img/<?php echo $row['slika'] ?>" style="width: 400px;">
                    <br><br>
                    <label for="category">Kategorija:</label>
                    <br>
                    <select id="category" name="articleCategory" class="categoryLabel" value="<?php echo $row['kategorija'] ?>" disabled>
                        <option value="Rekreativni dronovi" <?php if ($row['kategorija'] == 'Rekreativni dronovi') echo 'selected="selected"'; ?>>Rekreativni dronovi</option>
                        <option value="Komercijalni dronovi" <?php if ($row['kategorija'] == 'Komercijalni dronovi') echo 'selected="selected"'; ?>>Komercijalni dronovi</option>
                        <option value="Ostalo" <?php if ($row['kategorija'] == 'Ostalo') echo 'selected="selected"'; ?>>Ostalo</option>
                    </select>
                    <br><br>
                    <label for="archive">Spremiti u arhivu:</label>
                    
                    <br>
                    <?php 
                        if($row['arhiva'] == 0) {
                            echo '<input type="checkbox" id="archive" name="articleArchive" disabled>';
                        }  
                        else if($row['arhiva'] == 1) {
                            echo '<input type="checkbox" id="archive" name="articleArchive" checked disabled>';
                        } 
                    ?>
<br>
        <input type="submit" value="Izbriši" name="delete" class="deleteBtn color">
        </form>
</section>

</body>
</html>
