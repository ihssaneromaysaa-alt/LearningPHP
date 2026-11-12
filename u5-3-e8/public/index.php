<?php
declare(strict_types=1);

// recibimos info
$jsonInput = '[
    {"id": 1, "nombre": "Ana",    "edad": 28},
    {"id": 2, "nombre": "Luis",   "edad": 22},
    {"id": 3, "nombre": "Carlos", "edad": 30}
]';

// lo pasamos objeto
$datos = json_decode($jsonInput, true);

echo "<p>las personas con más de 25 años son: </p>";
foreach ( $datos as $persona){
    if ($persona["edad"] > 25) 
        echo $persona["nombre"] . "<br>";
}