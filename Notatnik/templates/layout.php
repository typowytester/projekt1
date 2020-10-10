<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="/public/style.css">   
</head>
<body background-color="#303030">
    <div class="container bg-dark">
        <h1 class="display-4" style="color: #fff; text-align: center;">Notatnik</h1>
    </div>

    <div class="container bg-dark">
        <div class="row">
            <div class="col-2" style="border-right: 1px solid #000; padding-top: 20px;">
                <ul>
                    <li><a href="index.php">Dodaj notatki</a></li>
                    <li><a href="index.php?action=zadanie">Notatki</a></li>
                </ul>
            </div>
            <div class="col-10" style="padding-top: 20px;">
                <div class="page">
                    <?php require_once("pages/$page.php"); ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>