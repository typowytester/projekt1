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

    ?>
</body>
</html>