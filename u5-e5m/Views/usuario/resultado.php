

<h2>Datos recibidos por POST</h2>
<pre><?php
use function Lib\e;
 var_dump($_POST); ?></pre>

<h1>Datos recibidos</h1>
<p><strong>Nombre:</strong> <?= e($usuario->nombre) ?></p>
<p><strong>Contraseña:</strong>
 <?= ($usuario->cont) ?: 'No indicados' ?>
</p>
 <a href="index.php?controller=usuario&amp;action=formulario">
 Volver al formulario </a>
</p>