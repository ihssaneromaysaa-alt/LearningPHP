<section class="tarjeta">
    <h1>Área de un triángulo</h1>
    <p class="ayuda">Fórmula: área = (base × altura) / 2</p>

    <!-- se usa type="text" para que la validacion numerica la haga el servidor -->
    <form method="post" action="index.php?controller=triangulo&action=area">
        <div class="campo">
            <label for="base">Base</label>
            <input type="text" id="base" name="base" inputmode="decimal"
                   class="<?= isset($errores['base']) ? 'invalido' : '' ?>"
                   value="<?= $e($base) ?>">
            <?php if (isset($errores['base'])): ?>
                <div class="error-campo"><?= $e($errores['base']) ?></div>
            <?php endif; ?>
        </div>

        <div class="campo">
            <label for="altura">Altura</label>
            <input type="text" id="altura" name="altura" inputmode="decimal"
                   class="<?= isset($errores['altura']) ? 'invalido' : '' ?>"
                   value="<?= $e($altura) ?>">
            <?php if (isset($errores['altura'])): ?>
                <div class="error-campo"><?= $e($errores['altura']) ?></div>
            <?php endif; ?>
        </div>

        <button class="boton" type="submit">Calcular</button>
    </form>

    <?php if ($area !== null): ?>
        <p class="resultado" style="margin-top:1.5rem">
            Área = (<?= $e($base) ?> × <?= $e($altura) ?>) / 2 = <?= $e($area) ?>
        </p>
    <?php endif; ?>
</section>