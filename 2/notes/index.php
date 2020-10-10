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
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        $db = new mysqli('localhost', 'root', '', 'notes');

        if(isset($_REQUEST['title'])) {
            //dodajemy nową notatkę
            $title = $_REQUEST['title'];
            $content = $_REQUEST['content'];
            $sql = "INSERT INTO notes (`id`, `title`, `content`) 
                        VALUES (NULL, '$title', '$content')";
            $result = $db->query($sql);
            if($result) {
                echo '
                <div class="alert alert-primary" role="alert">
                    Notatka dodana pomyślnie.
                </div>
                ';
            } else {
                echo '
                <div class="alert alert-danger" role="alert">
                    Nie udało się dodać notatki.
                </div>
                ';
            }
        }


        $sql = "SELECT * FROM notes ORDER BY `date` DESC";
        $result = $db->query($sql);

    ?>
    <div class="container">
        <h1 class="text-center">Moje notatki</h1>
        <form action="#" method="POST">
        <div class="form-row">
            
            <div class="form-group col-md-4 col-xl-2">
                <label for="inputTitle">Tytuł</label>
                <input type="text" class="form-control" id="inputTitle" name="title">
            </div>
            <div class="form-group col-md-6 col-xl-8">
                <label for="inputContent">Treść</label>
                <input type="text" class="form-control" id="inputContent" name="content">
            </div>
            <div class="form-group col-md-2 col-xl-2">
                <input type="submit" class="btn btn-primary w-100" id="inputSubmit">
            </div>
        </div>
        </form>
        <div class="row">
            <?php
                
                while($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-6 col-xl-3">';
                    echo '<div class="note p-3 my-1">';
                    $title = $row['title'];
                    $content = $row['content'];
                    $date = $row['date'];
                    echo "<h3>$title</h3>";
                    echo "<p>$content</p>";
                    echo "<h6>$date</h6>";
                    echo '</div>';
                    echo '</div>';
                }

            ?>
        </div>
    </div>
</body>
</html>