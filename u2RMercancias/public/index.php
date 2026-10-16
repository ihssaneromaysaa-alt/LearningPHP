<?php declare (strict_types=1);

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
function elegirCliente( array $clientes):array{
    return $clientes[array_rand($clientes)];
}
function elegirProducto(array $productos):array{
    return array_rand($productos);
}

function generarP(array $productos, array $clientes){
    define('NUM_PEDIDOS',15);
    $pedidos=[];
    $idP=1;
    $carga=0;
    $num_a=0;
    $num_r=0;
    for($i=0;$i<NUM_PEDIDOS;$i++){
        $cliente=elegirCliente($clientes);
        $producto=elegirProducto($productos);
        $unidades=rand(1,5);
        $precio=round($producto["precio"]*$unidades,2);
        //var_dump($precio);
        if((int)$producto["stock"]<$unidades || $carga>=18){
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
            $producto["stock"]-=$unidades;
            $carga+=$producto["peso en kg"]*$unidades;
            $num_a++;
            }
        $idP++;
    }
}