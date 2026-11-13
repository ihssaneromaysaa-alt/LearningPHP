<h2>Nuevo contacto</h2>
<form method="POST" action="<?= BASE_URL ?>contacto/procesar" novalidate>


    <p>
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="contacto[nombre]" value="<?= e($contacto->nombre) ?>" />
        <?php if (isset($errores['nombre'])): ?>
            <span class="error" style="color: red;"><?= e($errores['nombre']) ?></span>
        <?php endif; ?>
    </p>

    <p>
        <label for="apellidos">Apellidos</label>
        <input type="text" id="apellidos" name="contacto[apellidos]" value="<?= e($contacto->apellidos) ?>" />
        <?php if (isset($errores['apellidos'])): ?>
            <span class="error" style="color: red;"><?= e($errores['apellidos']) ?></span>
        <?php endif; ?>
    </p>

    <p>
        <label for="correo">Correo electrónico</label>
        <input type="email" id="correo" name="contacto[correo]" value="<?= e($contacto->correo) ?>" />
        <?php if (isset($errores['correo'])): ?>
            <span class="error" style="color: red;"><?= e($errores['correo']) ?></span>
        <?php endif; ?>
    </p>

    <p>
        <label for="metodoPago">Selecciona método de pago</label>
        <select id="metodoPago" name="contacto[metodosPago][]" multiple size="3">
            <?php foreach ($metodos as $metodo): ?>
                <?php $sel = in_array($metodo, $contacto->metodosPago, true); ?>
                <option value="<?= e($metodo) ?>" <?= $sel ? 'selected' : '' ?>>
                    <?= e($metodo) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <?php if (isset($errores['metodosPago'])): ?>
            <span class="error" style="color: red;"><?= e($errores['metodosPago']) ?></span>
        <?php endif; ?>
    </p>

    <p>
        <input type="checkbox" id="marcar" name="contacto[marcar]" value="1" <?= $contacto->marcar ? 'checked' : '' ?> />
        <label for="marcar">Aceptar los términos y condiciones</label>
        <?php if (isset($errores['marcar'])): ?>
            <span class="error" style="color: red;"><?= e($errores['marcar']) ?></span>
        <?php endif; ?>
    </p>

    <input type="submit" value="Enviar" />
</form>
