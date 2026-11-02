<section class="tarjeta">
    <h1>Mensaje generado</h1>

    <p class="mensaje-spam">
        ¡Buenos días, <strong><?= $e($nombre) ?></strong>!
        Te voy a enviar spam a <strong><?= $e($correo) ?></strong>
        y te llamaré de madrugada a <strong><?= $e($telefono) ?></strong>.
        Enviado desde un iPhone.
    </p>

    <a class="boton" href="index.php?controller=spam&action=formulario">Volver</a>
</section>