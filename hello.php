<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge, chrome=1">
    <title>Document</title>
</head>
<body>
<?php

function sumaCiagu($liczba) {
    $suma = 0;
    for ($i = 1; $i <= $liczba; $i++) { 
        $suma += $i;
    }
    return $suma;
}

$x = 10;
$wynik = sumaCiagu($x);
echo "Suma liczb od 1 do $x wynosi: $wynik <br>";

$x = 6;
$wynik = sumaCiagu($x);
echo "Suma liczb od 1 do $x wynosi: $wynik <br>";

$x = 13;
$wynik = sumaCiagu($x);
echo "Suma liczb od 1 do $x wynosi: $wynik <br>";
?>
</body>
</html>
