<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        if(isset($_GET['url'])) {
        $destination = $_GET['url'];
        header('Location: ' . $destination);
    } else {
        header('Location: index.php'); // Default page if destination is not set
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="jquery-1.11.0.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script src="loginFormValidation.js"></script>
    <link rel="stylesheet" href="css.css">
    <title>Login</title>

</head>
<body class="loginBackgroundColor">
<div class="centerVertically">   
    <section class="loginFormContainer">  
        <h2>Prijava</h2>    
        <form method="post" action="" name="loginForm">
        <input type="hidden" id="destination" name="destination" value="">
        <label for="username">Korisničko ime:</label>
        <input type="text" id="username" name="username"><br><br>
        <label for="password">Lozinka:</label>
        <input type="password" id="password" name="password"><br><br>     
        <div id="error-message" style="color: red; margin-bottom: 5px"></div>
        <button type="submit" name="login" class="loginBtn">Prijava</button>
        <div class="registerNowContainer" style="display: none;">
            <p>Nemate račun?</p>
            <a href="registracija.php" class="registerNowBtn">Registriraj se odmah</a>
        </div>
        
        </form>
    </section>
</div>
    
    


<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $destination = isset($_GET['url']) ? $_GET['url'] : 'index.php';
           
            require "connection.php";

            if($connection) {
                $errorMessage = "";
                $ifUserExistsQuery = "SELECT password, permission FROM users WHERE username = ?;";
                    $stmt = mysqli_stmt_init($connection);

                    if(mysqli_stmt_prepare($stmt, $ifUserExistsQuery)) {
                        mysqli_stmt_bind_param($stmt, 's', $username);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_store_result($stmt);                      

                        if(mysqli_stmt_num_rows($stmt) > 0) {
                            mysqli_stmt_bind_result($stmt, $passwordDB, $permission);
                            mysqli_stmt_fetch($stmt);

                             if(password_verify($password, $passwordDB)) {
                                if($permission == 1) {
                                    $_SESSION['loggedin'] = true;
                                    header('Location: ' . $destination);
                                    exit();
                                }
                                else {
                                    echo "<script type='text/javascript'>
                                    alert('$username, nemate dovoljna prava za pristup ovoj stranici.');
                                    window.location.href = 'index.php';
                                    </script>";
                                }
                               
                            }
                            else {
                                $errorMessage = "Unijeli ste pogrešno korisničko ime i/ili lozinku";
                            }                     

                        }
                        else {
                            $errorMessage = "Takvo korisničko ime ne postoji.";
                        }

                    }
            }
            if(!empty($errorMessage)) {
                echo "<script type='text/javascript'>
                       document.getElementById('error-message').innerHTML = '$errorMessage';
                       document.querySelector('.registerNowContainer').style.display = 'flex';
                       </script>";
                       
            }
    }
?>



</body>
</html>
