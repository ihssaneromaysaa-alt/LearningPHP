<?php
declare(strict_types=1);

$nombre = htmlspecialchars(
    is_string($contacto->getNombre() ?? null) ? $contacto->getNombre() : '',
    ENT_QUOTES,
    'UTF-8'
);
$apellido = htmlspecialchars(
    is_string($contacto->getApellido() ?? null) ? $contacto->getApellido() : '',
    ENT_QUOTES,
    'UTF-8'
);

$correo = htmlspecialchars(
    is_string($contacto->getCorreo() ?? null) ? $contacto->getCorreo() : '',
    ENT_QUOTES,
    'UTF-8'
);
$metodoPago[] = htmlspecialchars(
    is_string($contacto->getMetodosPago() ?? null) ? $contacto->getMetodosPago() : '',
    ENT_QUOTES,
    'UTF-8'
);
$marcar = $contacto->getMarcar() ?? '';
var_dump($contacto);
?>
<h1>Datos recibidos</h1>

<p><strong>Nombre:</strong>
    <?= $nombre !== '' ? $nombre : 'No especificado' ?>
</p>

<p><strong>Apellido:</strong>
    <?= $apellido !== '' ? $apellido : 'No especificado' ?>
</p>
<p><strong>Método de pago:</strong>
    <?= !empty($metodoPago) ? var_dump($metodoPago[0]) : 'No especificado' ?>
</p>
<p><strong>Correo:</strong>
    <?= $correo !== '' ? $correo : 'No especificado' ?>
</p>


<p><strong>Términos aceptados:</strong>
    <?= $marcar ? 'Sí' : 'No' ?>
</p>

<h2>Datos recibidos por POST</h2>
<pre><?php var_dump($_POST); ?></pre>