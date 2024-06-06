<?php
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    session_destroy(); 
    header('Location: index.php?logout=success');
    exit();
}
else {
    $confirmLogin = "<script>if(confirm('Niti jedan korisnik nije prijavljen, želite li se prijaviti?')) {
        window.location.href = 'login.php';
    }
    else {
        window.location.href = 'index.php';
    }
    </script>";

    echo $confirmLogin;
}
?>

