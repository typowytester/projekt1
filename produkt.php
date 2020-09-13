<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php

    class Produkt {
        public $nazwa;
        public $cenaBrutto;
        public $stawkaVAT;
        public $waga;
        public $kodKreskowy;
        public $zdjecie;
        public $ilosc;

        function __construct($_nazwa, $_cena, $_stawkaVAT = 23, $_ilosc = 0) {
            $this->nazwa = $_nazwa;
            $this->cenaBrutto = $_cena;
            $this->stawkaVAT = $_stawkaVAT;
            $this->ilosc = $_ilosc;
        }

        function cenaNetto() {
            return $this->cenaBrutto - $this->wartoscVAT();
        }

        function wartoscVAT() {
            return ($this->cenaBrutto * $this->stawkaVAT)/(100 + $this->stawkaVAT);
        }

        function ceny() { 
            $ceny = array();
            global $rabat;
            if( !isset($rabat) ) $rabat = 0;
            $ceny['brutto'] = number_format($this->cenaBrutto * (1 - $rabat),2);
            $ceny['netto'] = number_format($this->cenaNetto() * (1 - $rabat),2);
            $ceny['vat'] = number_format($this->wartoscVAT() * (1 - $rabat),2);
            return $ceny; 
        }
    }
    $rabat = 0.2;
    $p = new Produkt("Słuchawki", 99);

    //$vat = $p->wartoscVAT();
    //$netto = $p->cenaNetto();
    $c = $p->ceny();
    $brutto = $c['brutto'];
    $vat = $c['vat'];
    $netto = $c['netto'];
    echo "Towar $p->nazwa w cenie $brutto (w tym $vat VAT, netto $netto)"

    ?>
</body>
</html>