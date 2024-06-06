<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">
    <title>Document</title>
</head>
<body>
<section class="editFormContainer">
    <form action="" method="post" enctype="multipart/form-data" class="editForm">
        <input type="hidden" name="selectedId" value="<?php echo $row['id']; ?>">
        <input type="hidden" name="existingPicture" value="<?php echo $row['slika']; ?>">
        <label for="title">Naslov vijesti:</label>
        <br>
        <input type="text" id="title" name="articleTitle" class="titleLabel" required value="<?php echo $row['naslov']?>">
        <br><br>
        <label for="nutshell">Kratki sadržaj vijesti (do 50 znakova)</label>
        <br>
        <textarea rows="10" cols="30" id="nutshell" name="briefContent"><?php echo $row['sazetak']?></textarea>
        <br><br>
        <label for="content">Sadržaj vijesti:</label>
        <br>
        <textarea rows="10" cols="30" id="content" name="articleContent"><?php echo $row['tekst']?></textarea>
        <br><br>
        <label for="picture">Slika:</label>
        <br>
        <input type="file" id="picture" name="articlePicture" accept="image/jpg,image/gif, image/jpeg" style="width: 50%;">
        <span id="file-name"><?php echo $row['slika']; ?></span>
        <br> 
        <img src="images/img/<?php echo $row['slika'] ?>" style="width: 400px;">
        <br><br>
        <label for="category">Kategorija:</label>
        <br>
        <select id="category" name="articleCategory" class="categoryLabel">
            <option value="Rekreativni dronovi" <?php if ($row['kategorija'] == 'Rekreativni dronovi') echo 'selected="selected"'; ?>>Rekreativni dronovi</option>
            <option value="Komercijalni dronovi" <?php if ($row['kategorija'] == 'Komercijalni dronovi') echo 'selected="selected"'; ?>>Komercijalni dronovi</option>
            <option value="Ostalo" <?php if ($row['kategorija'] == 'Ostalo') echo 'selected="selected"'; ?>>Ostalo</option>
        </select>
        <br><br>
        <label for="archive">Spremiti u arhivu:</label>
        <br>


        <?php 
        if($row['arhiva'] == 0) {
            echo '<input type="checkbox" id="archive" name="articleArchive">';
        } else if($row['arhiva'] == 1) {
            echo '<input type="checkbox" id="archive" name="articleArchive" checked>';
        }
        ?>
        <br>
        <input type="submit" value="Promijeni" name="edit" class="submitBtn color">
    </form>
</section>

</body>
</html>
