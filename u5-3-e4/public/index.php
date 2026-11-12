
<?php

echo "Primera forma de leerlo:<br>";

// abrir fichero
$fichero = fopen("matriz.txt", "r");

// comprobar si se ha abierto correctamente
if ($fichero === false) {
    echo "Error al abrir el fichero";
    exit;
}

// primera lectura: guardar los números en un array
while (($numeros = fscanf($fichero, "%d %d %d %d")) !== false) {

    foreach ($numeros as $numero) {
        echo $numero . " ";
    }

    echo "<br>";
}

// volver al principio del fichero
rewind($fichero);

echo "<br>Segunda forma de leerlo:<br>";

// segunda lectura: guardar los números en cuatro variables
while (fscanf($fichero, "%d %d %d %d", 
    $numero1, $numero2, $numero3, $numero4) !== false) {

    echo $numero1 . " ";
    echo $numero2 . " ";
    echo $numero3 . " ";
    echo $numero4 . "<br>";
}

// cerrar fichero
fclose($fichero);
