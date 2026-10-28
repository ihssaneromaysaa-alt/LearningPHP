<?php
/*
function obtenerPiezasBlancas(): array
{
    return [
        "torreb",
        "caballob",
        "alfilb",
        "reinab",
        "reyb",
        "alfilb",
        "caballob",
        "torreb"
    ];
}

function obtenerPiezasNegras(): array
{
    return [
        "torren",
        "caballon",
        "alfiln",
        "reinan",
        "reyn",
        "alfiln",
        "caballon",
        "torren"
    ];
}

function obtenerPiezasDeFila(int $fila): array
{
    switch ($fila) {

        // Primera fila: piezas negras
        case 0:
            return obtenerPiezasNegras();

        // Segunda fila: peones negros
        case 1:
            return array_fill(0, 8, "peonn");

        // Séptima fila: peones blancos
        case 6:
            return array_fill(0, 8, "peonb");

        // Octava fila: piezas blancas
        case 7:
            return obtenerPiezasBlancas();

        // Filas centrales vacías
        default:
            return array_fill(0, 8, "");
    }
}

function esCasillaBlanca(int $fila, int $columna): bool
{
    return ($fila + $columna) % 2 == 1;
}

function dibujarCasilla(int $fila, int $columna): void
{
    $piezas = obtenerPiezasDeFila($fila);
    $pieza = $piezas[$columna];

    if (esCasillaBlanca($fila, $columna)) {
        $clase = "blanca";
    } else {
        $clase = "gris";
    }

    echo "<td class='$clase'>";

    if ($pieza != "") {
        echo "<img src='imagenes/$pieza.png' alt='$pieza'>";
    }

    echo "</td>";
}

function dibujarTablero(): void
{
    echo "<table>";

    for ($fila = 0; $fila < 8; $fila++) {

        echo "<tr>";

        for ($columna = 0; $columna < 8; $columna++) {
            dibujarCasilla($fila, $columna);
        }

        echo "</tr>";
    }

    echo "</table>";
}

*/

/** 11.1 Antes de comenzar a jugar */

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