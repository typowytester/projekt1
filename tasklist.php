<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" 
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" 
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" 
        crossorigin="anonymous">
</head>
<body>
    <h1>Lista zadań</h1>
    <?php
        $db = new mysqli('localhost', 'root', '', 'tasklist');
        if(isset($_REQUEST['zadanie'])) {
            
            $termin = $_REQUEST['termin'];
            $zadanie = $_REQUEST['zadanie'];
            $sql = "INSERT INTO tasks (`id`, `termin`, `zadanie`, `zakonczone`) VALUES 
                        (NULL, '$termin', '$zadanie', 0)";
            $wynik = $db->query($sql);
            if($wynik) {
                echo '
                <div class="alert alert-primary" role="alert">
                    Zadanie dodane pomyślnie.
                </div>
                ';
            } else {
                echo '
                <div class="alert alert-danger" role="alert">
                    Nie udało się dodać zadania.
                </div>
                ';
            }
        }
        if(isset($_REQUEST['usun'])) {
            //usuwanie
            $id = $_REQUEST['id'];
            $sql = "DELETE FROM tasks WHERE id=$id";
            $wynik = $db->query($sql);
            if($wynik) {
                echo '
                <div class="alert alert-primary" role="alert">
                    Zadanie usunięto pomyślnie.
                </div>
                ';
            } else {
                echo '
                <div class="alert alert-danger" role="alert">
                    Nie udało się usunąć zadania.
                </div>
                ';
            }
        }  
        if(isset($_REQUEST['zakoncz'])) {
            //usuwanie
            $id = $_REQUEST['id'];
            $sql = "UPDATE tasks SET `zakonczone`=1 WHERE id=$id";
            $wynik = $db->query($sql);
            if($wynik) {
                echo '
                <div class="alert alert-primary" role="alert">
                    Zadanie zakończono pomyślnie.
                </div>
                ';
            } else {
                echo '
                <div class="alert alert-danger" role="alert">
                    Nie udało się zakończyć zadania.
                </div>
                ';
            }
        } 
    ?>
    <table class="table">
        <tr>
            <th>Termin</th>
            <th>Zadanie</th>
            <th>Zakończ</th>
            <th>Usuń</th>
        </tr>
        <?php
            $sql = "SELECT * FROM `tasks`";
            $wynik = $db->query($sql);
            while($wiersz = $wynik->fetch_assoc()) {
                echo '<tr>';
                echo '<td>'.$wiersz['termin'].'</td>';
                echo '<td>'.$wiersz['zadanie'].'</td>';
                if($wiersz['zakonczone'] == 0)
                    echo '<td>
                        <a class="btn btn-primary" href="?zakoncz&id='.$wiersz['id'].'">Zakończ</a>
                        </td>';
                else 
                    echo '<td>Zakończone</td>';
                echo '<td>
                        <a class="btn btn-danger" href="?usun&id='.$wiersz['id'].'">
                        Usuń
                        </a>
                        </td>';
                echo '</tr>';
            }
        ?>
    </table>
    <h2>Dodaj zadanie:</h2>
    <form action="#" method="POST">
        Termin wykonania: <input type="datetime-local" name="termin"><br>
        Treść zadania: <input type="text" name="zadanie"><br>
        <input type="submit" value="Zapisz">
    </form>
    <?php
        $db->close();
    ?>
</body>
</html>