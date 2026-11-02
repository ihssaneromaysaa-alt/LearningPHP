<?php if ($correcto): ?>

<section class="tarjeta">
    <h1>Contacto guardado</h1>
    <div class="alerta alerta-ok">Todos los datos son correctos.</div>

    <table class="datos">
        <tr><th>Nombre</th><td><?= $e($nombre) ?></td></tr>
        <tr><th>Teléfono</th><td><?= $e($telefono) ?></td></tr>
        <tr><th>Correo</th><td><?= $e($correo) ?></td></tr>
    </table>

    <a class="boton" href="index.php?controller=contacto&action=formulario">Añadir otro contacto</a>
</section>

<?php else: ?>

<section class="tarjeta">
    <h1>Nuevo contacto</h1>

    <?php if ($errores): ?>
        <div class="alerta alerta-error">Hay datos incorrectos. Revisa los campos marcados.</div>
    <?php endif; ?>

    <!-- novalidate: la validacion la hace el servidor -->
    <form method="post" action="index.php?controller=contacto&action=formulario" novalidate>
        <div class="campo">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre"
                   class="<?= isset($errores['nombre']) ? 'invalido' : '' ?>"
                   value="<?= $e($nombre) ?>">
            <?php if (isset($errores['nombre'])): ?>
                <div class="error-campo"><?= $e($errores['nombre']) ?></div>
            <?php endif; ?>
        </div>

        <div class="campo">
            <label for="telefono">Teléfono</label>
            <input type="text" id="telefono" name="telefono"
                   class="<?= isset($errores['telefono']) ? 'invalido' : '' ?>"
                   value="<?= $e($telefono) ?>">
            <?php if (isset($errores['telefono'])): ?>
                <div class="error-campo"><?= $e($errores['telefono']) ?></div>
            <?php endif; ?>
        </div>

        <div class="campo">
            <label for="correo">Correo electrónico</label>
            <input type="text" id="correo" name="correo"
                   class="<?= isset($errores['correo']) ? 'invalido' : '' ?>"
                   value="<?= $e($correo) ?>">
            <?php if (isset($errores['correo'])): ?>
                <div class="error-campo"><?= $e($errores['correo']) ?></div>
            <?php endif; ?>
        </div>

        <button class="boton" type="submit">Enviar</button>
    </form>
</section>

<?php endif; ?>