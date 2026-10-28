<?php declare(strict_types=0);?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reparto de mercancias</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Reparto de mercancias</h1>
    <?php 
    //creando array clientes
    $clientes=[[
        "nombre" => "manolo",
        "idC" => "1"
        ],[
        "nombre" => "sara",
        "idC" => "2"
        ],[
        "nombre" => "maria",
        "idC" => "3"
        ],[
        "nombre" => "teresa",
        "idC" => "4"
        ]];
    //creando productos
    $productos=[[
        "nombreP" => "Cuaderno A4",
        "precio" => "2.50",
        "peso en kg" => "1.0",
        "stock" => "8",
        "descuento" => "10.0"
        ],[
        "nombreP" => "Boligrafo",
        "precio" => "0.90",
        "peso en kg" => "0.4",
        "stock" => "25",
        "descuento" => "null"
        ],[
        "nombreP" => "Archivador",
        "precio" => "4.20",
        "peso en kg" => "0.4",
        "stock" => "1",
        "descuento" => "15.0"
        ]];
    //creando pedidos
    define('NUM_PEDIDOS',15);
    $pedidos=[];
    $idP=1;
    $carga=0;
    $num_a=0;
    $num_r=0;
    for($i=0;$i<NUM_PEDIDOS;$i++){
        $cliente=$clientes[array_rand($clientes)];
        $numP=array_rand($productos);
        $producto=$productos[$numP];
        $unidades=rand(1,5);
        $precio=round($producto["precio"]*$unidades,2);
        //var_dump($precio);
        if((int)$productos[$numP]["stock"]<$unidades || $carga>=18){
            //cancelar pedido por que no hay suficiente stock
            if($carga>=18)
                $pedidos[]=[$idP, $cliente, $unidades, $producto["nombreP"], "RECHAZADO", "no cabe", null];
            else
                $pedidos[]=[$idP, $cliente, $unidades, $producto["nombreP"], "RECHAZADO", "sin stock", null];
            $num_r++;
        }else{
            $precio=$precio-$precio*(floatval($producto["descuento"])/100); // aplicar descuento
            $precio=$precio+$precio*21/100; // aplicar iva

            $pedidos[]=[$idP, $cliente, $unidades, $producto["nombreP"], "ACEPTADO", $precio, $producto["peso en kg"]*$unidades];
            $productos[$numP]["stock"]-=$unidades;
            $carga+=$producto["peso en kg"]*$unidades;
            $num_a++;
            }
        $idP++;
    }
    //var_dump($pedidos);

    //procesando cola de pedidos
    printf("-- FURGONETA DE REPARTO ---");
    
    printf("<p>pedidos en cola: %d</p>",NUM_PEDIDOS);
    for($i=0;$i<NUM_PEDIDOS;$i++){
        $pedido=array_pop($pedidos);
        $cliente=$pedido[1];
        if($pedido[5]==="sin stock"){
        printf("<br>  #%s %20s | %5d x %10s | %10s | %10s  ",$pedido[0],$cliente["nombre"],$pedido[2],$pedido[3],$pedido[4],$pedido[5]);
        }
        else
        printf("<br>  #%s %20s | %5d x %10s | %10s | %2.2f € | peso en carga: %2.1f kg",$pedido[0],$cliente["nombre"],$pedido[2],$pedido[3],$pedido[4],$pedido[5], $pedido[6]);
    }

    printf("<p>La furgoneta alcanza %2.2f . Se detiene el reparto.</p>", $carga);
    
    printf("<p>Pedidos aceptados: %d</p>", $num_a);
    printf("<p>Pedidos rechazados: %d</p>", $num_r);

    printf("<p>Pedidos aceptados: </p>");

    
    ?>

</body>
</html>