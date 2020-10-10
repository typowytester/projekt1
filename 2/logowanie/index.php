<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        if(isset($_SESSION['login'])) {
            //użytkownik zalogowany
            $login = $_SESSION['login'];
            echo "Witaj $login.<br>";
            echo '<a href="logout.php">Wyloguj</a>';
        }
        else {
            //brak zalogowanego użytkownika - przekieruj na stronę logowania
            header("Location: login.php");
            exit();
        }
    ?>
</body>
</html>