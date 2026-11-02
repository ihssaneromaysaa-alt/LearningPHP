<section class="tarjeta">
    <h1>Generador de spam</h1>
    <p class="ayuda">Ejercicio ficticio: no se envía ningún correo ni se hace ninguna llamada.</p>

    <?php if (!empty($error)): ?>
        <div class="alerta alerta-error"><?= $e($error) ?></div>
    <?php endif; ?>

    <form method="post" action="index.php?controller=spam&action=enviar">
        <div class="campo">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" value="<?= $e($nombre ?? '') ?>">
        </div>

        <div class="campo">
            <label for="telefono">Teléfono</label>
            <input type="tel" id="telefono" name="telefono" value="<?= $e($telefono ?? '') ?>">
        </div>

        <div class="campo">
            <label for="correo">Correo</label>
            <input type="email" id="correo" name="correo" value="<?= $e($correo ?? '') ?>">
        </div>

        <button class="boton" type="submit">Enviar</button>
    </form>
</section>