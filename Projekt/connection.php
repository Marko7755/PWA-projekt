<?php
    /* header('Content-Type: text/html; charset=utf-8'); */
    $connection = mysqli_connect('localhost', 'root', '', 'projekt') or
                    die("Error while trying to connect to database!" . mysqli_connect_error());
    mysqli_set_charset($connection, "utf8");
?>
