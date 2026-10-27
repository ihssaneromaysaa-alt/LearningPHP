<?php
declare(strict_types=1);

$nombre = htmlspecialchars($_POST['nombre'] ?? '',ENT_QUOTES,'UTF-8');
$apellido = htmlspecialchars($_POST['apellido'] ?? '',ENT_QUOTES,'UTF-8');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos recibidos</title>
</head>
<body>
    <h1>Datos recibidos</h1>

    <p><strong>Nombre:</strong>
        <?= $nombre !== '' ? $nombre : 'No especificado' ?>
    </p>

    <p><strong>Apellidos:</strong>
        <?= $apellido !== '' ? $apellido : 'No especificado' ?>
    </p>

    <h2>Datos recibidos por POST</h2>
    <pre><?php var_dump($_POST); ?></pre>
</body>
</html>
