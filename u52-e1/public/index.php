<?php

$resultado = fichero();
if ($resultado['status'] === true) {
    $recurso = $resultado['data'];
    descargar(__DIR__ . '/assets/prueba.txt');
} else {
    echo $resultado['message'];
}

echo "hola2";

function abrirFicheroSiLegible(string $rutaFichero): array
{
    if(is_file($rutaFichero.'1')) // para probar a que no se encuentre el archivo
        if(is_readable($rutaFichero)){
            $recurso = fopen($rutaFichero, 'r');
            return ['status' => true, 'data' => $recurso];
        }
        else
            return ['status' => false, 'message' => 'no tiene permiso de lectura'];
    else
        return ['status' => false, 'message' => 'el fichero no existe'];
}
function fichero(): array {
    $ruta = __DIR__ . '/assets/prueba.txt';
    file_put_contents($ruta, 'hola');
    return abrirFicheroSiLegible($ruta);
}


function descargar(mixed $fichero): void{
    if (!is_file($fichero)) {
        http_response_code(404);
        echo 'El archivo texto no existe.';
        exit;
    }

    header('Content-Type: application/txt');
    header('Content-Disposition: attachment; filename="ejemplo.txt"');
    header('Content-Length: ' . filesize($fichero));

    readfile($fichero);
    exit;
}