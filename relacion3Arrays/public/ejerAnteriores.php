<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Relación 3: Arrays</h1>
    <h2>1. Operaciones básicas</h2>
    <!--?php 
    $array=[4,3,2,1,7,6,5,8];
    echo "<br>a. mostrando array: ";
    mostrarArray($array);
    sort($array);
    echo "<br>b. array ordenado (me a ma): ";
    mostrarArray($array);
    arsort($array); 
    echo "<br>array ordenado (ma a me): ";
    mostrarArray($array);
    echo "<br>c. número de elementos".count($array); 
    echo "<br>d. buscar un elemento en un array: ".(in_array(3,$array)?" el 3 se ha encontrado":" el 3 no se ha encontrado"); 
    
    echo "<br>e. ";
    try{
        isset($_GET["valor"])?$valor=$_GET["valor"]:throw new Exception("introduce un valor");
        echo "buscar $valor en un array: ".(in_array($valor,$array)?" el $valor se ha encontrado":" el $valor no se ha encontrado"); 
    }catch(Exception $e){
        echo "mensaje: ".$e->getMessage();
    }
    function mostrarArray(array $array){
        foreach($array as $numeros){
            echo $numeros;
        }
    }
    ?-->

    <h2>2. Relleno automático</h2>
    <!--?php 
    $array=[];
    for($i=0;$i<120;$i++)
        array_push($array,rand(0,120));
    var_dump($array);
    ?-->


    <h2>3. Cuadrado y cubo</h2>
    <!--?php 
    $numerosA=[];
    for($i=0;$i<20;$i++)
        array_push($numerosA,rand(0,100));
    $cuadrados=[];
    for($i=0;$i<20;$i++)
        array_push($cuadrados,$numerosA[$i]*2);
    $cubo=[];
    for($i=0;$i<20;$i++)
        array_push($cubo,$numerosA[$i]*3);
    echo "<pre>";
    for($i=0;$i<20;$i++)
        printf("|  %3d | %3d | %3d |<br>",$numerosA[$i],$cuadrados[$i],$cubo[$i]);
    echo "</pre>";
    ?-->

    <h2>4. Operaciones aritméticas</h2>
    <!--?php 
    $numeros1aN=[];
    $numerosNa1=[];
    $suma=[];
    $limite=20;
    for($i=0;$i<$limite;$i++){
        array_push($numeros1aN,rand(1,$limite));
        array_push($numerosNa1,rand($limite,1));
        $suma[$i]=$numeros1aN[$i]+$numerosNa1[$i];
    }
    echo "<pre>";
    for($i=0;$i<20;$i++)
        printf("|  %3d + %3d = %3d |<br>",$numeros1aN[$i],$numerosNa1[$i],$suma[$i]);
    echo "</pre>";
    ?-->
    <h2>5. Complementario</h2>
    <!--?php 
    $aleatorio=[];
    $complementario=[];
    for($i=0;$i<=10;$i++){
        array_push($aleatorio,rand(1,0));
        array_push($complementario,($aleatorio[$i]==1?0:1));
    }
    echo "<pre>";
    for($i=0;$i<=10;$i++)
        printf("|  %d | %d |<br>",$aleatorio[$i],$complementario[$i]);
    echo "</pre>";
    ?-->

    <h2>6. Arrays asociativos</h2>
    <!--?php 
    $diccionario=[
        'España'=>'Española',
        'Portugal'=>'Portugueses',
        'Francia'=>'Franceses',
        'Italia'=>'Italianos',
        'Grecia'=>'Griego'
    ];


    <table>
        <!-?php 
        $diccionario = [
        "Español" => ["Hola", "Adiós"],
        "Inglés" => ["Hello", "Goodbye"]
        ];

        
        echo "<tr>";
        echo "<td>";
        echo "español";
        echo "</td>";
        echo "<td>";
        echo "inglés";
        echo "</td>";
        echo "</tr>";

        for($i=0;$i<count($diccionario["Español"]);$i++){
            echo "<tr>";
            echo "<td>";
            echo $diccionario["Español"][$i];
            echo "</td>";
            echo "<td>";
            echo $diccionario["Inglés"][$i];
            echo "</td>";
            echo "</tr>";

        }
        ?>
    </table>

    ?-->

    
    <h2>7. Borrado</h2>
    <!--?php  
    $array=[4,3,2,1,7,6,5,8];
    print_r($array);
    unset($array[2]);
    echo "<br>";
    print_r($array);

    // array_filter
    // array_rand
    // arrow functions
    // array_map
    ?-->

    <h2>8. Animales</h2>
    <!--p style="font-size:30px"-->
    <!--?php 
    /*function generarAnimales(){
        $animales=[];
        $numero=rand(20,30);
        echo "Tenemos ".$numero." animales<br>";
        for($i=0;$i<=$numero;$i++){
            array_push($animales,rand(128000, 128060));
        }
        return $animales;
    }*/
    function mostrarAnimales(array $array){
        echo "&#".implode("&#",$array);
    }
        function generarAnimales(int $cantidad):array{
        return array_map(
            fn():int=>random_int(128000, 128060),
            range(1,$cantidad)//range genera un array
        );
    }
    function codigosAEmojis(array $codigos): string{
        $emojis=array_map(fn(int $codigo): string=> mb_chr($codigo,'UTF-8'), $codigos);
        return implode(' ',$emojis);
    }
    $numero=rand(20,30);
    echo "tenemos ".$numero." animales<br>";
    $animales=generarAnimales($numero);
    echo codigosAEmojis($animales);
    $descartado=$animales[array_rand($animales)];
    echo "<br><br>animal a eliminar: ".codigosAEmojis([$descartado])."<br>";
    $restantes=array_diff($animales,[$descartado]);
    echo codigosAEmojis($restantes);
    ?-->
    <h2>9. Array de arrays</h2>
    <!--?php 
    //style
    /*table, td{
    border: 2px solid blue;
    border-collapse: collapse;
}
td{
    width: 50px;
    height: 50px;
    margin: 0 auto;
    padding: 0px;
    
}
td.blanca{
    background-color: white;
}
td.gris{
    background-color: #EEEE;
}*//*
table {
    border-collapse: collapse;
    border: 4px solid #555;
}

td {
    width: 80px;
    height: 80px;
    padding: 0;
    margin: 0;
    text-align: center;
}

td.blanca {
    background-color: white;
}

td.gris {
    background-color: #EEEEEE;
}

td img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}
*/
    echo "a. <br>";
    $profesores=[
        ['numRegistro'=>'234',
        'nombre'=>'lucia',
        'apellido'=>'martinez',
        'numero'=>'123455667',
        'fechaN'=>'21 March 1967'
        ],
        [
        'numRegistro'=>'644',
        'nombre'=>'maría',
        'apellido'=>'gonzales',
        'numero'=>'325262667',
        'fechaN'=>'20 October 1977'
        ],
        [
        'numRegistro'=>'7456',
        'nombre'=>'toni',
        'apellido'=>'montana',
        'numero'=>'9675743',
        'fechaN'=>'3 September 2000'
        ],
        [
        'numRegistro'=>'4322352',
        'nombre'=>'netan',
        'apellido'=>'tel',
        'numero'=>'523095209',
        'fechaN'=>'8 September 2002'
        ]
    ];
    print_r($profesores);
    echo "<br>b. <br>";
    function numR(array $profesores){
        $numR=[];
        foreach ($profesores as $profesor) {
            foreach($profesor as $valor => $value){
                if($valor=='numRegistro')
                    $numR[]=[$valor => $value];
            }
        }
        return $numR;
    }
    print_r(numR($profesores));
    echo "<br>c.<br>";
    //c)
    function numRArrayM(array $profesores){
        $numRegistro=array_map(function($profesor){
                foreach($profesor as $valor => $value){
                    if($valor=='numRegistro')
                        return $value;
                }
            }, $profesores);
        return $numRegistro;
    }
    print_r(numRArrayM($profesores));
    echo "<br>d. Arrays nacidos a partir de 1999<br>";

    define('MINIMUN_DATE_FILTER',strtotime('1 January 1999'));
    print_r(array_filter($profesores,fn($profesores)=>strtotime($profesores['fechaN'])>=MINIMUN_DATE_FILTER));
    
    ?>
    </p-->
    <img src="" alt="">
    <h2>10. Ajedrez</h2>
    <!--?php dibujarTablero() ?-->
</body>
</html>