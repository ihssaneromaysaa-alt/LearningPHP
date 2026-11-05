<?php

$resultado = crearFichero();
if ($resultado['status'] === true) {
    $recurso = $resultado['data'];

    leerArchivoCaracterACaracter($recurso);
    // descargar(__DIR__ . '/assets/prueba.txt'); // opcional
} else {
    echo $resultado['message'];
}

function leerArchivoCaracterACaracter($recurso): void
{
    while (($caracter = fgetc($recurso)) !== false) {
        echo htmlspecialchars($caracter); 
    }
    fclose($recurso);
}

function abrirFicheroSiLegible(string $rutaFichero): array
{
    if (!is_file($rutaFichero)) {
        return ['status' => false, 'message' => 'el fichero no existe'];
    }
    if (!is_readable($rutaFichero)) {
        return ['status' => false, 'message' => 'no tiene permiso de lectura'];
    }
    $recurso = fopen($rutaFichero, 'r');
    if ($recurso === false) {
        return ['status' => false, 'message' => 'no se pudo abrir el fichero'];
    }
    return ['status' => true, 'data' => $recurso];
}

function crearFichero(): array
{
    $ruta = __DIR__ . '/assets/prueba.txt';

    if (!is_dir(__DIR__ . '/assets')) {
        mkdir(__DIR__ . '/assets', 0755, true);
    }

    file_put_contents($ruta, "Hola mundo\nEsto es una prueba\nCaracter a caracter");

    return abrirFicheroSiLegible($ruta);
}

function descargar(string $fichero): void
{
    if (!is_file($fichero)) {
        http_response_code(404);
        echo 'El archivo no existe.';
        exit;
    }

    header('Content-Type: text/plain; charset=utf-8');
    header('Content-Disposition: attachment; filename="ejemplo.txt"');
    header('Content-Length: ' . filesize($fichero));

    readfile($fichero);
    exit;
}