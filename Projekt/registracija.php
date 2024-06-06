<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.css">
    <title>Registracija</title>
</head>
<body class="registrationBackgroundColor">

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
    <section class="registrationContainer">
        <h2>Registracija</h2>
        <form action="" method="post">
        <label for="name">Ime:</label>
        <input type="text" id="name" name="nameInput">
        <span id="errorNameMessage" class="error"></span>
        <br>   
        <label for="surname">Prezime:</label>
        <input type="text" id="surname" name="surnameInput">
        <span id="errorSurnameMessage" class="error"></span>
        <br>  
        <label for="username">Korisničko ime:</label>
        <input type="text" id="username" name="usernameInput">
        <span id="errorUsernameMessage" class="error"></span>
        <br>
        <label for="password">Lozinka:</label>
        <input type="password" id="password" name="passwordInput">
        <span id="errorPasswordMessage" class="error"></span>
        <br>
        <label for="passwordAgain">Ponovi lozinku:</label>
        <input type="password" id="passwordAgain" name="passwordAgainInput">
        <span id="errorPasswordAgainMessage" class="error"></span>
        <br>
        <button type="submit" id="btn" class="loginBtn">Potvrdi</button>
        </form>
    </section>
</div>


    <script type="text/javascript">
        document.getElementById('btn').onclick = function(event) {
            var isValid = true;

            var name = document.getElementById('name');
            var surname = document.getElementById('surname');
            var username = document.getElementById('username');
            var password = document.getElementById('password');
            var passwordAgain = document.getElementById('passwordAgain');

            var errorNameMessage = document.getElementById('errorNameMessage');
            var errorSurnameMessage = document.getElementById('errorSurnameMessage');
            var errorUsernameMessage = document.getElementById('errorUsernameMessage');
            var errorPasswordMessage = document.getElementById('errorPasswordMessage');
            var errorPasswordAgainMessage = document.getElementById('errorPasswordAgainMessage');

            errorNameMessage.innerHTML = errorSurnameMessage.innerHTML = errorUsernameMessage.innerHTML = 
            errorPasswordMessage.innerHTML = errorPasswordAgainMessage.innerHTML = "";
            
            name.classList.remove('error-border');
            surname.classList.remove('error-border');
            username.classList.remove('error-border');
            password.classList.remove("error-border");
            passwordAgain.classList.remove("error-border");


            if(name.value.trim() === "") {
                errorNameMessage.innerHTML = 'Ime je obavezno';
                name.classList.add("error-border");
                isValid = false;
            }
            else {
                name.classList.remove("error-border");
            }


            if(surname.value.trim() === "") {
                errorSurnameMessage.innerHTML = 'Prezime je obavezno';
                surname.classList.add("error-border");
                isValid = false;
            }
            else {
                surname.classList.remove("error-border");
            }


            if(username.value.trim() === "") {
                errorUsernameMessage.innerHTML = 'Korisničko ime je obavezno';
                username.classList.add("error-border");
                isValid = false;
            }
            else if(username.value.length < 6) {
                errorUsernameMessage.innerHTML = 'Korisničko ime ne smije imati manje od 6 znakova';
                username.classList.add("error-border");
                isValid = false;
            }
            else {
                username.classList.remove("error-border");
            }


            if(password.value.trim() === "") {
                errorPasswordMessage.innerHTML = "Lozinka je obavezna.";
                password.classList.add("error-border");
                isValid = false;
            }
            else if(password.value.length < 7 || password.value.length > 20) {
                errorPasswordMessage.innerHTML = 'Lozinka mora imati između 7 i 20 znakova';
                password.classList.add("error-border");
                isValid = false;
            } 
            else {
                password.classList.remove("error-border");
            }

            if(passwordAgain.value.trim() === "") {
                errorPasswordAgainMessage.innerHTML = 'Ponovljena lozinka je obavezna';
                passwordAgain.classList.add("error-border");
                isValid = false;
            }
            else if(password.value != passwordAgain.value) {
                errorPasswordAgainMessage.innerHTML = 'Lozinka i ponovljena lozinka moraju biti iste';
                passwordAgain.classList.add("error-border");
                isValid = false;
            }
            else {
                passwordAgain.classList.remove("error-border");
            }

            if(!isValid) {
                event.preventDefault();
            }

        }
    </script>

    


    <?php 
        require "connection.php";

        if($connection) {
                if(isset($_POST['nameInput']) && isset($_POST['surnameInput']) && isset($_POST['usernameInput']) && isset($_POST['passwordInput'])) {
                    $name = $_POST['nameInput'];
                    $surname = $_POST['surnameInput'];
                    $username = $_POST['usernameInput'];
                    $password = $_POST['passwordInput'];
                    $hashedPassword = password_hash($password, CRYPT_BLOWFISH);
                    $permission = 0;

                    echo $username;

                    $insertUserQuery = "INSERT INTO users (name, surname, username, password, permission) VALUES(?, ?, ?, ?, ?);"; 
                    $stmt = mysqli_stmt_init($connection);

                    if(mysqli_stmt_prepare($stmt, $insertUserQuery)) {
                    mysqli_stmt_bind_param($stmt, 'ssssi', $name, $surname, $username, $hashedPassword, $permission);

                    $result = mysqli_stmt_execute($stmt);
                    if($result) {
                    echo "<script type='text/javascript'>
                        alert('Uspješno spremanje novog korisnika u bazu.');
                        window.location.href = 'registracija.php';
                        </script>";
                    }
                    else {
                        echo "<script type='text/javascript'>
                            alert('Neuspješno spremanje novog korisnika u bazu.');
                            window.location.href = 'registracija.php';
                            </script>";
                        }

                    }
                    }
                
        }

        mysqli_close($connection);
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