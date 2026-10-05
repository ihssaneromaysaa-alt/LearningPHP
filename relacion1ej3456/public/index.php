<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>relacion 1</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>3. Dados</h1>
    <?php 
    /** * 3. Dados 
     * * Escriba un script muestre la tirada de dos dados al azar y diga: 
     * * si ha salido una pareja de valores iguales 
     * * el mayor de los valores que se han obtenido en la tirada 
     * * Nota: Adelantaremos el uso de la función random_int() para realizar este ejercicio 
     * */ 
    $num1=random_int(1,6); 
    $num2=random_int(1,6); 
    echo "<pre>"; 
    echo "primer número: ".$num1.PHP_EOL; 
    ?>
    <img width=100px src="\img\dado<?= $num1 ?>.png" alt="primer dado">
    <?php
    echo "segundo número: ".$num2.PHP_EOL; 
    ?>
    <img width=100px src="\img\dado<?= $num2 ?>.png" alt="primer dado">
    <?php
    if($num1===$num2) 
        echo "$num1 y $num2 son iguales"; 
    else if($num1>$num2) 
        echo "$num1 es mayor a $num2"; 
    else if($num2>$num1) 
        echo "$num2 es mayor a $num1";
     echo "</pre>";
     

    ?>
    <!------
    <h1>4. cuadrado numeros naturales</h1>
    Utiliza un bucle while para calcular y mostrar
     en pantalla el cuadrado de los primeros 40 
     números naturales
     <--?php
     $num=0;
     while($num<=40){
        echo "<pre>";
        echo $num.PHP_EOL;
        $num=$num+1;
        echo "<pre>";
        }
    ?>
    -->
    <h1>5. Esfera</h1>
     <?php 
     $radio=3;
     $longitud=$radio*2;
     //area
     $superficie=4*3.14*($radio**2);

     ?>
    <p>radio= <?= $radio ?></p>
    <p>longitud= <?= $longitud ?></p>
    con round:
    <p>superficie= <?= round($superficie,2) ?></p>
    <p>radio= <?= $radio ?></p>
    <p>con printf</p>
    <?php 
        printf("%.2f",$superficie);
    ?>
    
    <h1>6. Ecuación de segundo grado</h1>
    con echo:
    <?php 
        $x1=0;
        $x2=0;
        try{
            $a=0;
            $b=-5;
            $c=6;
            if($a==0){
                throw new Exception('No se puede divider entre 0');
            }
            //(-b+-raiz(b**2-4*b*b))/2*a
            $x1=(-$b+sqrt($b**2-4*$a*$c))/2*$a;
            $x2=(-$b-sqrt($b**2-4*$a*$c))/2*$a;
            echo "<pre>";
            echo "solucion 1: ".$x1.PHP_EOL;
            echo "solucion 2: ".$x2.PHP_EOL;
        }catch(Exception $e){
            echo "ERROR".$e->getMessage();
        }
        
        print("con print".PHP_EOL.PHP_EOL);
        
        print("solución x1: ".$x1.PHP_EOL);
        print("solución x2: ".$x2.PHP_EOL);


        printf("con printf".PHP_EOL.PHP_EOL);
        
        printf("solución x1: %.2f",$x1);
        echo PHP_EOL;
        printf("solución x2: %.2f",$x2);
        echo "</pre>";

    ?>
    
    <h1>7. Diccionario de números</h1>
    Diseña un programa que genere una tabla HTML con dos columnas. 
    La primera columna debe mostrar los nombres en inglés de los diez
     primeros números naturales y la segunda su correspondiente traducción
      al castellano.
    ( Uso de la etiqueta <table> de HTML).
    <table>
    <tr></tr>
    <?php 
    $castellano=["uno", "dos","tres", "cuatro", "cinco", "seis", "siete", "ocho", "nueve","diez"];
    $ingles=["one", "two","three", "four", "five", "six", "seven", "eigth", "nine","ten"];
    for($i=0;$i<10;$i++){
        echo "<tr>";
        echo "<td>".$castellano[$i]."</td>";
        echo "<td>".$ingles[$i]."</td>";
        echo "<tr>";
        }
    ?>
    </table>
    <h1>8. Tablas de multiplicar</h1>
    <table>
    <?php 
    for($n1=0;$n1<=10;$n1++){
        echo "<tr>";
        for($n2=0;$n2<=10;$n2++){
            echo "<td>$n1 x $n2 = ".$n1*$n2."</td>";
        }
        echo "<tr>";
        }
    ?>
    </table>

    <h1>9. Representación numérica en diferentes bases</h1>
    <p>Muestra una tabla con los 20 primeros números en diferentes bases:
    decimal, binario, octal y hexadecimal.
    Usa un bucle y printf para conseguir presentar de distintas formas la variable que uses en el bucle.</p>

    <table>
        <tr>
            <th>decimal</th>
            <th>binario</th>
            <th>octal</th>
            <th>hexadecimal</th>
        </tr>
        <?php 
        for($i = 0; $i <= 20; $i++){
            echo "<tr>";
            // %d = decimal, %b = binario, %o = octal, %x = hexadecimal (minúsculas)
            printf("<td>%d</td><td>%b</td><td>%o</td><td>%x</td>", $i, $i, $i, $i);
            echo "</tr>";
        }
        ?>
    
    </table>
    <h1>10. Cadena al reves</h1>
    <?php 
    
    $cadena=$_GET["cadena"]??"";
    $invertida="";
        if(isset($var)){
            echo "no hay cadena";
        }else{
        echo "<p>la cadena $cadena invertida es </p>";
        for($i=mb_strlen($cadena)-1;$i>=0;$i--){
            $invertida .= mb_substr($cadena,$i,1);
        }
        echo $invertida;
    }
    ?>
    
    <h1>11. Pirámide</h1>
    <?php 
    $n=$_GET["numero"]??null;
    if($n==null || $n=="")
        echo "no hay valor";
    else{
        $n=(int)$n;
        if(!is_numeric($_GET["numero"]) || $n<=0 || $n%2==0){
            echo "debe ser un número positivo e impar";
        }
        else{
            for($i=1;$i<=$n;$i+=2){
                for ($j = 0; $j < ($n - $i) / 2; $j++) {
                    echo "&nbsp;";
                }
                for ($k = 0; $k < $i; $k++) {
                    echo "*";
                }
                echo "<br>";
            }
        }
    }
    ?>
    <h1>12. fechas suma y resta</h1>
    <?php 
    echo "fecha ayer: ";
    echo date("m.d.y", strtotime("-1 day")), "<br>"; 
    echo "fecha hoy: ";
    echo date("m.d.y") . "<br>";
    echo "fecha mañana: "; 
    echo date("m.d.y", strtotime("+1 day")), "<br>"; 
    ?>

    <h1>13. Calculadora</h1>
    <?php 
    $n1=$_GET["n1"]??null;
    $n2=$_GET["n2"]??null;
    echo "numero 1: $n1<br>";
    echo "numero 2: $n2<br>";
    if($n1!=null && is_numeric($_GET["n1"]) && $n2!=null && is_numeric($_GET["n2"])){
        $n1=(int)$n1;
        $n2=(int)$n2;
        echo "<br> suma: ".($n1+$n2);
        echo "<br>resta: ".($n1-$n2);
        echo "<br>multiplicación: ".($n1*$n2);
        if($n2!=0)
            echo "<br>división: ".($n1/$n2);
        echo "<br>potencia: ".($n1**$n2);
    }
    else
        echo "no se detectan numeros o no son números";
    ?>

    <h1>14. Números entre 2 valores</h1>
    <?php 
    $n1=$_GET["n1"]??null;
    $n2=$_GET["n2"]??null;
    echo "numero 1: $n1<br>";
    echo "numero 2: $n2<br>";
    if($n1!=null && is_numeric($_GET["n1"]) && $n2!=null && is_numeric($_GET["n2"]) && $n1<$n2){
        $n1=(int)$n1;
        $n2=(int)$n2;
        for($i=$n1+1; $i<$n2;$i++){
            echo $i."<br>";
        }
    }
    else
        echo "no se detectan numeros o no son números o el primero no es estrictamente menor que el segundo";
    ?>
    <h1>15. Dibuja línea</h1>
    <?php
    $longitud=$_GET["longitud"]??null;
    if(isset($_GET["longitud"]) && $_GET["longitud"]>=10 && $_GET["longitud"]<1000 ){
        $longitud=(int)$_GET["longitud"];
        print "  <svg width='$longitud' height='20' xmlns='http://www.w3.org/2000/svg'>\n";
        print "    <line x1='0' y1='10' x2='$longitud' y2='10' stroke='black' stroke-width='3'/>\n";
    }else{
        echo "por favor indique una longitud en la url de entre 10 y 1000";
    }

    
    ?>
    <h1>Ejercicios de refuerzo</h1>
</body>
</html>