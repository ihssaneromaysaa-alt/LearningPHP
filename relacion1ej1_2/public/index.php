<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>relación 1</title>
</head>
<body>
    <?php

    /**
     * 1. tipos de datos básicos
     * Crear tres variables: país, habitantes y continente y asígnales un valor inicial adecuado.
     * Muestra por pantalla el valor de cada una junto con el tipo de dato que PHP le ha asignado de manera automática.
     */
     const PAIS='españa'; 
     $habitantes=1000;
     define ("CONTINENTE", "europa");
     echo "<pre>";
     echo "ejercicio 1".PHP_EOL.PHP_EOL;
     echo "pais: ".PAIS." tipo: ".gettype(PAIS).PHP_EOL.
     "habitantes: ".$habitantes." tipo: ".gettype($habitantes).PHP_EOL.
     "continente: ".CONTINENTE." tipo: ".gettype(CONTINENTE).PHP_EOL;
     echo "</pre>";

     /** * 2. Conversor de moneda(Euros a Dólares) 
      * * Desarrolla un conversor de moneda que transforme una cantidad fija de euros a dólares. 
     * Define el tipo de cambio actual como una constante o variable y muestra el resultado en pantalla de forma clara. 
     * */ 
    $cantidad=20; 
    $conversorDaE=$cantidad+$cantidad*0.14; 
    $conversorEaD=$cantidad-$cantidad*0.14; /*
    echo "<pre>"; 
    echo PHP_EOL."ejercicio 2".PHP_EOL.PHP_EOL; 
    echo "$cantidad euros en dólares es ".$conversorDaE.PHP_EOL; 
    echo "$cantidad dólares en euros es ".$conversorEaD.PHP_EOL; 
    echo "</pre>"; */
    /*?>
    
    <p>ejercicio 2 </p>
    <p><?= $cantidad ?> euros en dólares es <?= $conversorDaE ?></p> 
    <p>con <?= $cantidad ?> dólares en euros es <?= $conversorEaD ?> </p>
    
    <?
    */
    /** * 3. Dados 
     * * Escriba un script muestre la tirada de dos dados al azar y diga: 
     * * si ha salido una pareja de valores iguales 
     * * el mayor de los valores que se han obtenido en la tirada 
     * * Nota: Adelantaremos el uso de la función random_int() para realizar este ejercicio 
     * */ 
    $num1=random_int(1,6); 
    $num2=random_int(1,6); 
    echo "<pre>"; 
    echo "ejercicio 3".PHP_EOL.PHP_EOL; 
    echo "primer número: ".$num1.PHP_EOL; 
    echo "segundo número: ".$num2.PHP_EOL; 
    if($num1===$num2) 
        echo "$num1 y $num2 son iguales"; 
    else if($num1>$num2) 
        echo "$num1 es mayor a $num2"; 
    else if($num2>$num1) 
        echo "$num2 es mayor a $num1";
     echo "</pre>";
     
    ?>
    para mostrar echos en un 
    <p><?= PAIS ?> es un pais de <?= CONTINENTE ?> con <?= $habitantes ?> habitantes </p>
</body>
</html>