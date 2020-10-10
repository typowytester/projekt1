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
        if(isset($_REQUEST['login'])) {
            $login = $_REQUEST['login'];
            $password = $_REQUEST['password'];
            $db = new mysqli('localhost', 'root', '', 'login');
            $sql = "SELECT * from users WHERE `login`='$login' LIMIT 1";
            //echo $sql;
            $wynik = $db->query($sql);
            $user = $wynik->fetch_assoc();
            if(password_verify($password, $user['password'])) {
                $_SESSION['login'] = $user['login'];
                header("Location: index.php");
            } else {
                echo 'Niepoprawny login lub hasło';
            }
        }
    ?>
    <form action="#" method="POST">
        Nazwa użytkownika: <input type="text" name="login"><br>
        Hasło: <input type="password" name="password"><br>
        <input type="submit" value="Zaloguj"><br>
        <a href="register.php">Załóż konto</a>
    </form>
</body>
</html>