<!--?php
    declare(scrict_types=1);
?-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>relación 2</title>
</head>
<body>
    <h1>Relación 2: Funciones</h1>
    
    <h2>1. Funciones predefinidas</h2>


    <!--?php  
    $valorNull=null;
    //$variableNoDefinida;
    $variableVacia="";
    $variableEntero=1;
    echo "<h3>Variable null</h3>";
    echo "<br>Si sale 1 es que la variable es null: ".is_null($valorNull);
    echo "<br>Si sale 1 es que la variable no está definida: ".isset($valorNull);
    echo "<br>Si sale 1 es que la variable está vacia: ".empty($valorNull);
    echo "<br>Si sale 1 es que la variable es int: ".is_int($valorNull);

    echo "<h3>Variable no definida</h3>";
    //echo "<br>Si sale 1 es que la variable es null: ".is_null($variableNoDefinida);
    echo "<br>Si sale 1 es que la variable no está definida: ".isset($variableNoDefinida);
    echo "<br>Si sale 1 es que la variable está vacia: ".empty($variableNoDefinida);
    //echo "<br>Si sale 1 es que la variable es int: ".is_int($variableNoDefinida);
    
    echo "<h3>Variable vacia</h3>";
    echo "<br>Si sale 1 es que la variable es null: ".is_null($variableVacia);
    echo "<br>Si sale 1 es que la variable no está definida: ".isset($variableVacia);
    echo "<br>Si sale 1 es que la variable está vacia: ".empty($variableVacia);
    echo "<br>Si sale 1 es que la variable es int: ".is_int($variableVacia);

    
    echo "<h3>Variable entero</h3>";
    echo "<br>Si sale 1 es que la variable es null: ".is_null($variableEntero);
    echo "<br>Si sale 1 es que la variable no está definida: ".isset($variableEntero);
    echo "<br>Si sale 1 es que la variable está vacia: ".empty($variableEntero);
    echo "<br>Si sale 1 es que la variable es int: ".is_int($variableEntero);
    ?-->

    <h2>2. Cadenas</h2>

    <!--?php 
        function cadenas(string $cadena):string{
            if(!is_string($cadena)){
                $cadena.=" no es una cadena de caracteres";
            }
            if(is_string($cadena)&&empty($cadena)){
                $cadena="Este es el relleno porque estaba vacía";
            }
             return strtoupper($cadena);
        }
        echo "<br>función cadenas: ".cadenas("prueba");
    ?-->
    <h2>3. Potencias</h2>

    <!--?php 
    function potencia(int $base, int $exponente=2):int{
        return $base**$exponente;
    }
    $base      = isset($_GET["base"])      ? (int)$_GET["base"]      : null;
    $exponente = isset($_GET["exponente"]) ? (int)$_GET["exponente"] : null;
    if(is_null($base)||is_null($base)){
        if ($base !== null && $exponente === null) {
            echo "llamamos función solo con base $base: " . potencia($base);
        } else {
            echo "error, el exponente y la base tienen que ser int";
        }
    }else {
        echo "llamamos función con $base y $exponente: " . potencia($base, $exponente);
    }
    ?-->

    <h2>4. Funciones predefinidas de texto</h2>


    <!--?php 
    $cadena="Hola, mundo. ¿Qué tal estás hoy?";
    echo "La longitud de la cadena es: ".strlen($cadena);
    echo "<br>Los primeros doce caracteres: ".substr($cadena,0,12);
    echo "<br>La posición de la palanra 'mundo' es en: ".strpos($cadena,"mundo");
    echo "<br>La posición de la palanra 'MUNDO' es en: ".strpos($cadena,"MUNDO");
    echo "<br>La cadena en mayúsculas es: ".strtoupper($cadena);
    echo "<br>La cadena en minúsculas es: ".strtolower($cadena);
    echo "<br>La subcadena obtenida a partir del primer punto: ".substr($cadena,(strpos($cadena,".")));
    
    ?-->

    <h2>5. Tipado estricto</h2>

    <!--?php 
    function potencia(int|float $base, int|float $exponente): ?string
    {
        if ($exponente < 0) {
            return null;
        }
        $resultado = $base ** $exponente;
        return (string) $resultado;
    }
    echo "caso correcto (int): " . potencia(3, 4) . "<br>";        // "81"
    echo "caso correcto (float): " . potencia(2.5, 2) . "<br>";   // "6.25"
    echo "caso null (exponente negativo): ";
    var_dump(potencia(5, -1));   // null
    echo "<br><br>";
    try {
        echo potencia("hola", 2);
    } catch (TypeError $e) {
        echo "mensaje: " . $e->getMessage();
    }
    ?-->

    <h2>6. Fecha actual</h2>
    <!--?php
    include 'fecha.php';

    echo "<p>" . obtenerFechaCastellano() . "</p>";
    ?-->

    <h2>7. Primo</h2>
    <!--?php 
    
    function esPrimo(int $numero):bool{
        $resultado=false;
        $cantDivisores=0;
        for($i=1;$i<=$numero;$i++){
            if($numero%$i==0)
                $cantDivisores++;
        }
        if($cantDivisores==2)
            $resultado=true;
        return $resultado;
    }
    echo "67 es primo: ".(esPrimo(67)?"es primo":"no es primo");

    ?-->
    <h2>8. MCD</h2>
    <!--?php 
        function mcd(int $num1, int $num2): int{
            $maxDivisor=1;
            for($i=1;$i<=min($num1,$num2);$i++){
                if($num1%$i===0 && $num2%$i===0)
                    $maxDivisor=$i;
            }
            return $maxDivisor;
        }
        echo "probamos mcd entre 2 y 7: ".mcd(2,7);
        echo "<br>probamos mcd entre 6 y 12: ".mcd(6,12);

    ?-->
    
    <h2>9. Factorial</h2>

    <!--?php 
    function factorial($n){
        if($n==0||$n==1)
            return 1;
        return $n*factorial($n-1);
    }
    echo "el factorial de 5 es: ".factorial(5);
    ?-->

    <h2>10. Factorial negativo</h2>

    <!--?php 
    
    function factorial($n){
        if($n<0)
            throw new InvalidArgumentException("el número debe no puede ser negativo");
        if($n==0||$n==1)
            return 1;
        return $n*factorial($n-1);
    }
    try{
        echo "el factorial de 5 es: ".factorial(-5);
    }catch(InvalidArgumentException $e){
        echo "mensaje: " . $e->getMessage();
    }
    
    ?-->

    <h2>11. Matricula</h2>
    <!--?php 
    function validarM(string $cadena):bool{
        $resultado=false;
       if(ctype_digit(substr($cadena,0,3)) && ctype_upper(substr($cadena,4,7)))
            $resultado=true;
       return $resultado;
    }
    echo "12345RS ".(validarM("12345RS")?"NO":"")."vale como matricula";
    echo "<br>1234PRS ".(validarM("1234PRS")?"NO":"")."vale como matricula";
    ?-->

    <h2>12. Password</h2>
        <?php
    $pass = isset($_POST["pass"]) ? $_POST["pass"] : "null";
    
    function comprobarPassword(string $contrasenia)
    {
        $arrayRegex = [
            '/^.{6,15}$/',
            '/[0-9]/',
            '/[a-z]/',
            '/[A-Z]/',
            '/[^a-zA-Z0-9]/'
        ];
        
        $cumple = true;

        foreach ($arrayRegex as $regex) {
            if (!preg_match($regex, $contrasenia)) 
                $cumple = false;
        }
        return $cumple;
    }

    function imprimirPassValido (bool $isValid){
        $respuesta = "";
        if($isValid) 
            $respuesta = "Contraseña Valida";
        else
            $respuesta = "Contraseña Invalida";

        return $respuesta;
    }
    ?>


    <div>
        <form method="POST">
            <label for="pass">Contraseña</label>
            <input type="text" id="pass" name="pass">
            <input type="submit">
        </form>
        <p>
            <?= comprobarPassword($pass) ?>
            <?= imprimirPassValido(comprobarPassword($pass)) ?>

        </p>
    </div>

    <!--?php
    function validarCo(string $cont):bool{
        return ((strlen($cont)<=14)&&(strlen($cont)>=5)
        && (preg_match("/[0-9]/", $cont)) 
        && (preg_match("/[A-Z]/", $cont))
        && (preg_match("/[a-z]/", $cont))
        && (preg_match("/[^a-zA-Z0-9]/", $cont)));
    }
    try{
        isset($_GET["cont"])?$cont=$_GET["cont"]:throw new Exception("debe insertar una contraseña");
        echo "<br>contraseña: $cont ¿es válida? ".(validarCo($cont)?"sí es válida":"no es válida");
    }catch (Exception $e) {
        echo "mensaje: " . $e->getMessage();
    }
    echo "<br>ejemplo de contraseña válida: 'hola' ¿es válida? ".(validarCo("hola")?"sí es válida":"no es válida");
    echo "<br>ejemplo de contraseña válida: '123hola.' ¿es válida? ".(validarCo("123hola.")?"sí es válida":"no es válida");
    echo "<br>ejemplo de contraseña válida: '123Hola.' ¿es válida? ".(validarCo("123Hola.")?"sí es válida":"no es válida");

    
    ?-->

    <!--?php
    function validarC(string $cont):bool{
        $longitud=(strlen($cont)<=14)&&(strlen($cont)>=5);
        $num=preg_match("/[0-9]/", $cont);
        $mayu=preg_match("/[A-Z]/", $cont);
        $minu=preg_match("/[a-z]/", $cont);
        $alfa=preg_match("/[^a-zA-Z0-9]/", $cont);
        $resultado=$longitud && $num && $mayu && $minu && $alfa;
        return $resultado;
    }
    try{
        isset($_GET["cont"])?$cont=$_GET["cont"]:throw new Exception("debe insertar una contraseña");
        echo "<br><br>contraseña: $cont ¿es válida? ".(validarC($cont)?"sí es válida":"no es válida");
    }catch (Exception $e) {
        echo "mensaje: " . $e->getMessage();
    }
    echo "<br>ejemplo de contraseña válida: 'hola' ¿es válida? ".(validarC("hola")?"sí es válida":"no es válida");
    echo "<br>ejemplo de contraseña válida: '123hola.' ¿es válida? ".(validarC("123hola.")?"sí es válida":"no es válida");
    echo "<br>ejemplo de contraseña válida: '123Hola.' ¿es válida? ".(validarC("123Hola.")?"sí es válida":"no es válida");
    ?-->

    
</body>
</html>