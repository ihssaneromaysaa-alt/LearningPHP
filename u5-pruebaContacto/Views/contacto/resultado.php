

<h2>Datos recibidos por POST</h2>
<pre><?php
use function Lib\e;
 var_dump($_POST); ?></pre>

<h1>Datos recibidos</h1>
<p><strong>Nombre:</strong> <?= e($contacto->nombre) ?></p>
<p><strong>Apellidos:</strong>
 <?= ($contacto->apellidos) ?: 'No indicados' ?>
</p>
<p><strong>Correo electrónico:</strong> <?= ($contacto->correo) ?></p>
 <p>
    <strong>Métodos de pago:</strong>
    <?= !empty($contacto->metodosPago)
        ? (implode(', ', $contacto->metodosPago))
        : 'Ninguno' ?>
</p>
<p><strong>Términos y condiciones:</strong>
 <?= $contacto->marcar ? 'aceptados' : 'no aceptados' ?>
</p>
<p>
 <a href="index.php?controller=contacto&amp;action=formulario">
 Volver al formulario </a>
</p>