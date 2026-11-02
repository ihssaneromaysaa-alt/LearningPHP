<section class="tarjeta">
    <h1>Control de acceso</h1>
    <p class="ayuda">Introduce tu fecha de nacimiento.</p>

    <?php if (!empty($error)): ?>
        <div class="alerta alerta-error"><?= $e($error) ?></div>
    <?php endif; ?>

    <form method="post" action="index.php?controller=edad&action=comprobar">
        <div class="campo">
            <label for="dia">Día</label>
            <input type="number" id="dia" name="dia" min="1" max="31" value="<?= $e($dia) ?>">
        </div>

        <div class="campo">
            <label for="mes">Mes</label>
            <input type="number" id="mes" name="mes" min="1" max="12" value="<?= $e($mes) ?>">
        </div>

        <div class="campo">
            <label for="anio">Año</label>
            <input type="number" id="anio" name="anio" min="1900" max="<?= date('Y') ?>" value="<?= $e($anio) ?>">
        </div>

        <button class="boton" type="submit">Comprobar</button>
    </form>

    <?php if ($edad !== null): ?>
        <div class="alerta <?= $e($clase) ?>" style="margin-top:1.5rem">
            <?= $e($mensaje) ?>
        </div>
    <?php endif; ?>
</section>