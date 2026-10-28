<?php
declare(strict_types=1);

$contacto = $_POST['contacto'] ?? [];

$nombre = htmlspecialchars(
    is_string($contacto['nombre'] ?? null) ? $contacto['nombre'] : '',
    ENT_QUOTES,
    'UTF-8'
);

$apellido = htmlspecialchars(
    is_string($contacto['apellido'] ?? null) ? $contacto['apellido'] : '',
    ENT_QUOTES,
    'UTF-8'
);

$marcar = $contacto['marcar'] ?? '';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Datos recibidos</title>
</head>
<body>
    <h1>Datos recibidos</h1>

    <p><strong>Nombre:</strong>
        <?= $nombre !== '' ? $nombre : 'No especificado' ?>
    </p>

    <p><strong>Apellido:</strong>
        <?= $apellido !== '' ? $apellido : 'No especificado' ?>
    </p>

    <p><strong>Términos aceptados:</strong>
        <?= $marcar === '1' ? 'Sí' : 'No' ?>
    </p>

    <h2>Datos recibidos por POST</h2>
    <pre><?php var_dump($_POST); ?></pre>
</body>
</html>
