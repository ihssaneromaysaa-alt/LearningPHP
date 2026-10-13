<?php

class Carta
{
    public const PALOS = ["ESPADAS", "OROS", "COPAS", "BASTOS"];

    public const NUMEROS = [
        1  => "as",
        2  => "dos",
        3  => "tres",
        4  => "cuatro",
        5  => "cinco",
        6  => "seis",
        7  => "siete",
        8  => "ocho",
        9  => "nueve",
        10 => "sota",
        11 => "caballo",
        12 => "rey"
    ];

    public function __construct(
        private int $numero,
        private string $palo
    ) {
        if (!array_key_exists($this->numero, self::NUMEROS)) {
            throw new InvalidArgumentException("No existe ese número");
        }
        if (!in_array($this->palo, self::PALOS, true)) {
            throw new InvalidArgumentException("No existe ese palo");
        }
    }

    public function toString(): string
    {
        return self::NUMEROS[$this->numero] . " de " . $this->palo;
    }

    // Optional getters if you need them later
    public function getNumero(): int
    {
        return $this->numero;
    }

    public function getPalo(): string
    {
        return $this->palo;
    }
}
//baraja española
//array_key_exists(); in_array(); toString();
/** 11.1 Antes de comenzar a jugar */
/*
function crearBarajaCompleta(array $palabras):array{
    $numeros=[1,2,3,4,5,6,7,10,11,12];
    
    $palos=[];
    for($i=0;$i<count($palabras);$i++){
        $paloNombre=$palabras[$i];
        $palos[$paloNombre]=[];
        for($j=0; $j<count($numeros); $j++){
            ($palos[$paloNombre])[]=["numero"=>$numeros[$j], "palo"=>$paloNombre];
        }
    }
    return $palos;
}

function barajarBaraja(array &$palos):void{
    $todas=[];//hay que aplanar el array
    foreach($palos as $palo){
        foreach($palo as $carta){
            $todas[]=$carta;
        }
    }
    shuffle($todas);
    $palos=$todas;
}
function sacarCarta(array &$palos): array{
    $carta=array_pop($palos);
    unset($palos[1][1]);
    return $carta;
    
}
function mostrarCarta(array $carta):void{
    $numero=$carta["numero"];
    $palo=$carta["palo"];
    //<img src="" alt="">
    echo "<img src='img/imagenes/{$palo}_{$numero}.jpg' alt='{$palo} {$numero}'>";
}
*/