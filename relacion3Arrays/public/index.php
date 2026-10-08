<!--?php
    declare(scrict_types=1);
?-->
<?php
    include "funciones.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>relación 3 arrays</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    
    <!--h2>11. Jugando con cartas</h2-->
    <?php
    // 11.1 Antes de comenzar
    // $palabras=["bastos", "copas", "espadas", "oros"];
    // $palos=crearBarajaCompleta($palabras);
    // barajarBaraja($palos);
    // //print_r($palos);
    // //var_dump(sacarCarta($palos));
    // //var_dump($palos);
    // mostrarCarta(sacarCarta($palos));

    // 11.2 Las siete y media
    // 1. crear baraja y 
    $palabras=["bastos", "copas", "espadas", "oros"];
    $baraja=crearBarajaCompleta($palabras);
    barajarBaraja($baraja);
    // 2. ejecutar turno del jugador
    echo "<h3>turno de jugador</h3>";
    $puntuacionJ=0;
    do{
        $carta=sacarCarta($baraja);
        mostrarCarta($carta);
        $numero=(int)$carta["numero"];
        if ($numero === 10 || $numero === 11 || $numero === 12 )
            $puntuacionJ += 0.5;
        else
            $puntuacionJ += $numero;
        echo "su puntuación actual es de: ". $puntuacionJ ."<br>";
    }while($puntuacionJ<=7);

    // pov: le toca a blanca
    // 3. ejecurar el turno de blanca
    echo "<h3>turno de jugador</h3>";
    $puntuacionB=0;
    do{
        $carta=sacarCarta($baraja);
        mostrarCarta($carta);
        $numero=(int)$carta["numero"];
        if ($numero === 10 || $numero === 11 || $numero === 12 )
            $puntuacionB += 0.5;
        else
            $puntuacionB += $numero;
        echo "su puntuación actual es de: ". $puntuacionB ."<br>";
    }while($puntuacionB < $puntuacionJ && $puntuacionB <= 7.5);

    ?>
</body>
</html>