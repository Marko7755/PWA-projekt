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


if (isset($_POST['selectTitle']) && isset($_POST['action'])) {
    $selectedTitleValue = $_POST['selectTitle'];
    $action = $_POST['action'];

    list($selectedIdDB, $selectedTitle) = explode('|', $selectedTitleValue);

    if ($connection) {
        $findArticleQuery = "SELECT * FROM vijesti WHERE id = $selectedIdDB";
        $result = mysqli_query($connection, $findArticleQuery);
        if ($result) {
            $row = mysqli_fetch_array($result);

            if ($action == 'Promijeni') {
                require 'editForm.php';
            } else if ($action == 'Izbriši') {
                require 'deleteForm.php';
            }
        }
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['edit'])) {
        $selectedId = $_POST['selectedId'];
        $articleTitle = $_POST['articleTitle'];
        $briefContent = $_POST['briefContent'];
        $articleContent = $_POST['articleContent'];
        $articleCategory = $_POST['articleCategory'];
        $articleArchive = isset($_POST['articleArchive']) ? 1 : 0;

        // Handle file upload
        if ($_FILES['articlePicture']['name']) {
            $targetDir = "images/img/";
            $targetFile = $targetDir . basename($_FILES["articlePicture"]["name"]);
            move_uploaded_file($_FILES["articlePicture"]["tmp_name"], $targetFile);
            $articlePicture = $_FILES["articlePicture"]["name"];
        } else {
            $articlePicture = $_POST['existingPicture'];
        }


        $updateQuery = "UPDATE vijesti SET naslov='$articleTitle', sazetak='$briefContent', tekst='$articleContent', kategorija='$articleCategory', slika='$articlePicture',  arhiva='$articleArchive'
        WHERE id=$selectedId";

        if (mysqli_query($connection, $updateQuery)) {
            $notificationMessage = "Article updated successfully!";
            echo "<script type='text/javascript'>
                    alert('$notificationMessage');
                    window.location.href = 'administracija.php';
                </script>";
            exit();
        } else {
            $notificationMessage = "Error updating article: " . mysqli_error($connection);
            echo "<script type='text/javascript'>
            alert('$notificationMessage');
            window.location.href = 'administracija.php';
            </script>";
    exit();
        }
    }
    else if(isset($_POST['delete'])) {
        $selectedId = $_POST['selectedId'];

        $deleteQuery = "DELETE FROM vijesti WHERE id = $selectedId";
        if (mysqli_query($connection, $deleteQuery)) {
            $notificationMessage = "Article deleted successfully!";
            echo "<script type='text/javascript'>
            alert('$notificationMessage');
            window.location.href = 'administracija.php';
            </script>";
            exit();
        } else {
            $notificationMessage = "Error deleting article: " . mysqli_error($connection);
            echo "<script type='text/javascript'>
            alert('$notificationMessage');
            window.location.href = 'administracija.php';
            </script>";
            exit();
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
