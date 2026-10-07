<?php declare(strict_types=1);

require_once __DIR__ . "/src/Persona.php";
require_once __DIR__ . "/src/Cliente.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>prueba objetos</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <?php 

    //$producto=new Producto();
    
    $persona=new Persona("juanito", "perez");
    $cliente=new Cliente("juanito", "perez","234");
    var_dump($cliente);
    ?>
</body>
</html>