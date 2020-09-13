<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge, chrome=1">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php

    class Samochod {
        public $marka;
        public $model;
        public $kolor;
        public $pojemnosc; # silnika
        private $wlaczony; # silnik
        private $predkosc;

        function __construct($_marka, $_model, $_kolor, $_pojemnosc)
        {   
            $this->marka = $_marka;
            $this->model = $_model;
            $this->kolor = $_kolor;
            $this->pojemnosc = $_pojemnosc;
            $this->wlaczony = false;
            $this->predkosc = 0;
        }

        function przemaluj($_nowyKolor) {
            $this->kolor = $_nowyKolor;
        }

        function zapal() {
            $this->wlaczony = true;
        }

        function zgas() {
            $this->wlaczony = false;
        }

        function przyspiesz() {
            global $limitPredkosci;
            if( isset($limitPredkosci) )
               if($this->predkosc < $limitPredkosci)
               $this->predkosc++;
            else  $this->predkosc++;  
        }

        function hamuj() {
            if($this->predkosc >= 1)
                $this->predkosc--;
            else $this->predkosc = 0;
        }

        function stoj() {
            while($this->predkosc > 0) {
            $this->hamuj();
            }
        }

        function stan() {
            $tekst = "Samochód marki $this->marka, model $this->model w kolorze $this->kolor, 
                o pojemności silnika $this->pojemnosc ";

        if($this->wlaczony)
            $tekst .= "jest włączony i ";
        else 
            $tekst .= "jest wyłączony i ";

        if($this->predkosc > 0)
            $tekst .= "porusza się z prędkością $this->predkosc.";
        else 
            $tekst .= "stoi w miejscu.";
    
        $tekst .= "<br>";
        return $tekst;
        }
    }

    $limitPredkosci = 50;

    $s = new Samochod("Skoda", "Suberb", "srebrny", 1600);

    echo $s->stan();
    $s->zapal();
    for ($i=0; $i < 100; $i++) { 
        $s->przyspiesz();
    }
    $s->przyspiesz();
    $s->przyspiesz();
    $s->przyspiesz();
    echo $s->stan();
    $s->stoj();
    $s->zgas();
    echo $s->stan();


    class SamochodOsobowy extends Samochod {
        public $iloscMiejsc;
        private $iloscPasazerow;

        function __construct($_marka, $_model, $_kolor, $_pojemnosc, $_iloscMiejsc)
        {
            parent::__construct($_marka, $_model, $_kolor, $_pojemnosc);
            $this->iloscMiejsc = $_iloscMiejsc;
            $this->iloscPasazerow = 1;
        }

        function dodajPasazera() {
            if($this->iloscPasazerow < $this->iloscMiejsc - 1) {
                $this->iloscPasazerow++;
            }
            else echo"nie ma miejsca<br>";
        }

        function usunPasazera() {
            if($this->iloscPasazerow > 1)
              $this->iloscPasazerow--;
        }

        function stan()
        {
            $tekst = parent::stan();
            $tekst .= "Na pokładzie znajduje sie $this->iloscPasazerow z $this->iloscMiejsc osob<br>";
            return $tekst;
        }
    }

    $s = new SamochodOsobowy("Skoda", "Suberb", "srebrny", 1600,5);
    echo $s->stan();

    class SamochodCiezarowy extends Samochod {
        public $ladownosc;
        public $zaladunek;

        function __construct($_marka, $_model, $_kolor, $_pojemnosc, $_ladownosc) {
            parent::__construct($_marka, $_model, $_kolor, $_pojemnosc);
            $this->ladownosc = $_ladownosc;
            $this->zaladunek = 0;
        }

        function dodajLadunek($_ilosc) {
            $wolneMiejsce = $this->ladownosc - $this->zaladunek;
            if($_ilosc <= $wolneMiejsce)
               $this->zaladunek += $_ilosc;
            else echo "brak miejsca w samochodzie";
        }

        function wyladujTowar() {
            if($this->zaladunek >0)
               $this->zaladunek--;
            else echo "samochod jest pusty";   
        }

        function stan() {
            {
                $tekst = parent::stan();
                $procent = ($this->zaladunek / $this->ladownosc) * 100;
                $tekst .="na pace znajduje sie $this->zaladunek z $this->ladownosc towar ($procent%)<br>";
                return $tekst;
            }
        }
    }

    $s2 = new SamochodCiezarowy("fiat", "ducato", "braz", 2000, 3500);

    echo $s2->stan();
    for ($i=0; $i < 140; $i++) { 
        $s2->dodajLadunek(10);
    }
    echo $s2->stan();
    ?>
</body>
</html>