<?php
include __DIR__."/src/Usuario.php";
include __DIR__."/src/Producto.php";
//8. traits
$usuario=new Usuario();
echo $usuario->getId();


$producto=new Producto();
echo "<br>".$producto->getId();
