<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        if(isset($_REQUEST['login'])) {
            if($_REQUEST['password1'] === $_REQUEST['password2']) {
                $login = $_REQUEST['login'];
                //wygeneruj bezpieczny hash hasła
                $hash = password_hash($_REQUEST['password1'], PASSWORD_DEFAULT);
                //echo $hash;
                $sql = "INSERT INTO users (`id`, `login`, `password`)
                            VALUES (NULL, '$login','$hash')";
                //echo $sql;
                $db = new mysqli('localhost', 'root', '', 'login');
                $wynik = $db->query($sql);
                if($wynik) {
                    header("Location: login.php");
                    exit();
                }
                else {
                    echo 'Nie udało się zapisać użytkownika do bazy danych';
                }
            }
            else {
                echo 'Hasła nie są zgodne!<br>';
            }
        }
    ?>
    <form action="#" method="POST">
        Nazwa użytkownika: <input type="text" name="login"><br>
        Nowe hasło: <input type="password" name="password1"><br>
        Powtórz hasło: <input type="password" name="password2"><br>
        <input type="submit" value="Zarejestruj">
    </form>
</body>
</html>